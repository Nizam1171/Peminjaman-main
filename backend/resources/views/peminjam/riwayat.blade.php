
@extends('layouts.peminjam')

@section('title', 'Riwayat Peminjaman')
@section('header-title', 'Riwayat Peminjaman')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header halaman --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Riwayat Peminjaman
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Daftar alat yang pernah atau sedang kamu pinjam.
        </p>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel riwayat --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-100 px-6 py-4">
            <h3 class="font-semibold text-gray-800">
                Daftar Peminjaman
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Informasi jumlah alat, tanggal, dan status peminjaman.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">

                <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                    <tr>
                        <th class="whitespace-nowrap px-5 py-4">No</th>
                        <th class="whitespace-nowrap px-5 py-4">Nama Alat</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center">Jumlah</th>
                        <th class="whitespace-nowrap px-5 py-4">Tanggal Pinjam</th>
                        <th class="whitespace-nowrap px-5 py-4">Rencana Kembali</th>
                        <th class="whitespace-nowrap px-5 py-4">Tanggal Kembali</th>
                        <th class="whitespace-nowrap px-5 py-4 text-center">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @php $no = 1; @endphp

                    @forelse($peminjamans as $peminjaman)

                        @foreach($peminjaman->detailPinjam as $detail)

                            <tr class="transition hover:bg-gray-50">

                                <td class="px-5 py-4 text-gray-500">
                                    {{ $no++ }}
                                </td>

                                <td class="px-5 py-4 font-medium text-gray-800">
                                    {{ $detail->alat->nama_alat ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center text-gray-700">
                                    {{ $detail->jumlah }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-gray-600">
                                    {{ $peminjaman->tgl_pinjam
                                        ? \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-gray-600">
                                    {{ $peminjaman->tgl_kembali_plan
                                        ? \Carbon\Carbon::parse($peminjaman->tgl_kembali_plan)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-gray-600">
                                    {{ $peminjaman->pengembalian?->tgl_kembali
                                        ? \Carbon\Carbon::parse($peminjaman->pengembalian->tgl_kembali)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    @php
                                        $status = $peminjaman->status;

                                        $statusClass = match ($status) {
                                            'menunggu', 'diajukan' => 'bg-amber-100 text-amber-700',
                                            'disetujui' => 'bg-blue-100 text-blue-700',
                                            'dipinjam' => 'bg-cyan-100 text-cyan-700',
                                            'dikembalikan' => 'bg-green-100 text-green-700',
                                            'ditolak' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                        {{ ucfirst($status ?? 'Tidak diketahui') }}
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <p class="font-medium text-gray-600">
                                    Belum ada riwayat peminjaman
                                </p>
                                <p class="mt-1 text-sm text-gray-400">
                                    Pengajuan peminjaman kamu akan muncul di sini.
                                </p>
                                <a href="{{ route('peminjam.katalog') }}"
                                   class="mt-4 inline-block rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                                    Lihat Katalog Alat
                                </a>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection