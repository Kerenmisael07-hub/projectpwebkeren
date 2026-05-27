<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Rental Kendaraan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top, rgba(6, 182, 212, 0.15), transparent 35%), linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen text-slate-800">
    <div class="flex min-h-screen items-center justify-center px-4 py-10">
        <div class="w-full max-w-2xl">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
