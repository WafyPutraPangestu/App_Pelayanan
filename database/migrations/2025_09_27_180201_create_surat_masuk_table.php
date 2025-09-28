<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            // Kunci asing ke tabel pengajuan untuk melacak asalnya  
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID user pemilik surat
            $table->foreignId('admin_id')->constrained('users')->comment('ID Admin yang memproses'); // ID admin yang upload
            $table->string('jenis_surat'); 
$table->unsignedBigInteger('surat_asal_id');
$table->string('nomor_surat_pengajuan');
$table->string('nama_penerima');
$table->enum('status', ['siap_download', 'sudah_diambil'])->default('siap_download');
$table->text('catatan_admin')->nullable();
$table->integer('jumlah_download')->default(0);
$table->timestamp('tanggal_didownload')->nullable();
            $table->string('nomor_surat_resmi')->unique()->nullable(); // Nomor surat resmi yang diinput admin
            $table->string('file_path_ttd'); // Path ke file PDF yang sudah ditandatangani
            $table->timestamp('tanggal_terbit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};