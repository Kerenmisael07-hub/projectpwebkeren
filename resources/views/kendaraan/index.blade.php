@extends('layouts.app')

@section('title', 'Kendaraan')
@section('header', 'Data Kendaraan')

@section('content')
    <div class="mb-6 flex flex-col gap-4 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-200 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('kendaraan.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request('tipe') ? 'bg-slate-100 text-slate-600' : 'bg-sky-500 text-white' }}">Semua</a>
            <a href="{{ route('kendaraan.index', ['tipe' => 'motor']) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request('tipe') === 'motor' ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-600' }}">Motor</a>
            <a href="{{ route('kendaraan.index', ['tipe' => 'mobil']) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request('tipe') === 'mobil' ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-600' }}">Mobil</a>
        </div>
        <a href="{{ route('kendaraan.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Tambah Kendaraan</a>
    </div>

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Gambar</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4">Harga/Hari</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kendaraan as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="h-20 w-20 rounded-2xl object-cover ring-1 ring-slate-200" alt="{{ $item->nama }}">
                                @else
                                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-slate-100 text-xs text-slate-400">No Image</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $item->nama }}</td>
                            <td class="px-6 py-4 capitalize">{{ $item->tipe }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $item->status === 'tersedia' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('kendaraan.edit', $item) }}" class="rounded-xl bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700">Edit</a>
                                    <form action="{{ route('kendaraan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus kendaraan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl bg-rose-100 px-3 py-2 text-xs font-semibold text-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">Belum ada data kendaraan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $kendaraan->links() }}</div>
@endsection
