<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratDomisili;
use App\Models\SuratKeteranganLahir;
use App\Models\SuratKeteranganMenikah;
use App\Models\SuratPengantar;
use App\Models\SuratSkm;
use App\Models\SuratSktm;
use App\Models\SuratSku;
use Illuminate\Support\Facades\Auth;

class trackingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login');
        }

        // Closure untuk memetakan data surat
        $mapSurat = function ($surat, $jenis, $editRoute, $showRoute, $destroyRoute) {
            $surat->jenis_surat = $jenis;
            $surat->edit_route_name = $editRoute;
            $surat->show_route_name = $showRoute;
            $surat->destroy_route_name = $destroyRoute; // <-- Tambahan baru
            return $surat;
        };

        // Memetakan setiap jenis surat
        $domisili  = SuratDomisili::where('user_id', $userId)->get()->map(fn($s) => $mapSurat($s, 'Surat Domisili', 'domisili.edit', 'domisili.show', 'domisili.destroy'));
        $kelahiran = SuratKeteranganLahir::where('user_id', $userId)->get()->map(fn($s) => $mapSurat($s, 'Surat Keterangan Lahir', 'keterangan_lahir.edit', 'keterangan_lahir.show', 'keterangan_lahir.destroy'));
        $menikah   = SuratKeteranganMenikah::where('user_id', $userId)->with(['calonPria', 'calonWanita'])->get()->map(fn($s) => $mapSurat($s, 'Surat Keterangan Menikah', 'keterangan_menikah.edit', 'keterangan_menikah.show', 'keterangan_menikah.destroy'));
        $pengantar = SuratPengantar::where('user_id', $userId)->get()->map(fn($s) => $mapSurat($s, 'Surat Pengantar', 'surat_pengantar.edit', 'surat_pengantar.show', 'surat_pengantar.destroy'));
        $kematian  = SuratSkm::where('user_id', $userId)->get()->map(fn($s) => $mapSurat($s, 'Surat Keterangan Kematian', 'skm.edit', 'skm.show', 'skm.destroy'));
        $sktm      = SuratSktm::where('user_id', $userId)->get()->map(fn($s) => $mapSurat($s, 'Surat Keterangan Tidak Mampu', 'sktm.edit', 'sktm.show', 'sktm.destroy'));
        $sku       = SuratSku::where('user_id', $userId)->get()->map(fn($s) => $mapSurat($s, 'Surat Keterangan Usaha', 'sku.edit', 'sku.show', 'sku.destroy'));
        
        // Menggabungkan dan mengurutkan
        $semuaSurat = collect([])
            ->merge($domisili)->merge($kelahiran)->merge($menikah)
            ->merge($pengantar)->merge($kematian)->merge($sktm)->merge($sku)
            ->sortByDesc('created_at');

        $opsiJenisSurat = $semuaSurat->pluck('jenis_surat')->unique()->sort()->values();

        // Mengirim data ke view
        return view('user.tracking.index', [
            'semuaSurat' => $semuaSurat,
            'opsiJenisSurat' => $opsiJenisSurat,
        ]);
    }
}
