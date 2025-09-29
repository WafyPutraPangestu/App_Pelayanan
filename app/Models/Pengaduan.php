<?php

// app/Models/Pengaduan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'nomor_pengaduan',
        'category',
        'judul',
        'isi_pengaduan',
        'kategori',
        'lampiran',
        'status',
        'tanggapan',
        'tanggal_ditanggapi'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_ditanggapi' => 'datetime',
        ];
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope
    public function scopeBaru($query)
    {
        return $query->where('status', 'baru');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'diproses');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    // Boot untuk auto generate nomor pengaduan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nomor_pengaduan)) {
                $model->nomor_pengaduan = 'ADU/' . date('Y') . '/' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
