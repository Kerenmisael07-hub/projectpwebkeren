@extends('layouts.app')

@section('title', 'Laporan')
@section('header', 'Laporan Rental')

@section('content')
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-bold text-slate-900">Export Data</h2>
            <p class="mt-2 text-sm text-slate-500">Unduh semua data rental ke Excel.</p>
            <a href="{{ route('reports.excel') }}" class="mt-5 inline-flex rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Download laporan.xlsx</a>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-bold text-slate-900">PDF Rental</h2>
            <p class="mt-2 text-sm text-slate-500">Unduh PDF dari tombol <strong>PDF</strong> pada setiap data di halaman rental.</p>
            <a href="{{ route('rentals.index') }}" class="mt-5 inline-flex rounded-2xl bg-sky-100 px-5 py-3 text-sm font-semibold text-sky-800">Buka Halaman Rental</a>
        </div>
    </div>
@endsection
