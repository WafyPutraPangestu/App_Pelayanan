<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
    {
        $suratMasuk = SuratMasuk::where('user_id', Auth::id())
            ->orderBy('tanggal_terbit', 'desc')
            ->paginate(10); // Menampilkan 10 surat per halaman

        return view('user.surat_masuk.index', compact('suratMasuk'));
    }

    /**
     * Mengizinkan user men-download surat miliknya.
     */
    public function download(SuratMasuk $suratMasuk)
    {
        // 1. PENTING: Cek Keamanan, pastikan user hanya bisa download surat miliknya sendiri.
        if ($suratMasuk->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // 2. Cek apakah file suratnya ada di storage
        if (!Storage::disk('public')->exists($suratMasuk->file_path_ttd)) {
            return back()->with('error', 'File surat tidak ditemukan. Silakan hubungi admin.');
        }

        // 3. Catat jumlah download dan tanggalnya
        $suratMasuk->increment('jumlah_download');
        $suratMasuk->tanggal_didownload = now();
        $suratMasuk->save();
        
        // 4. Siapkan path lengkap ke file
        $filePath = storage_path('app/public/' . $suratMasuk->file_path_ttd);
        
        // 5. Buat nama file yang akan di-download oleh user

// Ganti karakter yang tidak valid ('/' dan '\') dengan '-'
$nomorSuratClean = str_replace(['/', '\\'], '-', $suratMasuk->nomor_surat_resmi);

$namaFile = 'Surat-' . str_replace(' ', '_', $suratMasuk->jenis_surat) . '-' . $nomorSuratClean . '.pdf';
        
        // 6. Kirim file ke browser user
        return response()->download($filePath, $namaFile);
    }
}
