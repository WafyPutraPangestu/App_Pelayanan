<?php

// database/migrations/2024_01_01_000006_buat_tabel_surat_skm.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_skm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nomor_surat')->unique();
            // Data yang meninggal
            $table->string('nama_almarhum');
            $table->enum('jenis_kelamin_almarhum', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir_almarhum');
            $table->date('tanggal_lahir_almarhum');
            $table->string('agama_almarhum');
            $table->string('nik_almarhum', 16);
            $table->string('penyebab_kematian');
            $table->date('tanggal_kematian');
            $table->time('waktu_kematian');
            $table->text('alamat_almarhum');
            $table->enum('status', ['diproses', 'selesai', 'ditolak'])->default('diproses');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_disetujui')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_skm');
    }
};
