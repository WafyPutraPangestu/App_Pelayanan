<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelapor_kematian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_skm_id')->constrained('surat_skm')->onDelete('cascade');
            $table->string('nama_pelapor');
            $table->enum('jenis_kelamin_pelapor', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir_pelapor');
            $table->date('tanggal_lahir_pelapor');
            $table->string('nik_pelapor', 16);
            $table->string('pekerjaan_pelapor');
            $table->text('alamat_pelapor');
            $table->string('hubungan_dengan_almarhum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelapor_kematian');
    }
};