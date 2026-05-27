<?php

namespace App\Exports;

use App\Models\Rental;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RentalExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Rental::with(['customer', 'kendaraan'])->orderByDesc('created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer',
            'Kendaraan',
            'Tanggal Sewa',
            'Tanggal Kembali',
            'Total',
            'Denda',
            'Status',
            'Dibuat',
        ];
    }

    public function map($rental): array
    {
        return [
            $rental->id,
            $rental->customer?->nama,
            $rental->kendaraan?->nama,
            Carbon::parse($rental->tgl_sewa)->format('d-m-Y'),
            Carbon::parse($rental->tgl_kembali)->format('d-m-Y'),
            $rental->total,
            $rental->denda,
            $rental->status,
            $rental->created_at?->format('d-m-Y H:i'),
        ];
    }
}
