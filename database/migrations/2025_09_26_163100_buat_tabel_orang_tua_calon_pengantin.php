<?php

// database/migrations/2024_01_01_000012_buat_tabel_orang_tua_calon_pengantin.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orang_tua_calon_pengantin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_pengantin_id')->constrained('calon_pengantin')->onDelete('cascade');
            $table->enum('jenis_orang_tua', ['ayah', 'ibu']);
            $table->string('nama');
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
        Schema::dropIfExists('orang_tua_calon_pengantin');
    }
};
