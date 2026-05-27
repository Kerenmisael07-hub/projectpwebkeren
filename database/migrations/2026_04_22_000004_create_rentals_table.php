<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->restrictOnDelete();
            $table->date('tgl_sewa');
            $table->date('tgl_kembali');
            $table->unsignedInteger('total');
            $table->unsignedInteger('denda')->default(0);
            $table->enum('status', ['aktif', 'selesai', 'terlambat'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
