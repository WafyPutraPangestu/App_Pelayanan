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
        $category = $request->get('category', 'semua');

        $query = Pengaduan::with('user')->orderBy('created_at', 'desc');

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        if ($kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        if ($category !== 'semua') {
            $query->where('category', $category);
        }

        $pengaduan = $query->paginate(10);

        $statistik = [
            'total' => Pengaduan::count(),
            'baru' => Pengaduan::where('status', 'baru')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        // Definisikan daftar filter secara statis agar semua opsi selalu muncul
        $mainCategoryList = [
            'pelayanan administrasi',
            'pelayanan umum'
        ];

        $kategoriList = [
           'Surat Domisili',
           'Surat Keterangan Lahir',
           'Surat Keterangan Menikah',
           'Surat Pengantar',
           'Surat Keterangan Kematian',
           'Surat Keterangan Tidak Mampu',
           'Surat Keterangan Usaha',
        ];

        return view('admin.pengaduan.index', compact('pengaduan', 'statistik', 'kategoriList', 'mainCategoryList', 'status', 'kategori', 'category'));
    }

    /**
     * Menampilkan detail pengaduan dan form untuk memberikan tanggapan.
     */
    public function show(Pengaduan $pengaduan)
    {
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
        if ($pengaduan->lampiran && Storage::disk('public')->exists($pengaduan->lampiran)) {
            Storage::disk('public')->delete($pengaduan->lampiran);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduanAdmin.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}

