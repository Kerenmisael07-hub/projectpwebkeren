@extends('layouts.user')

@section('title', 'Kendaraan')
@section('header', 'Daftar Kendaraan')

@section('content')
    <div class="mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('kendaraan.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request('tipe') ? 'bg-slate-100 text-slate-600' : 'bg-sky-500 text-white' }}">Semua</a>
            <a href="{{ route('kendaraan.index', ['tipe' => 'motor']) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request('tipe') === 'motor' ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-600' }}">Motor</a>
            <a href="{{ route('kendaraan.index', ['tipe' => 'mobil']) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request('tipe') === 'mobil' ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-600' }}">Mobil</a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse($kendaraan as $item)
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="h-48 w-full object-cover">
                @else
                    <div class="flex h-48 items-center justify-center bg-slate-100 text-sm text-slate-400">Tidak ada gambar</div>
                @endif
                <div class="p-5">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="text-base font-bold text-slate-900">{{ $item->nama }}</h3>
                        <span class="rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-800">{{ ucfirst($item->tipe) }}</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }} / hari</p>
                    <p class="mt-2 text-xs text-slate-500">Status: {{ ucfirst($item->status) }}</p>
                    @if($item->keterangan)
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item->keterangan }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500 md:col-span-2 xl:col-span-3">
                Belum ada data kendaraan.
            </div>
        @endforelse
    </div>

    <div class="mt-6">{{ $kendaraan->links() }}</div>
@endsection