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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->primary(); // ID faktur
            $table->string('invoice_number')->unique(); // Nomor faktur unik
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade'); // Relasi ke tabel registrations
            $table->foreignId('registration_drug_id')->nullable()->constrained('registration_drugs')->onDelete('cascade'); // Relasi ke tabel patients
            $table->decimal('total', 10, 2)->default(0); // Total tagihan
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending'); // Status pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
