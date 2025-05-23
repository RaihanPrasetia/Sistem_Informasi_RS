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
        Schema::create('registration_drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade'); // Relasi ke tabel registrations
            $table->uuid('drug_id'); // Menggunakan UUID untuk relasi ke tabel drugs
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade'); // Relasi ke tabel drugs
            $table->integer('quantity'); // Jumlah obat
            $table->string('dosage'); // Dosis obat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_drugs');
    }
};
