<?php

// database/migrations/2024_01_01_000011_buat_tabel_calon_pengantin.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calon_pengantin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_keterangan_menikah_id')->constrained('surat_keterangan_menikah')->onDelete('cascade');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('nik', 16);
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calon_pengantin');
    }
};
