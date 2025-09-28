<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataDashboard;
use App\Models\Pengaduan;
use App\Models\SuratDomisili;
use App\Models\SuratKeteranganLahir;
use App\Models\SuratKeteranganMenikah;
use App\Models\SuratMasuk;
use App\Models\SuratPengantar;
use App\Models\SuratSkm;
use App\Models\SuratSktm;
use App\Models\SuratSku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DahboardController extends Controller
{
    /**
     * Menampilkan data untuk dashboard admin.
     */
    public function index()
    {
        // 1. Kumpulan data statistik utama
        $statistik = [
            'jumlah_pengguna' => User::where('role', 'user')->count(),
            'jumlah_surat_masuk' => SuratMasuk::count(),
            'jumlah_pengaduan' => Pengaduan::count(),
            'pengaduan_baru' => Pengaduan::where('status', 'baru')->count(), // Tambahan
        ];

        // 2. Data untuk Chart Penduduk (Batang) dari tabel data_dashboard
        $dataPenduduk = DataDashboard::select('nama_wilayah', 'jumlah_penduduk')->get();
        
        // 3. (Tambahan) Data tren pengajuan surat 7 hari terakhir
        $collections = [
            SuratDomisili::class, SuratSkm::class, SuratSku::class,
            SuratSktm::class, SuratKeteranganLahir::class, SuratPengantar::class,
            SuratKeteranganMenikah::class,
        ];

        $trenSurat = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $trenSurat['labels'][] = now()->subDays($i)->format('d M');
            
            $total = 0;
            foreach ($collections as $model) {
                $total += $model::whereDate('created_at', $date)->count();
            }
            $trenSurat['data'][] = $total;
        }

        return view('admin.dashboard.index', compact('statistik', 'dataPenduduk', 'trenSurat'));
    }
}