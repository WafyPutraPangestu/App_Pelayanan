<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'user_id',
        'admin_id',
        'jenis_surat',
        'surat_asal_id',
        'nomor_surat_pengajuan',
        'nomor_surat_resmi',
        'file_path_ttd',
        'nama_penerima',
        'tanggal_terbit',
        'status',
        'catatan_admin',
        'jumlah_download',
        'tanggal_didownload',
    ];
    

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'datetime',
            'tanggal_didownload' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}