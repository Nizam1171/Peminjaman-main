@extends('layouts.peminjam')

@section('title', 'Katalog Alat')
@section('header-title', 'Katalog Alat')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Katalog Alat Tersedia
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Pilih alat yang ingin kamu pinjam.
        </p>
    </div>

    <form action="{{ route('peminjam.peminjaman.ajukan') }}"
          method="POST">
        @csrf

        {{-- Tanggal kembali --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <label for="tgl_kembali_plan"
                   class="mb-2 block text-sm font-semibold text-gray-700">
                Rencana Tanggal Kembali
            </label>

            <input
                type="date"
                name="tgl_kembali_plan"
                id="tgl_kembali_plan"
                value="{{ old('tgl_kembali_plan') }}"
                min="{{ now()->addDay()->format('Y-m-d') }}"
                class="w-full rounded-xl border border-gray-300 px-4 py-3
                       focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-100 md:w-80"
                required
            >

            @error('tgl_kembali_plan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Daftar kartu alat --}}
        <div class="mt-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">
                    Pilih Alat
                </h2>

                <span class="text-sm text-gray-500">
                    {{ $alats->count() }} jenis alat
                </span>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                @forelse($alats as $alat)

                    <div class="overflow-hidden rounded-2xl border border-gray-200
                                bg-white shadow-sm transition hover:-translate-y-1
                                hover:shadow-md">

                        {{-- Gambar alat --}}
                        <div class="relative flex h-48 items-center justify-center
                                    overflow-hidden bg-gray-100">

                            @if($alat->gambar)
                                <img
                                    src="{{ asset($alat->gambar) }}"
                                    alt="{{ $alat->nama_alat }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >

                                <div class="absolute inset-0 hidden items-center
                                            justify-center text-gray-400">
                                    <div class="text-center">
                                        <div class="text-5xl">🧰</div>
                                        <p class="mt-2 text-sm">Gambar tidak tersedia</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center text-gray-400">
                                    <div class="text-5xl">🧰</div>
                                    <p class="mt-2 text-sm">Belum ada gambar</p>
                                </div>
                            @endif

                            {{-- Label stok --}}
                            <span class="absolute right-3 top-3 rounded-full
                                         bg-white/95 px-3 py-1 text-xs font-semibold
                                         {{ $alat->stok > 0
                                            ? 'text-green-700'
                                            : 'text-red-600' }}">
                                {{ $alat->stok > 0
                                    ? 'Stok: ' . $alat->stok
                                    : 'Stok Habis' }}
                            </span>
                        </div>

                        {{-- Informasi alat --}}
                        <div class="space-y-4 p-5">

                            <div>
                                <p class="text-xs font-medium uppercase
                                          tracking-wide text-blue-600">
                                    {{ $alat->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </p>

                                <h3 class="mt-1 text-lg font-bold text-gray-800">
                                    {{ $alat->nama_alat }}
                                </h3>
                            </div>

                            <div class="flex items-center justify-between
                                        border-t border-gray-100 pt-4">

                                {{-- Checkbox pilihan --}}
                                <label class="flex cursor-pointer items-center gap-2
                                              text-sm font-medium text-gray-700
                                              {{ $alat->stok < 1 ? 'opacity-40' : '' }}">
                                    <input
                                        type="checkbox"
                                        name="alat_id[]"
                                        value="{{ $alat->id }}"
                                        class="h-4 w-4 rounded border-gray-300
                                               text-blue-600 focus:ring-blue-500"
                                        {{ $alat->stok < 1 ? 'disabled' : '' }}
                                    >
                                    Pilih alat
                                </label>

                                {{-- Jumlah --}}
                                <div>
                                    <label for="jumlah-{{ $alat->id }}"
                                           class="mb-1 block text-xs text-gray-500">
                                        Jumlah
                                    </label>

                                    <input
                                        type="number"
                                        id="jumlah-{{ $alat->id }}"
                                        name="jumlah[{{ $alat->id }}]"
                                        value="1"
                                        min="1"
                                        max="{{ max(1, $alat->stok) }}"
                                        {{ $alat->stok < 1 ? 'disabled' : '' }}
                                        class="w-20 rounded-lg border border-gray-300
                                               px-2 py-2 text-center text-sm
                                               focus:border-blue-500 focus:outline-none
                                               focus:ring-2 focus:ring-blue-100
                                               disabled:bg-gray-100"
                                    >
                                </div>

                            </div>
                        </div>
                    </div>

                @empty

                    <div class="col-span-full rounded-2xl border border-gray-200
                                bg-white px-5 py-12 text-center">
                        <div class="text-5xl">🧰</div>
                        <p class="mt-3 font-semibold text-gray-700">
                            Belum ada alat tersedia
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            Daftar alat akan muncul di sini.
                        </p>
                    </div>

                @endforelse

            </div>
        </div>

        {{-- Tombol pengajuan --}}
        @if($alats->count())
            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-semibold
                           text-white shadow-sm transition hover:bg-blue-700
                           focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Ajukan Peminjaman
                </button>
            </div>
        @endif

    </form>
</div>

@endsection