<?php

// app/Models/DataDashboard.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDashboard extends Model
{
    use HasFactory;

    protected $table = 'data_dashboard';

    protected $fillable = [
        'nama_wilayah',
        'jumlah_keluarga',
        'jumlah_penduduk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'anggaran_apbdes',
        'keterangan'
    ];

    protected function casts(): array
    {
        return [
            'anggaran_apbdes' => 'decimal:2',
        ];
    }

    // Accessor untuk total penduduk berdasarkan jenis kelamin
    public function getTotalPendudukAttribute()
    {
        return $this->jumlah_laki_laki + $this->jumlah_perempuan;
    }

    // Scope
    public function scopeByWilayah($query, $wilayah)
    {
        return $query->where('nama_wilayah', 'like', "%{$wilayah}%");
    }
}