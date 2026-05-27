@extends('layouts.app')

@section('title', 'Tambah Admin')
@section('header', 'Tambah Admin')

@section('content')
    <div class="grid gap-6 xl:grid-cols-[0.95fr_1.05fr]">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-700">Form admin</p>
            <h2 class="mt-3 text-2xl font-bold text-slate-900">Tambah akun admin baru</h2>
            <p class="mt-3 text-sm leading-7 text-slate-500">Menu ini dipakai untuk menambah admin yang berhak masuk ke dashboard dan mengelola rental kendaraan.</p>

            <form method="POST" action="{{ route('admins.store') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Admin</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Email Admin</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                    <input type="password" name="password" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <button class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Simpan Admin</button>
            </form>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-700">Daftar admin</p>
            <h2 class="mt-3 text-2xl font-bold text-slate-900">Admin yang aktif</h2>
            <p class="mt-3 text-sm leading-7 text-slate-500">Daftar ini membantu melihat akun admin yang sudah terdaftar di sistem.</p>

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-slate-500">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Nama</th>
                            <th class="px-4 py-3 font-semibold">Email</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse ($admins as $admin)
                            <tr>
                                <td class="px-4 py-3 font-semibold text-slate-900">{{ $admin->name }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $admin->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-800">Admin</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-slate-500">Belum ada admin yang terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection