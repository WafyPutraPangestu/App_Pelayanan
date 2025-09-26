<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keterangan_menikahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_pria_id')->constrained('penduduks')->onDelete('cascade');
            $table->foreignId('calon_wanita_id')->constrained('penduduks')->onDelete('cascade');
            $table->string('status_perkawinan_pria');
            $table->string('status_perkawinan_wanita');
            $table->date('tanggal_akad')->nullable();
            $table->string('lokasi_akad')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan_menikahs');
    }
};
