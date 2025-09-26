<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keterangan_kematians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenazah_id')->constrained('penduduks')->onDelete('cascade');
            $table->foreignId('pelapor_id')->constrained('penduduks')->onDelete('cascade');
            $table->string('penyebab_kematian');
            $table->string('hari_kematian');
            $table->date('tanggal_kematian');
            $table->string('hubungan_pelapor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_kematians');
    }
};
