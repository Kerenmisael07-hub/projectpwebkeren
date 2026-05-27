@extends('layouts.app')

@section('title', 'Customer')
@section('header', 'Data Customer')

@section('content')
    <div class="mb-6 flex items-center justify-between rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm text-slate-500">Kelola data pelanggan rental.</p>
        <a href="{{ route('customers.create') }}" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Tambah Customer</a>
    </div>

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">No HP</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $customer->nama }}</td>
                            <td class="px-6 py-4">{{ $customer->email }}</td>
                            <td class="px-6 py-4">{{ $customer->no_hp }}</td>
                            <td class="px-6 py-4">{{ $customer->alamat }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('customers.edit', $customer) }}" class="rounded-xl bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Hapus customer ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl bg-rose-100 px-3 py-2 text-xs font-semibold text-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada data customer.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $customers->links() }}</div>
@endsection
