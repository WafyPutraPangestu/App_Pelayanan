<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataPengguna extends Model
{
    use HasFactory;

    protected $table = 'biodata_pengguna';

    protected $fillable = [
        'user_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nik',
        'kewarganegaraan',
        'pekerjaan',
        'alamat',
        'nomor_telepon'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

