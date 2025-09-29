<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\DataDashboard;
use App\Models\Pengaduan;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DahboardController extends Controller
{
    /**
     * Menampilkan data untuk dashboard user.
     */
    public function index()
    {
        // 1. Data untuk Chart Penduduk (Batang)
        $dataPenduduk = DataDashboard::select('nama_wilayah', 'jumlah_penduduk')->get();

        // 2. Data untuk Chart Gender (Pie)
        $totalLaki = DataDashboard::sum('jumlah_laki_laki');
        $totalPerempuan = DataDashboard::sum('jumlah_perempuan');
        $totalPenduduk = $totalLaki + $totalPerempuan;

        $dataGender = [
            'labels' => ['Laki-laki', 'Perempuan'],
            'data' => [$totalLaki, $totalPerempuan],
            'persentase_laki' => $totalPenduduk > 0 ? round(($totalLaki / $totalPenduduk) * 100, 1) : 0,
            'persentase_perempuan' => $totalPenduduk > 0 ? round(($totalPerempuan / $totalPenduduk) * 100, 1) : 0,
        ];
        
        // 3. Jumlah Keluarga
        $jumlahKeluarga = DataDashboard::sum('jumlah_keluarga');
        
        // 4. (Tambahan) Info untuk user yang sedang login
        $infoUser = [
            'surat_siap_download' => SuratMasuk::where('user_id', Auth::id())->where('status', 'siap_download')->count(),
            'pengaduan_terakhir' => Pengaduan::where('user_id', Auth::id())->latest()->first(),
        ];

        // 5. Data APBDes untuk ditampilkan
        $dataApbdes = DataDashboard::whereNotNull('file_apbdes')->orderBy('created_at', 'desc')->get();
        $totalAnggaran = DataDashboard::sum('anggaran_apbdes');

        return view('user.dashboard.index', compact('dataPenduduk', 'dataGender', 'jumlahKeluarga', 'infoUser', 'dataApbdes', 'totalAnggaran'));
    }
}
