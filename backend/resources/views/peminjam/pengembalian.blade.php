@extends('layouts.peminjam')

@section('title', 'Pengembalian')
@section('header-title', 'Pengembalian Alat')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Pengembalian Alat
        </h1>
        <p class="text-gray-500 mt-1">
            Daftar alat yang sedang kamu pinjam dan perlu dikembalikan.
        </p>
    </div>

    @if($peminjamans->count())

        <div class="space-y-5">

            @foreach($peminjamans as $peminjaman)

                <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                    <div class="p-5 border-b border-gray-100 flex justify-between items-center">

                        <div>
                            <p class="text-sm text-gray-500">
                                Peminjaman #{{ $peminjaman->id }}
                            </p>

                            <p class="font-semibold text-gray-800">
                                {{ $peminjaman->tgl_pinjam->format('d/m/Y') }}
                                -
                                {{ $peminjaman->tgl_kembali_plan->format('d/m/Y') }}
                            </p>
                        </div>

                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                            Sedang Dipinjam
                        </span>

                    </div>

                    <div class="p-5">

                        <h3 class="font-semibold text-gray-800 mb-3">
                            Alat yang Dipinjam
                        </h3>

                        <div class="overflow-x-auto">

                            <table class="w-full text-sm">

                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-2 text-gray-500">
                                            Nama Alat
                                        </th>

                                        <th class="text-left py-3 px-2 text-gray-500">
                                            Jumlah
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($peminjaman->detailPinjam as $detail)

                                        <tr class="border-b border-gray-100">

                                            <td class="py-3 px-2 font-medium text-gray-800">
                                                {{ $detail->alat->nama_alat ?? '-' }}
                                            </td>

                                            <td class="py-3 px-2 text-gray-600">
                                                {{ $detail->jumlah }}
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="mt-5 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">

                            <p class="font-semibold text-yellow-700">
                                Belum Dikembalikan
                            </p>

                            <p class="text-sm text-yellow-600 mt-1">
                                Silakan serahkan alat kepada petugas untuk proses pengembalian.
                            </p>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-xl border border-gray-200 p-10 text-center">

            <div class="text-5xl mb-4">
                📦
            </div>

            <h2 class="text-xl font-semibold text-gray-800">
                Tidak Ada Pengembalian
            </h2>

            <p class="text-gray-500 mt-2 mb-6">
                Saat ini tidak ada alat yang sedang kamu pinjam.
            </p>

            <a href="{{ route('peminjam.katalog') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg">
                Lihat Katalog
            </a>

        </div>

    @endif

</div>

@endsection