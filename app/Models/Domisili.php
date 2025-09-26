<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domisili extends Model
{
    use HasFactory;

    protected $fillable = [
        'penduduk_id',
        'alamat_sekarang',
        'alamat_sebelumnya',
        'maksud_tujuan',
    ];

    // Relasi belongsTo: Satu pengajuan domisili dimiliki oleh satu penduduk
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
