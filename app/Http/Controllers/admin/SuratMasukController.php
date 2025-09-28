<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use App\Models\SuratDomisili;
use App\Models\SuratSkm;
use App\Models\SuratSku;
use App\Models\SuratSktm;
use App\Models\SuratKeteranganLahir;
use App\Models\SuratPengantar;
use App\Models\SuratKeteranganMenikah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SuratMasukController extends Controller
{
    /**
     * Menampilkan daftar semua surat yang sudah selesai dan diarsipkan.
     */
    public function index(Request $request)
    {
        $jenisSurat = $request->get('jenis', 'semua');
        $status = $request->get('status', 'semua');
        $tanggal = $request->get('tanggal', '');
        
        $query = SuratMasuk::with(['user', 'admin'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan jenis surat
        if ($jenisSurat !== 'semua') {
            $query->where('jenis_surat', $jenisSurat);
        }

        // Filter berdasarkan status
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        // Filter berdasarkan tanggal
        if ($tanggal) {
            $query->whereDate('tanggal_terbit', $tanggal);
        }

        $suratMasuk = $query->paginate(15);

        // Statistik untuk dashboard
        $statistik = [
            'total' => SuratMasuk::count(),
            'siap_download' => SuratMasuk::where('status', 'siap_download')->count(),
            'sudah_diambil' => SuratMasuk::where('status', 'sudah_diambil')->count(),
            'bulan_ini' => SuratMasuk::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->count(),
        ];

        return view('admin.surat_masuk.index', compact(
            'suratMasuk', 'statistik', 'jenisSurat', 'status', 'tanggal'
        ));
    }

    /**
     * Tampilkan form untuk upload surat yang sudah ditandatangani
     */
    public function create(Request $request)
    {
        $jenis = $request->get('jenis');
        $suratId = $request->get('surat_id');
        
        if (!$jenis || !$suratId) {
            return redirect()->route('pengajuanSurat.index')
                ->with('error', 'Parameter tidak valid');
        }

        // Ambil data surat berdasarkan jenis dan ID
        $surat = $this->getSuratByJenisAndId($jenis, $suratId);
        
        if (!$surat || $surat->status !== 'selesai') {
            return redirect()->route('pengajuanSurat.index')
                ->with('error', 'Surat tidak ditemukan atau belum selesai diproses');
        }

        return view('admin.surat_masuk.create', compact('surat', 'jenis'));
    }

    /**
     * Simpan surat yang sudah ditandatangani ke surat masuk
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string',
            'surat_asal_id' => 'required|integer',
            'nomor_surat_resmi' => 'required|string',
            'file_ttd' => 'required|file|mimes:pdf|max:10240', // Max 10MB
            'nama_penerima' => 'required|string|max:255',
            'tanggal_terbit' => 'required|date',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        // Ambil data surat asli untuk validasi
        $suratAsli = $this->getSuratByJenisAndId($request->jenis_surat, $request->surat_asal_id);
        
        if (!$suratAsli || $suratAsli->status !== 'selesai') {
            return back()->with('error', 'Surat asli tidak valid atau belum selesai');
        }

        DB::beginTransaction();
        
        try {
            // Upload file PDF yang sudah ditandatangani
            $filePath = $request->file('file_ttd')->store('surat-masuk', 'public');

            // Buat record surat masuk baru
            $suratMasuk = SuratMasuk::create([
                'user_id' => $suratAsli->user_id,
                'admin_id' => Auth::id(),
                'jenis_surat' => $this->getJenisSuratLabel($request->jenis_surat),
                'surat_asal_id' => $request->surat_asal_id,
                'nomor_surat_pengajuan' => $suratAsli->nomor_surat,
                'nomor_surat_resmi' => $request->nomor_surat_resmi,
                'file_path_ttd' => $filePath,
                'nama_penerima' => $request->nama_penerima,
                'tanggal_terbit' => $request->tanggal_terbit,
                'catatan_admin' => $request->catatan_admin,
                'status' => 'siap_download'
            ]);

            // Update status surat asli menjadi 'arsip' atau tambahkan field khusus
            // Opsional: Bisa menambah field 'sudah_diarsipkan' di tabel surat asli

            DB::commit();

            return redirect()->route('suratMasuk.index')
                ->with('success', 'Surat berhasil diarsipkan dan siap untuk didownload user');

        } catch (\Exception $e) {
            DB::rollback();
            
            // Hapus file jika ada error
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            
            return back()->with('error', 'Gagal menyimpan surat: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail surat masuk
     */
    public function show(SuratMasuk $suratMasuk)
    {
        $suratMasuk->load(['user', 'admin']);
        
        return view('admin.surat_masuk.show', compact('suratMasuk'));
    }

    /**
     * Download file surat yang sudah ditandatangani (untuk admin)
     */
    public function download(SuratMasuk $suratMasuk)
    {
        if (!Storage::disk('public')->exists($suratMasuk->file_path_ttd)) {
            return back()->with('error', 'File surat tidak ditemukan');
        }

        $fileName = $suratMasuk->nomor_surat_resmi . '.pdf';
        
        $filePath = storage_path('app/public/' . $suratMasuk->file_path_ttd);
        return response()->download($filePath, $fileName);
    }

    /**
     * Update status surat masuk
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $request->validate([
            'status' => 'required|in:siap_download,sudah_diambil',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        $suratMasuk->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);

        return back()->with('success', 'Status surat berhasil diupdate');
    }

    /**
     * Hapus surat masuk (soft delete atau hard delete)
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        try {
            // Hapus file PDF
            if (Storage::disk('public')->exists($suratMasuk->file_path_ttd)) {
                Storage::disk('public')->delete($suratMasuk->file_path_ttd);
            }

            $suratMasuk->delete();

            return redirect()->route('suratMasuk.index')
                ->with('success', 'Surat berhasil dihapus dari arsip');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus surat: ' . $e->getMessage());
        }
    }

    /**
     * Batch operations untuk multiple surat
     */
    public function batchUpdate(Request $request)
    {
        $request->validate([
            'surat_ids' => 'required|array',
            'surat_ids.*' => 'exists:surat_masuk,id',
            'batch_action' => 'required|in:update_status,delete',
            'batch_status' => 'required_if:batch_action,update_status|in:siap_download,sudah_diambil',
        ]);

        $updated = 0;

        foreach ($request->surat_ids as $id) {
            $suratMasuk = SuratMasuk::find($id);
            
            if ($suratMasuk) {
                if ($request->batch_action === 'update_status') {
                    $suratMasuk->update(['status' => $request->batch_status]);
                    $updated++;
                } elseif ($request->batch_action === 'delete') {
                    // Hapus file
                    if (Storage::disk('public')->exists($suratMasuk->file_path_ttd)) {
                        Storage::disk('public')->delete($suratMasuk->file_path_ttd);
                    }
                    $suratMasuk->delete();
                    $updated++;
                }
            }
        }

        $action = $request->batch_action === 'update_status' ? 'diupdate' : 'dihapus';
        
        return back()->with('success', "{$updated} surat berhasil {$action}");
    }

    /**
     * Export data surat masuk ke Excel (placeholder)
     */
    // public function export(Request $request)
    // {
    //     // TODO: Implementasi export menggunakan Laravel Excel
    //     return back()->with('info', 'Fitur export akan segera tersedia');
    // }

    /**
     * Statistik dan laporan surat masuk
     */
    public function report(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        // Statistik per jenis surat
        $statistikJenis = SuratMasuk::selectRaw('jenis_surat, COUNT(*) as total')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('jenis_surat')
            ->get();

        // Statistik per admin
        $statistikAdmin = SuratMasuk::with('admin')
            ->selectRaw('admin_id, COUNT(*) as total')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('admin_id')
            ->get();

        // Trend harian dalam bulan
        $trendHarian = SuratMasuk::selectRaw('DAY(created_at) as hari, COUNT(*) as total')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('hari')
            ->orderBy('hari')
            ->get();

        return view('admin.surat_masuk.report', compact(
            'statistikJenis', 'statistikAdmin', 'trendHarian', 'bulan', 'tahun'
        ));
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
                return SuratSkm::with('user')->find($id);
            case 'sku':
                return SuratSku::with('user')->find($id);
            case 'sktm':
                return SuratSktm::with('user')->find($id);
            case 'keterangan_lahir':
                return SuratKeteranganLahir::with('user')->find($id);
            case 'pengantar':
                return SuratPengantar::with('user')->find($id);
            case 'keterangan_menikah':
                return SuratKeteranganMenikah::with('user')->find($id);
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
}