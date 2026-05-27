<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class HomeSettings
{
    public static function defaultVehicles(): array
    {
        return [
            [
                'label' => 'Motor Matic',
                'title' => 'Yamaha NMAX',
                'description' => 'Cocok untuk perjalanan dalam kota dengan kenyamanan yang baik.',
                'price' => 'Rp 150.000 / hari',
                'image' => null,
            ],
            [
                'label' => 'Mobil MPV',
                'title' => 'Toyota Avanza',
                'description' => 'Pilihan praktis untuk keluarga atau kebutuhan perjalanan kerja.',
                'price' => 'Rp 350.000 / hari',
                'image' => null,
            ],
            [
                'label' => 'Mobil City Car',
                'title' => 'Honda Brio',
                'description' => 'Irit, ringkas, dan cocok untuk pemakaian harian.',
                'price' => 'Rp 300.000 / hari',
                'image' => null,
            ],
        ];
    }

    public static function defaults(): array
    {
        return [
            'hero_badge' => 'Kelola rental lebih rapi',
            'hero_title' => 'Pusat pengelolaan rental kendaraan yang jelas, cepat, dan mudah dipahami.',
            'hero_description' => 'Website ini dirancang untuk memudahkan pengelolaan penyewaan kendaraan, mulai dari data armada, customer, transaksi, bukti sewa, sampai laporan. Semua informasi penting tersusun di satu tempat agar operasional harian lebih efisien dan tidak membingungkan.',
            'primary_cta_text' => 'Masuk ke Dashboard',
            'secondary_cta_text' => 'Lihat Penjelasan',
            'section_intro_badge' => 'Apa itu rental ini?',
            'section_intro_title' => 'Sistem pengelolaan untuk rental kendaraan harian.',
            'services_badge' => 'Layanan Utama',
            'services_title' => 'Semua kebutuhan rental dibuat sederhana.',
            'vehicles_badge' => 'Kendaraan Unggulan',
            'vehicles_title' => 'Contoh kendaraan yang tampil di halaman depan.',
            'vehicles' => self::defaultVehicles(),
            'contact_badge' => 'Kontak',
            'contact_title' => 'Hubungi kami untuk info rental.',
            'contact_address' => 'Jl. Contoh No. 123, Kota Anda',
            'contact_whatsapp' => '0812-3456-7890',
            'contact_hours' => 'Senin - Sabtu, 08.00 - 20.00',
            'footer_left' => '© 2026 Sistem Rental Kendaraan. Semua hak dilindungi.',
            'footer_right' => 'Kelola kendaraan, customer, transaksi, dan bukti sewa dalam satu tempat.',
        ];
    }

    public static function path(): string
    {
        return storage_path('app/home-settings.json');
    }

    public static function load(): array
    {
        $defaults = self::defaults();

        if (! File::exists(self::path())) {
            return $defaults;
        }

        $decoded = json_decode(File::get(self::path()), true);

        if (! is_array($decoded)) {
            return $defaults;
        }

        if (! isset($decoded['vehicles']) || ! is_array($decoded['vehicles'])) {
            $legacyVehicles = [];

            for ($index = 1; $index <= 3; $index++) {
                $legacyVehicles[] = [
                    'label' => $decoded["vehicle_{$index}_label"] ?? $defaults['vehicles'][$index - 1]['label'],
                    'title' => $decoded["vehicle_{$index}_title"] ?? $defaults['vehicles'][$index - 1]['title'],
                    'description' => $decoded["vehicle_{$index}_description"] ?? $defaults['vehicles'][$index - 1]['description'],
                    'price' => $decoded["vehicle_{$index}_price"] ?? $defaults['vehicles'][$index - 1]['price'],
                    'image' => $decoded["vehicle_{$index}_image"] ?? null,
                ];
            }

            $decoded['vehicles'] = $legacyVehicles;
        }

        return array_merge($defaults, $decoded);
    }

    public static function save(array $settings): void
    {
        File::put(self::path(), json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}