<?php

// app/Models/SuratDomisili.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratDomisili extends Model
{
    use HasFactory;

    protected $table = 'surat_domisili';

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nik',
        'alamat_sekarang',
        'alamat_sebelumnya',
        'maksud_dan_tujuan',
        'status',
        'catatan',
        'tanggal_disetujui'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
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
                $model->nomor_surat = 'DOM/' . date('Y') . '/' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}