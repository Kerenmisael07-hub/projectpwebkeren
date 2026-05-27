<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard User') - Sistem Rental Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(14, 165, 233, 0.12), transparent 30%),
                linear-gradient(180deg, #f8fbff 0%, #eef4fb 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen text-slate-800">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 shrink-0 flex-col border-r border-slate-200 bg-white/85 text-slate-800 lg:sticky lg:top-0 lg:flex lg:h-screen lg:overflow-y-auto">
            <div class="border-b border-slate-200 px-6 py-6">
                <div class="text-xs uppercase tracking-[0.35em] text-sky-700">User Panel</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">Sistem Rental Kendaraan</div>
                <p class="mt-2 text-sm text-slate-500">Akses ringan untuk melihat kendaraan tersedia.</p>
            </div>

            <nav class="flex-1 space-y-2 px-4 py-6 text-sm">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('dashboard') ? 'bg-sky-500 text-white font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('kendaraan.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 transition {{ request()->routeIs('kendaraan.*') ? 'bg-sky-500 text-white font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>Kendaraan</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left text-slate-600 transition hover:bg-rose-50 hover:text-rose-600">
                        <span>Logout</span>
                    </button>
                </form>
            </nav>

            <div class="border-t border-slate-200 px-6 py-5 text-xs text-slate-500">
                Mode user hanya bisa melihat data kendaraan.
            </div>
        </aside>

        <div class="flex-1 min-w-0">
            <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/80 backdrop-blur">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">User Dashboard</p>
                        <h1 class="text-xl font-bold text-slate-900">@yield('header', 'Sistem Rental Kendaraan')</h1>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sky-100 text-sm font-bold text-sky-800">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-400">User</p>
                            <p class="text-sm font-semibold text-slate-700">{{ auth()->user()->name ?? 'Guest' }}</p>
                        </div>
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
</body>
</html>