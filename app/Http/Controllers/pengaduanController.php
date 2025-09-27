<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class pengaduanController extends Controller
{

    public function index()
    {
        $pengaduans = Pengaduan::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total' => Pengaduan::count(),
            'baru' => Pengaduan::baru()->count(),
            'diproses' => Pengaduan::diproses()->count(),
            'selesai' => Pengaduan::selesai()->count(),
        ];

        return view('user.pengaduan.index', compact('pengaduans', 'stats'));
    }


    public function create()
    {
        $categories = [
           'Surat Domisili' => 'Pengajuan surat keterangan tempat tinggal.',
    'Surat Keterangan Lahir' => 'Pengajuan surat keterangan kelahiran anak.',
    'Surat Keterangan Menikah' => 'Pengajuan surat pengantar untuk keperluan menikah.',
    'Surat Pengantar' => 'Pengajuan surat pengantar untuk berbagai keperluan umum.',
    'Surat Keterangan Kematian' => 'Pengajuan Surat Keterangan Kematian (SKM).',
    'Surat Keterangan Tidak Mampu' => 'Pengajuan Surat Keterangan Tidak Mampu (SKTM).',
    'Surat Keterangan Usaha' => 'Pengajuan Surat Keterangan Usaha (SKU).',
        ];

        return view('user.pengaduan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5|max:255',
            'isi_pengaduan' => 'required|min:20',
            'kategori' => 'required',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048'
        ], [
            'judul.required' => 'Judul pengaduan harus diisi',
            'judul.min' => 'Judul pengaduan minimal 5 karakter',
            'isi_pengaduan.required' => 'Isi pengaduan harus diisi',
            'isi_pengaduan.min' => 'Isi pengaduan minimal 20 karakter',
            'kategori.required' => 'Kategori harus dipilih',
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
}
