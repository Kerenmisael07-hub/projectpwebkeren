<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'kendaraan_id',
        'tgl_sewa',
        'tgl_kembali',
        'total',
        'denda',
        'status',
    ];

    protected $casts = [
        'tgl_sewa' => 'date',
        'tgl_kembali' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function getLamaSewaAttribute(): int
    {
        return Carbon::parse($this->tgl_sewa)->startOfDay()->diffInDays(Carbon::parse($this->tgl_kembali)->startOfDay()) + 1;
    }

    public function getTotalAkhirAttribute(): int
    {
        return (int) $this->total + (int) $this->denda;
    }
}
