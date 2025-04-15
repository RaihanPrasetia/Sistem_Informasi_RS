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
        Schema::create('cities', function (Blueprint $table) {
            $table->uuid('id')->primary()->uniqid(); // ID unik untuk setiap kota
            $table->string('name'); // Nama kota
            $table->uuid('state_id'); // Menggunakan UUID untuk relasi ke tabel states
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade'); // Relasi ke tabel states
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
