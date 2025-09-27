<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratSkm extends Model
{
    use HasFactory;

    protected $table = 'surat_skm';

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'nama_almarhum',
        'jenis_kelamin_almarhum',
        'tempat_lahir_almarhum',
        'tanggal_lahir_almarhum',
        'agama_almarhum',
        'nik_almarhum',
        'penyebab_kematian',
        'tanggal_kematian',
        'waktu_kematian',
        'alamat_almarhum',
        'status',
        'catatan',
        'tanggal_disetujui'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir_almarhum' => 'date',
            'tanggal_kematian' => 'date',
            'waktu_kematian' => 'datetime:H:i',
            'tanggal_disetujui' => 'datetime',
        ];
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelaporKematian()
    {
        return $this->hasOne(PelaporKematian::class);
    }

    // Boot untuk auto generate nomor surat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nomor_surat)) {
                $model->nomor_surat = 'SKM/' . date('Y') . '/' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}