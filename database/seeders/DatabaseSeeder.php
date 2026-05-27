<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'keren@example.com'],
            [
                'name' => 'Keren Misael',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    
        $this->call([
            KendaraanSeeder::class,
        ]);
    }
}
