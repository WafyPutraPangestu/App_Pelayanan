<?php

// app/Models/SuratKeteranganLahir.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganLahir extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_lahir';

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'waktu_lahir',
        'agama',
        'nama_ibu',
        'nama_ayah',
        'alamat',
        'status',
        'catatan',
        'tanggal_disetujui'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'waktu_lahir' => 'datetime:H:i',
            'tanggal_disetujui' => 'datetime',
        ];
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Boot untuk auto generate nomor surat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nomor_surat)) {
                $model->nomor_surat = 'SKL/' . date('Y') . '/' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}