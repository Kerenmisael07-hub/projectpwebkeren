<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Honda Beat 2022', 'tipe' => 'motor', 'harga_per_hari' => 70000],
            ['nama' => 'Yamaha NMAX 2023', 'tipe' => 'motor', 'harga_per_hari' => 120000],
            ['nama' => 'Honda Vario 160', 'tipe' => 'motor', 'harga_per_hari' => 90000],
            ['nama' => 'Yamaha Aerox', 'tipe' => 'motor', 'harga_per_hari' => 100000],
            ['nama' => 'Suzuki Nex II', 'tipe' => 'motor', 'harga_per_hari' => 65000],
            ['nama' => 'Toyota Avanza 2021', 'tipe' => 'mobil', 'harga_per_hari' => 300000],
            ['nama' => 'Daihatsu Xenia 2020', 'tipe' => 'mobil', 'harga_per_hari' => 280000],
            ['nama' => 'Honda Brio 2022', 'tipe' => 'mobil', 'harga_per_hari' => 250000],
            ['nama' => 'Toyota Innova 2021', 'tipe' => 'mobil', 'harga_per_hari' => 450000],
            ['nama' => 'Mitsubishi Pajero 2022', 'tipe' => 'mobil', 'harga_per_hari' => 700000],
        ];

        foreach ($data as $item) {
            Kendaraan::updateOrCreate(
                ['nama' => $item['nama']],
                $item + ['status' => 'tersedia']
            );
        }
    }
}
