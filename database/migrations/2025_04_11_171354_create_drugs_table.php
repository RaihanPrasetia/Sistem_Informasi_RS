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
        Schema::create('drugs', function (Blueprint $table) {
            $table->uuid('id')->primary()->uniqid(); // ID unik untuk setiap obat
            $table->string('name'); // Nama obat
            $table->string('type'); // Jenis obat (misalnya: tablet, kapsul, sirup)
            $table->integer('stock'); // Stok obat
            $table->decimal('price', 10, 2); // Harga obat
            $table->text('description')->nullable(); // Deskripsi obat jika diperlukan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
