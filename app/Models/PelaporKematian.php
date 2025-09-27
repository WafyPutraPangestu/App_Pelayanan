<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporKematian extends Model
{
    use HasFactory;

    protected $table = 'pelapor_kematian';

    protected $fillable = [
        'surat_skm_id',
        'nama_pelapor',
        'jenis_kelamin_pelapor',
        'tempat_lahir_pelapor',
        'tanggal_lahir_pelapor',
        'nik_pelapor',
        'pekerjaan_pelapor',
        'alamat_pelapor',
        'hubungan_dengan_almarhum'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir_pelapor' => 'date',
        ];
    }

    // Relasi
    public function suratSkm()
    {
        return $this->belongsTo(SuratSkm::class);
    }
}