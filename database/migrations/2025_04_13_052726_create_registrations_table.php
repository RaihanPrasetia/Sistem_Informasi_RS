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
            $table->uuid('patient_id'); // Kolom patient_id bertipe UUID
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->uuid('service_id'); // Kolom service_id bertipe UUID
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade'); // Relasi ke tabel services
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
