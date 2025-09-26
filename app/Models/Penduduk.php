<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'kewarganegaraan',
        'alamat',
        'status_perkawinan',
        'nama_ayah',
        'nama_ibu',
    ];

    // Relasi one-to-one: Satu data penduduk dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu penduduk bisa punya banyak pengajuan
    public function domisilis()
    {
        return $this->hasMany(Domisili::class);
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    // dan seterusnya untuk semua model layanan...
}
