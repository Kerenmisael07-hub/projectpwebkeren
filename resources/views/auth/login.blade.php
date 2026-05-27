@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="overflow-hidden rounded-[2rem] bg-white shadow-2xl ring-1 ring-slate-200">
        <div class="grid lg:grid-cols-2">
            <div class="hidden bg-slate-900 p-8 text-white lg:block">
                <div class="text-xs uppercase tracking-[0.35em] text-sky-200">Sistem Rental</div>
                <h1 class="mt-4 text-4xl font-black leading-tight">Masuk untuk mengelola seluruh operasional rental.</h1>
                <p class="mt-4 text-sm text-slate-300">Panel ini dipakai untuk mengatur armada, customer, transaksi, bukti sewa, laporan, dan data akun dalam satu alur kerja yang rapi.</p>
                <div class="mt-8 grid grid-cols-2 gap-4 text-sm">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-slate-400">Akses</p>
                        <p class="mt-1 font-semibold text-white">Akun terdaftar</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-slate-400">Fokus</p>
                        <p class="mt-1 font-semibold text-white">Operasional rental</p>
                    </div>
                </div>
            </div>

            <div class="p-8 lg:p-10">
                <h2 class="text-2xl font-bold text-slate-900">Login</h2>
                <p class="mt-2 text-sm text-slate-500">Gunakan akun yang sudah terdaftar untuk melanjutkan ke dashboard.</p>

                @if (session('success'))
                    <div class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                    @csrf
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <input type="password" name="password" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="rounded border border-slate-300 text-sky-600 focus:ring-sky-500">
                        Ingat saya
                    </label>
                    <button class="w-full rounded-2xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-sky-500">Masuk</button>
                    <div class="flex items-center justify-end text-sm">
                        <a href="{{ route('password.request') }}" class="text-sky-700 hover:underline">Lupa password?</a>
                    </div>
                    <div class="pt-2 text-center text-sm text-slate-500">
                        Belum punya akun user?
                        <a href="{{ route('register') }}" class="font-semibold text-sky-700 hover:underline">Daftar di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
