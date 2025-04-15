<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary()->uniqid(); // ID unik untuk setiap pelayanan
            $table->string('name'); // Nama pelayanan (misalnya: Periksa Umum, Cek Laboratorium)
            $table->string('description')->nullable(); // Deskripsi pelayanan
            $table->decimal('price', 10, 2); // Harga pelayanan
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel staff
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
