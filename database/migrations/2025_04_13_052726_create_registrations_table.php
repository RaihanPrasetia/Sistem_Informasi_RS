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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (pasien)
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (dokter)
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Relasi ke tabel services
            $table->dateTime('registration_date'); // Tanggal pendaftaran
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (staf yang membuat)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
