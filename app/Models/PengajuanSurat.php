<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $guarded = ['id'];

    /**
     * Relasi ke user yang mengajukan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi polimorfik untuk mengambil detail surat spesifik.
     * Ini bisa mengembalikan objek SuratSku, SuratDomisili, dll.
     */
    public function surat(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relasi ke surat final yang sudah jadi di arsip.
     */
    public function suratMasuk(): HasOne
    {
        return $this->hasOne(SuratMasuk::class);
    }
}