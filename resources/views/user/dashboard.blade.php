@extends('layouts.user')

@section('title', 'Dashboard User')
@section('header', 'Dashboard User')

@section('content')
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-500">Kendaraan Tersedia</p>
            <div class="mt-3 text-3xl font-black text-slate-900">{{ $totalTersedia }}</div>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-500">Total Motor</p>
            <div class="mt-3 text-3xl font-black text-slate-900">{{ $totalMotor }}</div>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-500">Total Mobil</p>
            <div class="mt-3 text-3xl font-black text-slate-900">{{ $totalMobil }}</div>
        </div>
    </div>

    <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Kendaraan Tersedia</h2>
                <p class="text-sm text-slate-500">Daftar kendaraan yang bisa dilihat oleh user.</p>
            </div>
            <a href="{{ route('kendaraan.index') }}" class="rounded-2xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white">Lihat Semua</a>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($availableVehicles as $item)
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-slate-50">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="h-44 w-full object-cover">
                    @else
                        <div class="flex h-44 items-center justify-center bg-slate-100 text-sm text-slate-400">Tidak ada gambar</div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-base font-bold text-slate-900">{{ $item->nama }}</h3>
                            <span class="rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-800">{{ ucfirst($item->tipe) }}</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }} / hari</p>
                        <p class="mt-2 text-xs text-slate-500">Status: {{ ucfirst($item->status) }}</p>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-slate-500 md:col-span-2 xl:col-span-3">
                    Belum ada kendaraan yang tersedia.
                </div>
            @endforelse
        </div>
    </div>
@endsection