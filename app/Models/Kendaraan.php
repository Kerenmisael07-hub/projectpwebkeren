<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';

    protected $fillable = [
        'nama',
        'tipe',
        'harga_per_hari',
        'status',
        'gambar',
        'keterangan',
    ];

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function getGambarUrlAttribute(): ?string
    {
        if (! $this->gambar) {
            return null;
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://', 'assets/', 'storage/'])) {
            return asset($this->gambar);
        }

        return asset('storage/' . $this->gambar);
    }
}
