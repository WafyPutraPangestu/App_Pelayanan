<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_dashboard', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah'); // RT/RW atau dusun
            $table->integer('jumlah_keluarga');
            $table->integer('jumlah_penduduk');
            $table->integer('jumlah_laki_laki');
            $table->integer('jumlah_perempuan');
            $table->decimal('anggaran_apbdes', 15, 2)->nullable(); 
            $table->string('file_apbdes')->nullable(); // Menyimpan path file APBDes
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_dashboard');
    }
};