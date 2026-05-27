@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
    <div class="rounded-[2rem] bg-white p-8 shadow-2xl ring-1 ring-slate-200 lg:p-10">
        <h2 class="text-2xl font-bold text-slate-900">Reset Password</h2>
        <p class="mt-2 text-sm text-slate-500">Silakan buat password baru.</p>

        <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $request->email) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Password Baru</label>
                <input type="password" name="password" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
            </div>
            <button class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Reset Password</button>
        </form>
    </div>
@endsection
