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
        Schema::create('states', function (Blueprint $table) {
            $table->uuid('id')->primary()->uniqid(); // ID unik untuk setiap provinsi
            $table->uuid('country_id'); // Menggunakan UUID untuk relasi ke tabel countries
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade'); // Relasi ke tabel countries
            $table->string('name'); // Nama provinsi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
