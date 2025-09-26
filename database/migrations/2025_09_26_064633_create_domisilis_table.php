<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domisilis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penduduk_id')->constrained('penduduks')->onDelete('cascade');
            $table->text('alamat_sekarang');
            $table->text('alamat_sebelumnya');
            $table->text('maksud_tujuan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domisilis');
    }
};
