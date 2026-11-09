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
        Schema::create('surat_panggilans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('pelanggaran_id')->nullable()->constrained('pelanggarans')->onDelete('set null');
            $table->string('nomor_surat', 50)->unique();
            $table->date('tanggal_panggilan');
            $table->time('waktu_panggilan');
            $table->text('keperluan');
            $table->enum('status', ['pending', 'hadir', 'tidak_hadir'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_panggilans');
    }
};
