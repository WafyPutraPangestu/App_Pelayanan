<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CalonPengantin extends Model
{
    use HasFactory;

    protected $table = 'calon_pengantin';

    protected $fillable = [
        'surat_keterangan_menikah_id',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nik',
        'pekerjaan',
        'kewarganegaraan',
        'alamat',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Relasi ke surat keterangan menikah induk.
     */
    public function suratKeteranganMenikah(): BelongsTo
    {
        return $this->belongsTo(SuratKeteranganMenikah::class);
    }

    /**
     * Relasi ke data orang tua (ayah dan ibu).
     */
    public function orangTua(): HasMany
    {
        return $this->hasMany(OrangTuaCalonPengantin::class);
    }

    /**
     * Helper relasi untuk mendapatkan data Ayah.
     */
    public function ayah(): HasOne
    {
        return $this->hasOne(OrangTuaCalonPengantin::class)->where('jenis_orang_tua', 'ayah');
    }

    /**
     * Helper relasi untuk mendapatkan data Ibu.
     */
    public function ibu(): HasOne
    {
        return $this->hasOne(OrangTuaCalonPengantin::class)->where('jenis_orang_tua', 'ibu');
    }
}
