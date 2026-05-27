@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard Utama')

@push('styles')
    <style>
        .dashboard-surface {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.88) 0%, rgba(248, 250, 252, 0.96) 100%);
        }

        .dashboard-card {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.16);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 18px 32px rgba(15, 23, 42, 0.05);
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: #0ea5e9;
        }

        .dashboard-card-muted::before {
            background: #94a3b8;
        }

        .dashboard-card-teal::before {
            background: #0f766e;
        }

        .dashboard-card-amber::before {
            background: #d97706;
        }

        .dashboard-card-slate::before {
            background: #2563eb;
        }

        .dashboard-panel {
            border: 1px solid rgba(148, 163, 184, 0.14);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.05);
        }

        .dashboard-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 999px;
            padding: 0.45rem 0.8rem;
            background: #f8fafc;
            border: 1px solid rgba(148, 163, 184, 0.14);
            color: #0f172a;
        }

        .dashboard-action {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        }

        .dashboard-action-alt {
            background: #f8fafc;
            color: #0f172a;
            border: 1px solid rgba(148, 163, 184, 0.18);
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-surface grid gap-4 rounded-[2rem] p-4 sm:grid-cols-2 sm:p-5 xl:grid-cols-4">
        <div class="dashboard-card dashboard-card-slate rounded-3xl p-6">
            <div class="dashboard-badge">
                <span class="h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                Total Kendaraan
            </div>
            <div class="mt-4 text-3xl font-black text-slate-900">{{ $totalKendaraan }}</div>
            <p class="mt-2 text-sm text-slate-500">Armada aktif yang siap disewakan.</p>
        </div>
        <div class="dashboard-card dashboard-card-teal rounded-3xl p-6">
            <div class="dashboard-badge">
                <span class="h-2.5 w-2.5 rounded-full bg-teal-500"></span>
                Total Customer
            </div>
            <div class="mt-4 text-3xl font-black text-slate-900">{{ $totalCustomer }}</div>
            <p class="mt-2 text-sm text-slate-500">Pelanggan terdaftar dalam sistem.</p>
        </div>
        <div class="dashboard-card dashboard-card-amber rounded-3xl p-6">
            <div class="dashboard-badge">
                <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                Total Transaksi
            </div>
            <div class="mt-4 text-3xl font-black text-slate-900">{{ $totalTransaksi }}</div>
            <p class="mt-2 text-sm text-slate-500">Semua transaksi rental yang tercatat.</p>
        </div>
        <div class="dashboard-card dashboard-card-muted rounded-3xl p-6">
            <div class="dashboard-badge">
                <span class="h-2.5 w-2.5 rounded-full bg-slate-400"></span>
                Total Pendapatan
            </div>
            <div class="mt-3 text-3xl font-black text-slate-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <p class="mt-2 text-sm text-slate-500">Pendapatan bersih dari transaksi dan denda.</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <div class="dashboard-panel rounded-3xl p-6">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-slate-900">Transaksi Bulanan</h2>
                <p class="text-sm text-slate-500">Jumlah transaksi selama 6 bulan terakhir.</p>
            </div>
            <canvas id="transactionChart" height="120"></canvas>
        </div>

        <div class="dashboard-panel rounded-3xl p-6">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-slate-900">Pendapatan Bulanan</h2>
                <p class="text-sm text-slate-500">Akumulasi total + denda per bulan.</p>
            </div>
            <canvas id="revenueChart" height="120"></canvas>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-3">
        <div class="dashboard-panel rounded-3xl p-6 xl:col-span-2">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-slate-900">Kendaraan Terlaris</h2>
                <p class="text-sm text-slate-500">Top 5 kendaraan berdasarkan jumlah transaksi rental.</p>
            </div>
            <canvas id="topVehicleChart" height="120"></canvas>
        </div>

        <div class="dashboard-panel rounded-3xl p-6">
            <h2 class="text-lg font-bold text-slate-900">Akses Cepat</h2>
            <div class="mt-5 space-y-3 text-sm">
                <a href="{{ route('kendaraan.create') }}" class="dashboard-action block rounded-2xl px-4 py-3 font-semibold text-white">Tambah Kendaraan</a>
                <a href="{{ route('customers.create') }}" class="dashboard-action-alt block rounded-2xl px-4 py-3 font-semibold">Tambah Customer</a>
                <a href="{{ route('rentals.create') }}" class="dashboard-action block rounded-2xl px-4 py-3 font-semibold text-white">Buat Rental</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const transactionChart = document.getElementById('transactionChart');
    if (transactionChart) {
        new Chart(transactionChart, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Transaksi',
                    data: @json($monthlyTransactions),
                    borderColor: '#0f766e',
                    backgroundColor: 'rgba(15, 118, 110, 0.08)',
                    fill: true,
                    tension: 0.35,
                }],
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
            },
        });
    }

    const revenueChart = document.getElementById('revenueChart');
    if (revenueChart) {
        new Chart(revenueChart, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($monthlyRevenue),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.08)',
                    fill: true,
                    tension: 0.35,
                }],
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } },
            },
        });
    }

    const topVehicleChart = document.getElementById('topVehicleChart');
    if (topVehicleChart) {
        new Chart(topVehicleChart, {
            type: 'bar',
            data: {
                labels: @json($topVehicleLabels),
                datasets: [{
                    label: 'Jumlah Rental',
                    data: @json($topVehicleCounts),
                    borderRadius: 8,
                    backgroundColor: ['#0f766e', '#14b8a6', '#0284c7', '#38bdf8', '#94a3b8'],
                }],
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } },
                    x: { ticks: { autoSkip: false } },
                },
            },
        });
    }
</script>
@endpush
