<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Admin')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        /* =========================================
           PAGE TRANSITION
        ========================================= */

        .page-transition {
            animation: pageEnter 0.28s ease-out both;
        }

        @keyframes pageEnter {

            from {
                opacity: 0;
                transform: translateX(35px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }

        }


        /* Halaman keluar */

        .page-transition.page-exit {
            animation: pageExit 0.20s ease-in both;
        }

        @keyframes pageExit {

            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(-35px);
            }

        }


        /* =========================================
           REDUCED MOTION
        ========================================= */

        @media (prefers-reduced-motion: reduce) {

            .page-transition,
            .page-transition.page-exit {
                animation: none;
            }

        }


        /* =========================================
           PARTICLE BACKGROUND
        ========================================= */

        #particle-background {

            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            pointer-events: none;
            display: block;
        }

        /* Konten berada di atas particle */

        .page-layer {
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

    </style>

</head>


<body class="bg-transparent font-sans antialiased">

    <!-- =========================================
         MAIN APPLICATION
    ========================================== -->

    <div class="flex h-screen overflow-hidden page-layer">


        <!-- =====================================
             SIDEBAR
        ====================================== -->

        <aside
            class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex"
        >


            <!-- SIDEBAR HEADER -->

            <div
                class="p-5 text-xl font-bold tracking-wider border-b border-gray-800"
            >

                PANEL {{ strtoupper(auth()->user()->role) }}

            </div>



            <!-- =================================
                 SIDEBAR NAVIGATION
            ================================== -->

            <nav
                id="sidebar-nav"
                class="relative flex-1 p-4 space-y-2"
            >


                <!-- =================================
                     BACKGROUND MENU AKTIF
                ================================== -->

                <div
                    id="sidebar-active-bg"
                    class="
                        absolute
                        bg-cyan-400/15
                        border
                        border-cyan-400/20
                        rounded-lg
                        shadow-[0_0_20px_rgba(34,211,238,0.12)]
                        transition-all
                        duration-300
                        ease-out
                        pointer-events-none
                    "
                >

                    
                <!-- =================================
                     GARIS CYAN MENU AKTIF
                ================================== -->

                    <div
                        id="sidebar-active-line"
                        class="
                            absolute
                            top-0
                            left-[-16px]
                            w-1
                            h-full
                            bg-cyan-400
                            rounded-r-full
                            shadow-[0_0_12px_rgba(34,211,238,0.8)]
                        "
                    ></div>
                </div>

                <!-- =================================
                     MENU KHUSUS ADMIN
                ================================== -->

                @if(auth()->user()->role == 'admin')


                    <!-- Dashboard -->

                    <a
                        href="{{ route('admin.admin.dashboard') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.admin.dashboard')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Dashboard

                    </a>



                    <!-- Kelola User -->

                    <a
                        href="{{ route('admin.user.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.user.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Kelola User

                    </a>



                    <!-- Kelola Kategori -->

                    <a
                        href="{{ route('admin.kategori.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.kategori.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Kelola Kategori

                    </a>



                    <!-- Kelola Alat -->

                    <a
                        href="{{ route('admin.alat.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.alat.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Kelola Alat

                    </a>



                    <!-- Kelola Peminjam -->

                    <a
                        href="{{ route('admin.peminjaman.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.peminjaman.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Kelola Peminjam

                    </a>



                    <!-- Kelola Pengembalian -->

                    <a
                        href="{{ route('admin.pengembalian.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.pengembalian.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Kelola Pengembalian

                    </a>



                    <!-- Log Aktivitas -->

                    <a
                        href="{{ route('admin.log.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.log.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Log Aktivitas

                    </a>

                    {{-- Laporan --}}

                    <a
                        href="{{ route('admin.laporan.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('admin.laporan.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Laporan

                    </a>


                @endif



                <!-- =================================
                     MENU KHUSUS PETUGAS
                ================================== -->

                @if(auth()->user()->role == 'petugas')


                    <!-- Persetujuan Peminjaman -->

                    <a
                        href="{{ route('petugas.peminjaman.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('petugas.peminjaman.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Persetujuan Peminjaman

                    </a>



                    <!-- Pemantauan Pengembalian -->

                    <a
                        href="{{ route('petugas.pengembalian.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('petugas.pengembalian.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Pemantauan Pengembalian

                    </a>



                    <!-- Cetak Laporan -->

                    <a
                        href="{{ route('petugas.laporan.index') }}"
                        data-sidebar-link
                        class="
                            block
                            px-4
                            py-2
                            rounded-lg
                            transition
                            {{ request()->routeIs('petugas.laporan.*')
                                ? 'bg-transparent text-white font-medium'
                                : 'text-gray-400 hover:bg-gray-800 hover:text-white'
                            }}
                        "
                    >

                        Cetak Laporan

                    </a>


                @endif


            </nav>



            <!-- =================================
                 INFORMASI USER
            ================================== -->

            <div
                class="p-4 border-t border-gray-800 text-sm text-gray-400"
            >

                <div class="text-xs text-gray-500 mb-1">

                    Login sebagai

                </div>


                <div class="text-white font-semibold">

                    {{ ucfirst(auth()->user()->role) }}

                </div>


                <div class="text-xs text-gray-500 mt-1">

                    {{ auth()->user()->namee }}

                </div>

            </div>


        </aside>



        <!-- =====================================
             MAIN CONTENT
        ====================================== -->

        <div
            class="flex-1 flex flex-col overflow-y-auto bg-transparent"
        >


            <!-- =================================
                 NAVBAR
            ================================== -->

            <header
                class="
                    fixed
                    top-0
                    right-0
                    left-64
                    z-50
                    bg-gray-100
                    border-b
                    border-gray-200
                    h-16
                    flex
                    items-center
                    justify-between
                    px-6
                "
            >


                <!-- Judul -->

                <div class="flex items-center">

                    <h1
                        class="text-lg font-semibold text-gray-800"
                    >

                        @yield(
                            'header-title',
                            'Dashboard'
                        )

                    </h1>

                </div>



                <!-- User + Logout -->

                <div class="flex items-center gap-4">


                    <div
                        class="hidden sm:block text-right"
                    >

                        <p
                            class="text-sm font-semibold text-gray-800"
                        >

                            {{ auth()->user()->name }}

                        </p>


                        <p
                            class="text-xs text-gray-500 uppercase"
                        >

                            {{ auth()->user()->role }}

                        </p>

                    </div>



                    <!-- Logout -->

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="
                                px-4
                                py-2
                                bg-red-500
                                hover:bg-red-600
                                text-white
                                text-sm
                                font-semibold
                                rounded-lg
                                transition
                                duration-200
                            "
                        >

                            Logout

                        </button>

                    </form>


                </div>


            </header>



            <!-- =================================
                 KONTEN UTAMA
            ================================== -->

            <main
                id="page-content"
                class="flex-1 p-6 pt-20 page-transition bg-transparent"
            >

                @yield('content')

            </main>


        </div>


    </div>



    <!-- =========================================
         JAVASCRIPT
    ========================================== -->

    <script>


        /* =========================================
           PAGE TRANSITION
        ========================================== */

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                const pageContent =
                    document.getElementById(
                        'page-content'
                    );


                if (!pageContent) return;


                document.addEventListener(
                    'click',
                    function (event) {


                        const link =
                            event.target.closest('a');


                        if (!link) return;


                        const href =
                            link.getAttribute('href');


                        // Abaikan link tertentu

                        if (
                            !href ||
                            href.startsWith('#') ||
                            href.startsWith('javascript:') ||
                            link.target === '_blank' ||
                            link.hasAttribute('download') ||
                            event.ctrlKey ||
                            event.shiftKey ||
                            event.altKey ||
                            event.metaKey
                        ) {

                            return;

                        }


                        const url =
                            new URL(
                                link.href,
                                window.location.origin
                            );


                        // Abaikan external link

                        if (
                            url.origin !==
                            window.location.origin
                        ) {

                            return;

                        }


                        // Halaman yang sama

                        if (
                            url.href ===
                            window.location.href
                        ) {

                            return;

                        }


                        event.preventDefault();


                        // Animasi keluar

                        pageContent.classList.remove(
                            'page-transition'
                        );

                        pageContent.classList.add(
                            'page-exit'
                        );


                        // Pindah halaman

                        setTimeout(
                            function () {

                                window.location.href =
                                    link.href;

                            },
                            200
                        );

                    }
                );


            }
        );

        /* =========================================
           SIDEBAR ACTIVE MENU
        ========================================== */

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                const nav =
                    document.getElementById(
                        'sidebar-nav'
                    );


                const activeBg =
                    document.getElementById(
                        'sidebar-active-bg'
                    );


                const activeLine =
                    document.getElementById(
                        'sidebar-active-line'
                    );


                const links =
                    document.querySelectorAll(
                        '[data-sidebar-link]'
                    );


                if (
                    !nav ||
                    !activeBg ||
                    !activeLine ||
                    !links.length
                ) {

                    return;

                }



                /* =================================
                   PINDAHKAN INDIKATOR
                ================================== */

                function moveIndicator(
                    link,
                    animate = true
                ) {


                    const navRect =
                        nav.getBoundingClientRect();


                    const linkRect =
                        link.getBoundingClientRect();


                    const top =
                        linkRect.top -
                        navRect.top;


                    const left =
                        linkRect.left -
                        navRect.left;



                    /* ==============================
                       BACKGROUND
                    ============================== */

                    activeBg.style.top =
                        `${top}px`;


                    activeBg.style.left =
                        `${left}px`;


                    activeBg.style.width =
                        `${linkRect.width}px`;


                    activeBg.style.height =
                        `${linkRect.height}px`;

                    /* ==============================
                       TRANSITION
                    ============================== */

                    if (animate) {

                        activeBg.style.transition =
                            'none';

                        activeLine.style.transition =
                            'none';

                    } else {

                        activeBg.style.transition =
                            'none';

                        activeLine.style.transition =
                            'none';


                        requestAnimationFrame(
                            () => {

                                activeBg.style.transition =
                                    'all 300ms ease-out';

                                activeLine.style.transition =
                                    'all 300ms ease-out';

                            }
                        );

                    }

                }



                /* =================================
                   CARI MENU AKTIF
                ================================== */

                const activeLink =
                    document.querySelector(
                        '[data-sidebar-link].text-white'
                    );


                if (activeLink) {

                    moveIndicator(
                        activeLink,
                        false
                    );

                }



                /* =================================
                   SAAT MENU DIKLIK
                ================================== */

                links.forEach(
                    link => {


                        link.addEventListener(
                            'click',
                            function (event) {


                                if (
                                    event.ctrlKey ||
                                    event.shiftKey ||
                                    event.altKey ||
                                    event.metaKey ||
                                    link.target === '_blank'
                                ) {

                                    return;

                                }


                                const href =
                                    link.href;


                                if (!href) {

                                    return;

                                }


                                const url =
                                    new URL(
                                        href,
                                        window.location.origin
                                    );


                                if (
                                    url.origin !==
                                    window.location.origin
                                ) {

                                    return;

                                }


                                if (
                                    url.href ===
                                    window.location.href
                                ) {

                                    return;

                                }


                                event.preventDefault();



                                /* =================
                                   GESER INDIKATOR
                                ================== */

                                moveIndicator(
                                    link,
                                    true
                                );



                                /* =================
                                   PAGE EXIT
                                ================== */

                                const pageContent =
                                    document.getElementById(
                                        'page-content'
                                    );


                                if (pageContent) {

                                    pageContent.classList.remove(
                                        'page-transition'
                                    );

                                    pageContent.classList.add(
                                        'page-exit'
                                    );

                                }



                                /* =================
                                   PINDAH HALAMAN
                                ================== */

                                setTimeout(
                                    () => {

                                        window.location.href =
                                            href;

                                    },
                                    300
                                );

                            }
                        );

                    }
                );



                /* =================================
                   RESPONSIVE
                ================================== */

                window.addEventListener(
                    'resize',
                    function () {


                        const current =
                            document.querySelector(
                                '[data-sidebar-link].text-white'
                            );


                        if (current) {

                            moveIndicator(
                                current,
                                false
                            );

                        }

                    }
                );


            }
        );

    </script>


</body>

</html>