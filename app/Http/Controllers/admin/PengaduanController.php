<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan dengan filter dan statistik.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'semua');
        $kategori = $request->get('kategori', 'semua');

        $query = Pengaduan::with('user')->orderBy('created_at', 'desc');

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        if ($kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        $pengaduan = $query->paginate(10);

        $statistik = [
            'total' => Pengaduan::count(),
            'baru' => Pengaduan::where('status', 'baru')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        // Ambil semua kategori unik untuk filter dropdown
        $kategoriList = Pengaduan::select('kategori')->distinct()->pluck('kategori');

        return view('admin.pengaduan.index', compact('pengaduan', 'statistik', 'kategoriList', 'status', 'kategori'));
    }

    /**
     * Menampilkan detail pengaduan dan form untuk memberikan tanggapan.
     */
    public function show(Pengaduan $pengaduan)
    {
        // Route model binding akan otomatis mencari pengaduan berdasarkan ID
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Menyimpan tanggapan dan mengubah status pengaduan.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'tanggapan' => 'required|string',
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        $pengaduan->update([
            'tanggapan' => $request->tanggapan,
            'status' => $request->status,
            'tanggal_ditanggapi' => now(),
        ]);

        return redirect()->route('pengaduanAdmin.show', $pengaduan)->with('success', 'Tanggapan berhasil dikirim!');
    }

    /**
     * Menghapus pengaduan dari storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        // Hapus file lampiran jika ada
        if ($pengaduan->lampiran && Storage::disk('public')->exists($pengaduan->lampiran)) {
            Storage::disk('public')->delete($pengaduan->lampiran);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduanAdmin.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}