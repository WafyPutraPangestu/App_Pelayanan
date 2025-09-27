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

class trackingController extends Controller
{
    public function index()
    {
        // 2. Ambil data dari setiap model dan tambahkan atribut 'jenis_surat'
        // Ini agar kita bisa menampilkan nama layanannya di tabel
        $domisili = SuratDomisili::all()->map(function ($item) {
            $item->jenis_surat = 'Surat Domisili';
            return $item;
        });

        $kelahiran = SuratKeteranganLahir::all()->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Lahir';
            return $item;
        });

        // Untuk surat menikah, kita eager load relasi calonPria dan calonWanita
        // agar tidak terjadi N+1 query problem di view
        $menikah = SuratKeteranganMenikah::with(['calonPria', 'calonWanita'])->get()->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Menikah';
            return $item;
        });

        $pengantar = SuratPengantar::all()->map(function ($item) {
            $item->jenis_surat = 'Surat Pengantar';
            return $item;
        });

        $kematian = SuratSkm::all()->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Kematian';
            return $item;
        });

        $sktm = SuratSktm::all()->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Tidak Mampu';
            return $item;
        });

        $sku = SuratSku::all()->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Usaha';
            return $item;
        });

        // 3. Gabungkan semua data menjadi satu koleksi (collection)
        $semuaSurat = collect([])
            ->concat($domisili)
            ->concat($kelahiran)
            ->concat($menikah)
            ->concat($pengantar)
            ->concat($kematian)
            ->concat($sktm)
            ->concat($sku);

        // 4. Urutkan koleksi gabungan berdasarkan tanggal dibuat (yang terbaru di atas)
        $suratTerurut = $semuaSurat->sortByDesc('created_at');
        $opsiJenisSurat = $suratTerurut->pluck('jenis_surat')->unique()->sort()->values();

        // 5. Kirim data yang sudah terurut ke view
        return view('user.tracking.index', [
            'semuaSurat' => $suratTerurut,
            'opsiJenisSurat' => $opsiJenisSurat,
            
        ]);
    }
}
