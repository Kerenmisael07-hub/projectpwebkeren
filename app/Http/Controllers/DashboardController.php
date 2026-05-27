<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Kendaraan;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        if (! auth()->user()?->isAdmin()) {
            $availableVehicles = Kendaraan::where('status', 'tersedia')
                ->latest()
                ->take(6)
                ->get();

            return view('user.dashboard', [
                'totalTersedia' => Kendaraan::where('status', 'tersedia')->count(),
                'totalMotor' => Kendaraan::where('tipe', 'motor')->count(),
                'totalMobil' => Kendaraan::where('tipe', 'mobil')->count(),
                'availableVehicles' => $availableVehicles,
            ]);
        }

        $totalKendaraan = Kendaraan::count();
        $totalCustomer = Customer::count();
        $totalTransaksi = Rental::count();
        $totalPendapatan = Rental::sum('total') + Rental::sum('denda');

        $months = [];
        $monthlyTransactions = [];
        $monthlyRevenue = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i)->startOfMonth();
            $months[] = $date->format('M Y');

            $rangeStart = $date->copy()->startOfMonth();
            $rangeEnd = $date->copy()->endOfMonth();

            $monthlyTransactions[] = Rental::whereBetween('created_at', [$rangeStart, $rangeEnd])->count();
            $monthlyRevenue[] = Rental::whereBetween('created_at', [$rangeStart, $rangeEnd])->sum(DB::raw('total + denda'));
        }

        $topVehiclesData = Rental::query()
            ->join('kendaraan', 'rentals.kendaraan_id', '=', 'kendaraan.id')
            ->select('kendaraan.nama', DB::raw('COUNT(rentals.id) as total_rental'))
            ->groupBy('kendaraan.nama')
            ->orderByDesc('total_rental')
            ->limit(5)
            ->get();

        $topVehicleLabels = $topVehiclesData->pluck('nama')->values();
        $topVehicleCounts = $topVehiclesData->pluck('total_rental')->values();

        return view('dashboard.index', compact(
            'totalKendaraan',
            'totalCustomer',
            'totalTransaksi',
            'totalPendapatan',
            'months',
            'monthlyTransactions',
            'monthlyRevenue',
            'topVehicleLabels',
            'topVehicleCounts'
        ));
    }
}
