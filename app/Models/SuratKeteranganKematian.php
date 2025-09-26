<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganKematian extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenazah_id',
        'pelapor_id',
        'penyebab_kematian',
        'hari_kematian',
        'tanggal_kematian',
        'hubungan_pelapor',
    ];


    public function jenazah()
    {
        return $this->belongsTo(Penduduk::class, 'jenazah_id');
    }


    public function pelapor()
    {
        return $this->belongsTo(Penduduk::class, 'pelapor_id');
    }
}
