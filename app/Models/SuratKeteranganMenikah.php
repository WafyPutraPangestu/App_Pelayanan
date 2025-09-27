<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SuratKeteranganMenikah extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_menikah';

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'status_perkawinan_pria',
        'status_perkawinan_wanita',
        'status',
        'catatan',
        'tanggal_disetujui',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_disetujui' => 'datetime',
        ];
    }

    /**
     * Relasi ke User yang mengajukan surat.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke semua calon pengantin (akan ada 2, pria dan wanita).
     */
    public function calonPengantin(): HasMany
    {
        return $this->hasMany(CalonPengantin::class);
    }

    /**
     * Helper relasi untuk mendapatkan data calon pria secara langsung.
     */
    public function calonPria(): HasOne
    {
        return $this->hasOne(CalonPengantin::class)->where('jenis_kelamin', 'Laki-laki');
    }

    /**
     * Helper relasi untuk mendapatkan data calon wanita secara langsung.
     */
    public function calonWanita(): HasOne
    {
        return $this->hasOne(CalonPengantin::class)->where('jenis_kelamin', 'Perempuan');
    }
}
