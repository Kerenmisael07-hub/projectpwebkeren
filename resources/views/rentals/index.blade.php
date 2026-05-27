@extends('layouts.app')

@section('title', 'Rental')
@section('header', 'Data Rental')

@section('content')
    <div class="mb-6 flex items-center justify-between rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm text-slate-500">Input transaksi, status, dan PDF rental.</p>
        <a href="{{ route('rentals.create') }}" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Buat Rental</a>
    </div>

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Kendaraan</th>
                        <th class="px-6 py-4">Sewa</th>
                        <th class="px-6 py-4">Kembali</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Denda</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($rentals as $rental)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $rental->customer?->nama }}</td>
                            <td class="px-6 py-4">{{ $rental->kendaraan?->nama }}</td>
                            <td class="px-6 py-4">{{ $rental->tgl_sewa?->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">{{ $rental->tgl_kembali?->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($rental->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($rental->denda, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $rental->status === 'aktif' ? 'bg-slate-100 text-slate-700' : ($rental->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700') }}">{{ ucfirst($rental->status) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 whitespace-nowrap">
                                    <a href="{{ route('rentals.edit', $rental) }}" class="rounded-xl bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700">Edit</a>
                                    <a href="{{ route('rentals.buktiSewa', $rental) }}" class="rounded-xl bg-sky-100 px-3 py-2 text-xs font-semibold text-sky-800">Bukti Sewa</a>
                                    <form action="{{ route('rentals.destroy', $rental) }}" method="POST" onsubmit="return confirm('Hapus rental ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl bg-rose-100 px-3 py-2 text-xs font-semibold text-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-slate-500">Belum ada data rental.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $rentals->links() }}</div>
@endsection
