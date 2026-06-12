<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Rental Kendaraan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(14, 165, 233, 0.08), transparent 30%),
                linear-gradient(180deg, #f8fbff 0%, #eef4fb 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen text-slate-800">
    <div id="sidebarBackdrop" class="fixed inset-0 z-30 hidden bg-slate-950/50 backdrop-blur-sm lg:hidden" onclick="closeSidebar()"></div>

    <div class="flex min-h-screen">
        <aside id="sidebarDrawer" class="fixed inset-y-0 left-0 z-40 flex w-72 shrink-0 -translate-x-full flex-col border-r border-slate-200 bg-slate-900 text-slate-100 transition-transform duration-300 ease-out lg:sticky lg:top-0 lg:z-auto lg:h-screen lg:translate-x-0 lg:overflow-y-auto">
            <div class="border-b border-white/10 px-6 py-6">
                <div class="text-xs uppercase tracking-[0.35em] text-sky-300">Sistem Rental</div>
                <div class="mt-2 text-2xl font-extrabold">Sistem Rental Kendaraan</div>
                <p class="mt-2 text-sm text-slate-400">Motor dan mobil dalam satu panel modern.</p>
            </div>

            <nav class="flex-1 space-y-2 px-4 py-6 text-sm">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('dashboard') ? 'bg-sky-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('kendaraan.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('kendaraan.*') ? 'bg-sky-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>Kendaraan</span>
                </a>
                <a href="{{ route('customers.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('customers.*') ? 'bg-sky-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>Customer</span>
                </a>
                <a href="{{ route('rentals.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('rentals.*') ? 'bg-sky-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>Rental</span>
                </a>
                <a href="{{ route('admins.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('admins.*') ? 'bg-sky-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>Tambah Admin</span>
                </a>
                <a href="{{ route('reports.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('reports.*') ? 'bg-sky-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>Laporan</span>
                </a>
                <a href="{{ route('home-settings.edit') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('home-settings.*') ? 'bg-sky-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>Setting Home</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="button" onclick="openLogoutModal()" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left text-slate-300 transition hover:bg-rose-500/10 hover:text-rose-300">
                        <span>Logout</span>
                    </button>
                </form>
            </nav>

            <div class="border-t border-white/10 px-6 py-5 text-xs text-slate-400">
                Siap digunakan untuk operasional rental harian.
            </div>
        </aside>

        <div class="flex-1 min-w-0">
            <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/80 backdrop-blur">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Dashboard</p>
                        <h1 class="text-xl font-bold text-slate-900">@yield('header', 'Sistem Rental Kendaraan')</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" id="sidebarToggle" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-sky-300 hover:bg-sky-50 lg:hidden" aria-controls="sidebarDrawer" aria-expanded="false" onclick="toggleSidebar()" aria-label="Buka menu sidebar">
                            <span class="flex flex-col items-center justify-center gap-1.5" aria-hidden="true">
                                <span class="h-1 w-1 rounded-full bg-current"></span>
                                <span class="h-1 w-1 rounded-full bg-current"></span>
                                <span class="h-1 w-1 rounded-full bg-current"></span>
                            </span>
                        </button>

                        <a href="{{ route('profile.index') }}" class="hidden items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-2 transition hover:border-sky-300 hover:bg-sky-50 md:flex">
                            @if(auth()->user()?->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Admin" class="h-10 w-10 rounded-full object-cover ring-2 ring-slate-200">
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-200 text-sm font-bold text-slate-700 ring-2 ring-slate-200">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                </div>
                            @endif

                            <div>
                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-400">Profile Admin</p>
                                <p class="text-sm font-semibold text-slate-700">{{ auth()->user()->name ?? 'Guest' }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </header>

            <main class="px-4 py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div id="logoutModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm" onclick="closeLogoutModal()"></div>
        <div class="relative w-full max-w-sm overflow-hidden rounded-[1.75rem] border border-white/10 bg-slate-900 text-white shadow-[0_28px_80px_rgba(2,6,23,0.45)]">
            <div class="h-1 bg-gradient-to-r from-sky-400 via-cyan-400 to-emerald-400"></div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-sky-300 ring-1 ring-white/10">
                        <span class="text-lg font-bold">?</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Konfirmasi keluar</p>
                        <h2 class="mt-2 text-xl font-bold tracking-tight text-white">Yakin ingin logout?</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-300">Kamu akan keluar dari sesi admin dan perlu login lagi untuk kembali.</p>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-300">
                    Simpan dulu pekerjaan yang masih terbuka sebelum keluar.
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" onclick="closeLogoutModal()" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-white/10 hover:text-white">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-2xl bg-sky-400 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-sky-300">
                            Ya, keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
    <script>
        const logoutModal = document.getElementById('logoutModal');
        const sidebarDrawer = document.getElementById('sidebarDrawer');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const sidebarToggle = document.getElementById('sidebarToggle');

        function openSidebar() {
            sidebarDrawer.classList.remove('-translate-x-full');
            sidebarBackdrop.classList.remove('hidden');
            sidebarToggle?.setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
            sidebarDrawer.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
            sidebarToggle?.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
        }

        function toggleSidebar() {
            if (sidebarDrawer.classList.contains('-translate-x-full')) {
                openSidebar();
                return;
            }

            closeSidebar();
        }

        function openLogoutModal() {
            logoutModal.classList.remove('hidden');
            logoutModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeLogoutModal() {
            logoutModal.classList.add('hidden');
            logoutModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !sidebarDrawer.classList.contains('-translate-x-full')) {
                closeSidebar();
            }

            if (event.key === 'Escape' && !logoutModal.classList.contains('hidden')) {
                closeLogoutModal();
            }
        });

        document.querySelectorAll('#sidebarDrawer a, #sidebarDrawer button[type="submit"]').forEach((item) => {
            item.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>
</html>
