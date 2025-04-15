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
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary()->uniqid(); // ID unik untuk setiap pasien
            $table->string('name'); // Nama pasien
            $table->string('nik')->unique(); // Nomor Induk Kependudukan (NIK) pasien
            $table->string('patient_number')->unique(); // Nomor Patient
            $table->string('gender'); // Jenis kelamin (Laki-laki/Perempuan)
            $table->date('birth_date'); // Tanggal lahir
            $table->integer('age'); // Tempat lahir
            $table->string('address'); // Alamat pasien
            $table->string('phone')->nullable(); // Nomor telepon (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
