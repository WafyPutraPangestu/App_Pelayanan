<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class pengaduanController extends Controller
{

    public function index(Request $request)
    {
        $userId = Auth::id();

        // Query dasar untuk pengaduan milik user
        $query = Pengaduan::where('user_id', $userId);

        // Terapkan filter pencarian jika ada
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Terapkan filter status jika ada
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Terapkan filter category jika ada
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $pengaduans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Statistik juga hanya untuk user yang login
        $stats = [
            'total' => Pengaduan::where('user_id', $userId)->count(),
            'baru' => Pengaduan::where('user_id', $userId)->baru()->count(),
            'diproses' => Pengaduan::where('user_id', $userId)->diproses()->count(),
            'selesai' => Pengaduan::where('user_id', $userId)->selesai()->count(),
        ];

        return view('user.pengaduan.index', compact('pengaduans', 'stats'));
    }



    public function create()
    {
        $mainCategories = [
            'pelayanan administrasi' => 'Terkait pembuatan surat, dokumen kependudukan, dll.',
            'pelayanan umum' => 'Terkait fasilitas umum, infrastruktur, kebersihan, dll.'
        ];

        $categories = [
           'Surat Domisili' => 'Pengajuan surat keterangan tempat tinggal.',
           'Surat Keterangan Lahir' => 'Pengajuan surat keterangan kelahiran anak.',
           'Surat Keterangan Menikah' => 'Pengajuan surat pengantar untuk keperluan menikah.',
           'Surat Pengantar' => 'Pengajuan surat pengantar untuk berbagai keperluan umum.',
           'Surat Keterangan Kematian' => 'Pengajuan Surat Keterangan Kematian (SKM).',
           'Surat Keterangan Tidak Mampu' => 'Pengajuan Surat Keterangan Tidak Mampu (SKTM).',
           'Surat Keterangan Usaha' => 'Pengajuan Surat Keterangan Usaha (SKU).',
        ];

        return view('user.pengaduan.create', compact('categories', 'mainCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5|max:255',
            'isi_pengaduan' => 'required|min:20',
            'category' => 'required|in:pelayanan administrasi,pelayanan umum',
            'kategori' => 'nullable',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048'
        ], [
            'judul.required' => 'Judul pengaduan harus diisi',
            'judul.min' => 'Judul pengaduan minimal 5 karakter',
            'isi_pengaduan.required' => 'Isi pengaduan harus diisi',
            'isi_pengaduan.min' => 'Isi pengaduan minimal 20 karakter',
            'category.required' => 'Jenis layanan harus dipilih',
       
            'lampiran.mimes' => 'Format file tidak didukung',
            'lampiran.max' => 'Ukuran file maksimal 2MB'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Handle file upload
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $data['lampiran'] = $file->storeAs('pengaduan', $filename, 'public');
        }

        Pengaduan::create($data);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil disubmit! Kami akan segera menindaklanjuti pengaduan Anda.');
    }
    
    public function show(Pengaduan $pengaduan)
    {
        // Keamanan: pastikan user hanya bisa melihat pengaduan miliknya
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }
        return view('user.pengaduan.show', compact('pengaduan'));
    }
    
    public function edit(Pengaduan $pengaduan)
    {
        // Keamanan: Pastikan user hanya bisa mengedit pengaduan miliknya
        // dan hanya jika statusnya masih 'baru'.
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status !== 'baru') {
            abort(403, 'ANDA TIDAK DAPAT MENGEDIT PENGADUAN INI.');
        }
    
        $mainCategories = [
            'pelayanan administrasi' => 'Terkait pembuatan surat, dokumen kependudukan, dll.',
            'pelayanan umum' => 'Terkait fasilitas umum, infrastruktur, kebersihan, dll.'
        ];
    
        // Siapkan data kategori, sama seperti di method create
        $categories = [
            'Surat Domisili' => 'Pengajuan surat keterangan tempat tinggal.',
            'Surat Keterangan Lahir' => 'Pengajuan surat keterangan kelahiran anak.',
            'Surat Keterangan Menikah' => 'Pengajuan surat pengantar untuk keperluan menikah.',
            'Surat Pengantar' => 'Pengajuan surat pengantar untuk berbagai keperluan umum.',
            'Surat Keterangan Kematian' => 'Pengajuan Surat Keterangan Kematian (SKM).',
            'Surat Keterangan Tidak Mampu' => 'Pengajuan Surat Keterangan Tidak Mampu (SKTM).',
            'Surat Keterangan Usaha' => 'Pengajuan Surat Keterangan Usaha (SKU).',
        ];
    
        return view('user.pengaduan.edit', compact('pengaduan', 'categories', 'mainCategories'));
    }
    
    public function update(Request $request, Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status !== 'baru') {
            abort(403, 'Anda tidak dapat mengedit pengaduan ini.');
        }
    
        $request->validate([
            'judul' => 'required|min:5|max:255',
            'isi_pengaduan' => 'required|min:20',
            'category' => 'required|in:pelayanan administrasi,pelayanan umum',
            'kategori' => 'nullable',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048'
        ]);
        
        $data = $request->only(['judul', 'isi_pengaduan', 'category', 'kategori']);
    
        if ($request->hasFile('lampiran')) {
            // Hapus lampiran lama jika ada
            if ($pengaduan->lampiran) {
                Storage::disk('public')->delete($pengaduan->lampiran);
            }
            $data['lampiran'] = $request->file('lampiran')->store('pengaduan', 'public');
        }
    
        $pengaduan->update($data);
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui!');
    }
    
    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status !== 'baru') {
            abort(403, 'Anda tidak dapat menghapus pengaduan ini.');
        }
    
        // Hapus lampiran dari storage
        if ($pengaduan->lampiran) {
            Storage::disk('public')->delete($pengaduan->lampiran);
        }
    
        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }

}

