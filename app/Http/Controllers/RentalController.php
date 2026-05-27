<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Kendaraan;
use App\Models\Rental;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RentalController extends Controller
{
    public function index(): View
    {
        $rentals = Rental::with(['customer', 'kendaraan'])->latest()->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    public function create(): View
    {
        $customers = Customer::orderBy('nama')->get();
        $kendaraan = Kendaraan::where('status', 'tersedia')->orderBy('nama')->get();

        return view('rentals.create', compact('customers', 'kendaraan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'kendaraan_id' => ['required', Rule::exists('kendaraan', 'id')->where('status', 'tersedia')],
            'tgl_sewa' => ['required', 'date'],
            'tgl_kembali' => ['required', 'date', 'after_or_equal:tgl_sewa'],
        ]);

        $kendaraan = Kendaraan::findOrFail($data['kendaraan_id']);
        $lamaSewa = $this->hitungLamaSewa($data['tgl_sewa'], $data['tgl_kembali']);
        $total = $lamaSewa * (int) $kendaraan->harga_per_hari;

        DB::transaction(function () use ($data, $total, $kendaraan) {
            Rental::create([
                'customer_id' => $data['customer_id'],
                'kendaraan_id' => $kendaraan->id,
                'tgl_sewa' => $data['tgl_sewa'],
                'tgl_kembali' => $data['tgl_kembali'],
                'total' => $total,
                'denda' => 0,
                'status' => 'aktif',
            ]);

            $kendaraan->update(['status' => 'disewa']);
        });

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dibuat.');
    }

    public function edit(Rental $rental): View
    {
        $customers = Customer::orderBy('nama')->get();
        $kendaraanList = Kendaraan::orderBy('nama')->get();

        return view('rentals.edit', compact('rental', 'customers', 'kendaraanList'));
    }

    public function update(Request $request, Rental $rental): RedirectResponse
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'kendaraan_id' => ['required', 'exists:kendaraan,id'],
            'tgl_sewa' => ['required', 'date'],
            'tgl_kembali' => ['required', 'date', 'after_or_equal:tgl_sewa'],
            'status' => ['required', 'in:aktif,selesai,terlambat'],
        ]);

        $kendaraanBaru = Kendaraan::findOrFail($data['kendaraan_id']);
        $lamaSewa = $this->hitungLamaSewa($data['tgl_sewa'], $data['tgl_kembali']);
        $total = $lamaSewa * (int) $kendaraanBaru->harga_per_hari;
        $denda = $data['status'] === 'terlambat'
            ? $this->hitungDenda($data['tgl_kembali'], true)
            : 0;

        DB::transaction(function () use ($rental, $data, $kendaraanBaru, $total, $denda) {
            $kendaraanLama = Kendaraan::find($rental->kendaraan_id);

            if ($kendaraanLama && $kendaraanLama->id !== $kendaraanBaru->id) {
                $kendaraanLama->update(['status' => 'tersedia']);
            }

            $rental->update([
                'customer_id' => $data['customer_id'],
                'kendaraan_id' => $kendaraanBaru->id,
                'tgl_sewa' => $data['tgl_sewa'],
                'tgl_kembali' => $data['tgl_kembali'],
                'total' => $total,
                'denda' => $denda,
                'status' => $data['status'],
            ]);

            if ($data['status'] === 'aktif') {
                $kendaraanBaru->update(['status' => 'disewa']);
            } else {
                $kendaraanBaru->update(['status' => 'tersedia']);
            }
        });

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil diperbarui.');
    }

    public function destroy(Rental $rental): RedirectResponse
    {
        DB::transaction(function () use ($rental) {
            $kendaraan = Kendaraan::find($rental->kendaraan_id);

            if ($kendaraan) {
                $kendaraan->update(['status' => 'tersedia']);
            }

            $rental->delete();
        });

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dihapus.');
    }

    public function buktiSewa(Rental $rental)
    {
        $rental->load(['customer', 'kendaraan']);

        $pdf = Pdf::loadView('reports.bukti-sewa', compact('rental'));

        return $pdf->stream('bukti-sewa.pdf');
    }

    private function hitungLamaSewa(string $tglSewa, string $tglKembali): int
    {
        return max(1, Carbon::parse($tglSewa)->startOfDay()->diffInDays(Carbon::parse($tglKembali)->startOfDay()) + 1);
    }

    private function hitungDenda(string $tglKembali, bool $minimalSatuHari = false): int
    {
        $jatuhTempo = Carbon::parse($tglKembali)->startOfDay();

        if (Carbon::now()->startOfDay()->lte($jatuhTempo)) {
            return $minimalSatuHari ? 50000 : 0;
        }

        return Carbon::now()->startOfDay()->diffInDays($jatuhTempo) * 50000;
    }
}
