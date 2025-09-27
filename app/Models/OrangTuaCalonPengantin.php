<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrangTuaCalonPengantin extends Model
{
    use HasFactory;

    protected $table = 'orang_tua_calon_pengantin';

    protected $fillable = [
        'calon_pengantin_id',
        'jenis_orang_tua',
        'nama',
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
     * Relasi ke data calon pengantin (anak).
     */
    public function calonPengantin(): BelongsTo
    {
        return $this->belongsTo(CalonPengantin::class);
    }
}
