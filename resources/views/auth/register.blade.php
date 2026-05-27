@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <div class="rounded-[2rem] bg-white p-8 shadow-2xl ring-1 ring-slate-200 lg:p-10">
        <h2 class="text-2xl font-bold text-slate-900">Buat Akun</h2>
        <p class="mt-2 text-sm text-slate-500">Daftar sebagai user untuk melihat kendaraan dan memakai sistem sesuai akses yang diberikan.</p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 grid gap-5">
            @csrf
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                <input type="password" name="password" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
            </div>
            <button class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Daftar</button>
            <a href="{{ route('login') }}" class="text-center text-sm text-sky-700 hover:underline">Sudah punya akun? Login</a>
        </form>
    </div>
@endsection
