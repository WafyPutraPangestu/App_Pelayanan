<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keterangan_menikah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nomor_surat')->unique();
            $table->enum('status_perkawinan_pria', ['Belum Menikah', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('status_perkawinan_wanita', ['Belum Menikah', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('status', ['diproses', 'selesai', 'ditolak'])->default('diproses');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_disetujui')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_menikah');
    }
};