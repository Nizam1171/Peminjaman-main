<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\DetailPinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    // Melihat daftar/katalog alat yang tersedia
    public function katalogAlat()
    {
        $alats = Alat::with('kategori')
            ->where('stok', '>', 0)
            ->get();

        return view('peminjam.katalog', compact('alats'));
    }

    
    public function ajukanPeminjaman(Request $request)
    {
        $request->validate([
            'tgl_kembali_plan' => 'required|date|after:today',
            'alat_id' => 'required|array|min:1',
            'alat_id.*' => 'required|integer|exists:alat,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Buat header peminjaman
            $peminjaman = Peminjaman::create([
                'user_id' => auth()->id(),
                'tgl_pinjam' => now(),
                'tgl_kembali_plan' => $request->tgl_kembali_plan,
                'status' => 'diajukan',
            ]);

            // Simpan detail alat yang dipilih
            foreach ($request->alat_id as $alatId) {
                $jumlah = $request->input("jumlah.{$alatId}");

                if (!$jumlah) {
                    throw new \Exception('Jumlah alat tidak valid.');
                }

                $alat = Alat::findOrFail($alatId);

                if ($jumlah > $alat->stok) {
                    throw new \Exception(
                        "Stok {$alat->nama_alat} tidak mencukupi."
                    );
                }

                DetailPinjam::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alatId,
                    'jumlah' => $jumlah,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('peminjam.riwayat')
                ->with('success', 'Pengajuan peminjaman berhasil dikirim.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengajukan peminjaman: ' . $e->getMessage());
        }
    }


    public function peminjaman() { 
        $peminjamans = Peminjaman::with('detailPinjam.alat')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['diajukan', 'dipinjam'])
            ->latest()
            ->get();
        return view('peminjam.peminjaman', compact('peminjamans'));
    }

    // Melihat daftar peminjaman yang sedang dipinjam dan perlu dikembalikan
    public function pengembalian()
    {
        $peminjamans = Peminjaman::with([
            'detailPinjam.alat',
            'pengembalian'
        ])
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('peminjam.pengembalian', compact('peminjamans'));
    }

    // Melihat riwayat peminjaman user yang sedang login
    public function riwayatPeminjaman()
    {
        $peminjamans = Peminjaman::with([
            'detailPinjam.alat',
            'pengembalian'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjam.riwayat', compact('peminjamans'));
    }

    // Dashboard Peminjam
    public function dashboard()
    {
        $userId = auth()->id();

        $totalPeminjaman = Peminjaman::where('user_id', $userId)->count();

        $sedangDipinjam = Peminjaman::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->count();

        $menungguPersetujuan = Peminjaman::where('user_id', $userId)
            ->where('status', 'diajukan')
            ->count();

        $peminjamanTerbaru = Peminjaman::with('detailPinjam.alat')
            ->where('user_id', $userId)
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('peminjam.dashboard', compact(
            'totalPeminjaman',
            'sedangDipinjam',
            'menungguPersetujuan',
            'peminjamanTerbaru'
        ));
    }
}