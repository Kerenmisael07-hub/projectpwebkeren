@extends('layouts.guest')

@section('title', 'Lupa Password')

@section('content')
    <div class="rounded-[2rem] bg-white p-8 shadow-2xl ring-1 ring-slate-200 lg:p-10">
        <h2 class="text-2xl font-bold text-slate-900">Lupa Password</h2>
        <p class="mt-2 text-sm text-slate-500">Kami akan mengirim link reset ke email Anda.</p>

        <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
            </div>
            <button class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Kirim Link Reset</button>
            <a href="{{ route('login') }}" class="block text-center text-sm text-sky-700 hover:underline">Kembali ke login</a>
        </form>
    </div>
@endsection
