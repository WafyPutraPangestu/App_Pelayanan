<?php

// app/Models/Berita.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar',
        'dipublikasikan',
        'dilihat',
        'tanggal_publikasi'
    ];

    protected function casts(): array
    {
        return [
            'dipublikasikan' => 'boolean',
            'tanggal_publikasi' => 'datetime',
        ];
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope
    public function scopeDipublikasikan($query)
    {
        return $query->where('dipublikasikan', true)->whereNotNull('tanggal_publikasi');
    }

    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal_publikasi', 'desc');
    }

    // Boot untuk auto generate slug
    protected static function boot()
    {
        parent::boot();

        // Event ini berjalan SETIAP KALI berita baru akan dibuat.
        static::creating(function ($berita) {
            // Membuat slug dari judul
            $berita->slug = Str::slug($berita->judul);
        });

        // Event ini berjalan SETIAP KALI berita yang sudah ada akan di-update.
        static::updating(function ($berita) {
            // Jika judulnya diubah, maka buat ulang slug-nya.
            if ($berita->isDirty('judul')) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Mutator untuk auto set tanggal publikasi
    public function setDipublikasikanAttribute($value)
    {
        $this->attributes['dipublikasikan'] = $value;
        
        if ($value && !$this->tanggal_publikasi) {
            $this->attributes['tanggal_publikasi'] = now();
        }
    }
}
