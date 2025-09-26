<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keterangan_lahirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('penduduks')->onDelete('cascade');
            $table->foreignId('ayah_id')->constrained('penduduks')->onDelete('cascade');
            $table->foreignId('ibu_id')->constrained('penduduks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keterangan_lahirs');
    }
};
