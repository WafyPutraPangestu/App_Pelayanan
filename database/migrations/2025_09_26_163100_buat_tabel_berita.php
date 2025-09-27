<?php

// database/migrations/2024_01_01_000013_buat_tabel_berita.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // admin yang buat
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan');
            $table->longText('konten');
            $table->string('gambar')->nullable();
            $table->boolean('dipublikasikan')->default(false);
            $table->integer('dilihat')->default(0);
            $table->timestamp('tanggal_publikasi')->nullable();
            $table->timestamps();
            
            $table->index(['dipublikasikan', 'tanggal_publikasi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};

