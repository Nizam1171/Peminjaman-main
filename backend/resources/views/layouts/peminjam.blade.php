<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Peminjam')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR PEMINJAM --}}
        <aside class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex">

            <div class="p-5 text-xl font-bold tracking-wider border-b border-gray-800">
                PANEL PEMINJAM
            </div>

            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('peminjam.dashboard') }}"
                   class="block px-4 py-2 rounded-lg transition
                   {{ request()->routeIs('peminjam.dashboard')
                        ? 'bg-gray-800 text-white font-medium shadow'
                        : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    Dashboard
                </a>

                <a href="{{ route('peminjam.katalog') }}"
                   class="block px-4 py-2 rounded-lg transition
                   {{ request()->routeIs('peminjam.katalog*')
                        ? 'bg-gray-800 text-white font-medium shadow'
                        : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    Katalog Alat
                </a>

                <a href="{{ route('peminjam.peminjaman.index') }}"
                   class="block px-4 py-2 rounded-lg transition
                   {{ request()->routeIs('peminjam.peminjaman.*')
                        ? 'bg-gray-800 text-white font-medium shadow'
                        : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    Peminjaman Saya
                </a>

                <a href="{{ route('peminjam.pengembalian.index') }}"
                   class="block px-4 py-2 rounded-lg transition
                   {{ request()->routeIs('peminjam.pengembalian.*')
                        ? 'bg-gray-800 text-white font-medium shadow'
                        : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    Pengembalian
                </a>

                <a href="{{ route('peminjam.riwayat') }}"
                   class="block px-4 py-2 rounded-lg transition
                   {{ request()->routeIs('peminjam.riwayat.*')
                        ? 'bg-gray-800 text-white font-medium shadow'
                        : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    Riwayat
                </a>

            </nav>

            {{-- USER --}}
            <div class="p-4 border-t border-gray-800 text-sm text-gray-400">
                Logged in as:

                <span class="text-white font-semibold">
                    {{ auth()->user()->name }}
                </span>
            </div>

        </aside>

        {{-- MAIN --}}
        <div class="flex-1 flex flex-col overflow-y-auto">

            <header class="bg-white shadow-sm min-h-16 flex items-center justify-between px-6 z-10">

                <div class="flex items-center min-h-16">
                    <h1 class="text-lg font-semibold text-gray-800 leading-none">
                        @yield('header-title', 'Dashboard')
                    </h1>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                        Logout
                    </button>
                </form>

            </header>

            <main class="flex-1 p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>