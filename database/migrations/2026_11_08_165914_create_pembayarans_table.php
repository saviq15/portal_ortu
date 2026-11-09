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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained('tagihans')->onDelete('cascade');
            $table->string('nomor_transaksi', 50)->unique();
            $table->date('tanggal_payaran');
            $table->decimal('jumlah_bayar', 12, 2);
            $table->string('metode_pembayaran'); // Contoh: Transfer, Tunai
            $table->string('bukti_pembayaran')->nullable();
            $table->string('petugas_penerima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
