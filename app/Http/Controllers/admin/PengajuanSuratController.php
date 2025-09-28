<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SuratDomisili;
use App\Models\SuratSkm;
use App\Models\SuratSku;
use App\Models\SuratSktm;
use App\Models\SuratKeteranganLahir;
use App\Models\SuratPengantar;
use App\Models\SuratKeteranganMenikah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PengajuanSuratController extends Controller
{
    /**
     * Tampilkan semua pengajuan surat dari berbagai jenis
     */
    public function index(Request $request)
    {
        $jenisSurat = $request->get('jenis', 'semua');
        $status = $request->get('status', 'semua');
        
        $pengajuanSurat = collect();

        // Fungsi helper untuk menambahkan jenis surat ke collection
        $addSuratToCollection = function($model, $jenis) use (&$pengajuanSurat, $status) {
            $query = $model::with('user');
            
            if ($status !== 'semua') {
                $query->where('status', $status);
            }
            
            $surats = $query->get()->map(function($surat) use ($jenis) {
                $surat->jenis_surat = $jenis;
                return $surat;
            });
            
            $pengajuanSurat = $pengajuanSurat->merge($surats);
        };

        // Ambil data berdasarkan jenis surat yang dipilih
        if ($jenisSurat === 'semua' || $jenisSurat === 'domisili') {
            $addSuratToCollection(SuratDomisili::class, 'Surat Domisili');
        }
        
        if ($jenisSurat === 'semua' || $jenisSurat === 'skm') {
            $addSuratToCollection(SuratSkm::class, 'Surat Keterangan Meninggal');
        }
        
        if ($jenisSurat === 'semua' || $jenisSurat === 'sku') {
            $addSuratToCollection(SuratSku::class, 'Surat Keterangan Usaha');
        }
        
        if ($jenisSurat === 'semua' || $jenisSurat === 'sktm') {
            $addSuratToCollection(SuratSktm::class, 'Surat Keterangan Tidak Mampu');
        }
        
        if ($jenisSurat === 'semua' || $jenisSurat === 'keterangan_lahir') {
            $addSuratToCollection(SuratKeteranganLahir::class, 'Surat Keterangan Lahir');
        }
        
        if ($jenisSurat === 'semua' || $jenisSurat === 'pengantar') {
            $addSuratToCollection(SuratPengantar::class, 'Surat Pengantar');
        }
        
        if ($jenisSurat === 'semua' || $jenisSurat === 'keterangan_menikah') {
            $addSuratToCollection(SuratKeteranganMenikah::class, 'Surat Keterangan Menikah');
        }

        // Urutkan berdasarkan tanggal terbaru
        $pengajuanSurat = $pengajuanSurat->sortByDesc('created_at');

        // Statistik untuk dashboard
        $statistik = [
            'total' => $pengajuanSurat->count(),
            'diproses' => $pengajuanSurat->where('status', 'diproses')->count(),
            'selesai' => $pengajuanSurat->where('status', 'selesai')->count(),
            'ditolak' => $pengajuanSurat->where('status', 'ditolak')->count(),
        ];

        return view('admin.pengajuan_surat.index', compact('pengajuanSurat', 'statistik', 'jenisSurat', 'status'));
    }

    /**
     * Tampilkan detail pengajuan surat tertentu
     */
    public function show($jenis, $id)
    {
        $surat = $this->getSuratByJenisAndId($jenis, $id);
        
        if (!$surat) {
            abort(404, 'Surat tidak ditemukan');
        }

        // Tambahkan informasi jenis surat
        $surat->jenis_surat = $this->getJenisSuratLabel($jenis);
        
        return view('admin.pengajuan_surat.show', compact('surat', 'jenis'));
    }

    /**
     * Update status pengajuan surat
     */
    public function update(Request $request, $jenis, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,selesai,ditolak',
            'catatan' => 'nullable|string|max:1000'
        ]);

        $surat = $this->getSuratByJenisAndId($jenis, $id);
        
        if (!$surat) {
            return back()->with('error', 'Surat tidak ditemukan');
        }

        // Update status dan catatan
        $surat->status = $request->status;
        $surat->catatan = $request->catatan;
        
        // Jika status selesai, set tanggal disetujui
        if ($request->status === 'selesai') {
            $surat->tanggal_disetujui = now();
        }
        
        $surat->save();

        $statusLabel = $this->getStatusLabel($request->status);
        
        return back()->with('success', "Status surat berhasil diubah menjadi {$statusLabel}");
    }

    /**
     * Download surat dalam format PDF (placeholder)
     */
    public function download($jenis, $id)
    {
        $surat = $this->getSuratByJenisAndId($jenis, $id);
        
        if (!$surat || $surat->status !== 'selesai') {
            return back()->with('error', 'Surat belum selesai diproses atau tidak ditemukan');
        }

        // TODO: Implementasi generate PDF
        // Contoh menggunakan DomPDF atau TCPDF
        $pdf = Pdf::loadView('admin.surat-templates.' . $jenis, compact('surat'));
        
        // --- PERBAIKAN DI SINI ---
        
        // 1. Buat nama file yang aman dengan mengganti "/" menjadi "-"
        $namaFile = str_replace('/', '-', $surat->nomor_surat) . '.pdf';
        
        // 2. Download file PDF dengan nama yang sudah aman
        return $pdf->download($namaFile);
        
        // return back()->with('info', 'Fitur download PDF akan segera tersedia');
    }

    /**
     * Upload surat yang sudah ditandatangani
     */
    // public function uploadSigned(Request $request, $jenis, $id)
    // {
    //     $request->validate([
    //         'surat_signed' => 'required|file|mimes:pdf|max:5120' // Max 5MB
    //     ]);

    //     $surat = $this->getSuratByJenisAndId($jenis, $id);
        
    //     if (!$surat || $surat->status !== 'selesai') {
    //         return back()->with('error', 'Surat belum selesai diproses atau tidak ditemukan');
    //     }

    //     // Hapus file lama jika ada
    //     if ($surat->file_signed && Storage::exists($surat->file_signed)) {
    //         Storage::delete($surat->file_signed);
    //     }

    //     // Upload file baru
    //     $filePath = $request->file('surat_signed')->store('surat-signed');
    //     $surat->file_signed = $filePath;
    //     $surat->tanggal_upload_signed = now();
    //     $surat->save();

    //     // TODO: Pindahkan ke SuratMasuk untuk user
    //     // $this->pindahkanKeSuratMasuk($surat, $jenis);

    //     return back()->with('success', 'Surat yang sudah ditandatangani berhasil diupload');
    // }

    /**
     * Batch update status untuk multiple surat
     */
    public function batchUpdate(Request $request)
    {
        $request->validate([
            'surat_ids' => 'required|array',
            'surat_ids.*' => 'required|string', // format: jenis-id
            'batch_status' => 'required|in:diproses,selesai,ditolak',
            'batch_catatan' => 'nullable|string|max:1000'
        ]);

        $updated = 0;
        
        foreach ($request->surat_ids as $suratId) {
            [$jenis, $id] = explode('-', $suratId);
            $surat = $this->getSuratByJenisAndId($jenis, $id);
            
            if ($surat) {
                $surat->status = $request->batch_status;
                $surat->catatan = $request->batch_catatan;
                
                if ($request->batch_status === 'selesai') {
                    $surat->tanggal_disetujui = now();
                }
                
                $surat->save();
                $updated++;
            }
        }

        $statusLabel = $this->getStatusLabel($request->batch_status);
        
        return back()->with('success', "{$updated} surat berhasil diubah statusnya menjadi {$statusLabel}");
    }

    /**
     * Helper: Dapatkan model surat berdasarkan jenis dan ID
     */
    private function getSuratByJenisAndId($jenis, $id)
    {
        switch ($jenis) {
            case 'domisili':
                return SuratDomisili::with('user')->find($id);
            case 'skm':
                return SuratSkm::with('user', 'pelaporKematian')->find($id);
            case 'sku':
                return SuratSku::with('user')->find($id);
            case 'sktm':
                return SuratSktm::with('user')->find($id);
            case 'keterangan_lahir':
                return SuratKeteranganLahir::with('user')->find($id);
            case 'pengantar':
                return SuratPengantar::with('user')->find($id);
            case 'keterangan_menikah':
                return SuratKeteranganMenikah::with('user', 'calonPengantin.orangTua')->find($id);
            default:
                return null;
        }
    }

    /**
     * Helper: Dapatkan label jenis surat
     */
    private function getJenisSuratLabel($jenis)
    {
        $labels = [
            'domisili' => 'Surat Domisili',
            'skm' => 'Surat Keterangan Meninggal',
            'sku' => 'Surat Keterangan Usaha',
            'sktm' => 'Surat Keterangan Tidak Mampu',
            'keterangan_lahir' => 'Surat Keterangan Lahir',
            'pengantar' => 'Surat Pengantar',
            'keterangan_menikah' => 'Surat Keterangan Menikah'
        ];

        return $labels[$jenis] ?? 'Tidak Diketahui';
    }

    /**
     * Helper: Dapatkan label status
     */
    private function getStatusLabel($status)
    {
        $labels = [
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        return $labels[$status] ?? 'Tidak Diketahui';
    }

    /**
     * Helper: Pindahkan surat ke SuratMasuk (untuk implementasi nanti)
     */
    // private function pindahkanKeSuratMasuk($surat, $jenis)
    // {
    //     SuratMasuk::create([
    //         'user_id' => $surat->user_id,
    //         'jenis_surat' => $this->getJenisSuratLabel($jenis),
    //         'nomor_surat' => $surat->nomor_surat,
    //         'file_path' => $surat->file_signed,
    //         'tanggal_selesai' => $surat->tanggal_disetujui,
    //         'status' => 'tersedia'
    //     ]);
    // }

    /**
     * Ekspor data pengajuan surat ke Excel (placeholder)
     */
    // public function export(Request $request)
    // {
    //     // TODO: Implementasi export menggunakan Laravel Excel
    //     // return Excel::download(new PengajuanSuratExport($request->all()), 'pengajuan-surat.xlsx');
        
    //     return back()->with('info', 'Fitur export akan segera tersedia');
    // }
}