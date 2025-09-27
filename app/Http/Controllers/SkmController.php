<?php

namespace App\Http\Controllers;

use App\Models\PelaporKematian;
use App\Models\SuratSkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.skm.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.skm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi gabungan untuk kedua tabel
        $validatedData = $request->validate([
            // Aturan untuk tabel surat_skm
            'nama_almarhum' => ['required', 'string', 'max:255'],
            'nik_almarhum' => ['required', 'string', 'digits:16'],
            'tempat_lahir_almarhum' => ['required', 'string', 'max:255'],
            'tanggal_lahir_almarhum' => ['required', 'date'],
            'jenis_kelamin_almarhum' => ['required', 'in:Laki-laki,Perempuan'],
            'agama_almarhum' => ['required', 'string', 'max:255'],
            'tanggal_kematian' => ['required', 'date'],
            'waktu_kematian' => ['required'],
            'penyebab_kematian' => ['required', 'string', 'max:255'],
            'alamat_almarhum' => ['required', 'string'],

            // Aturan untuk tabel pelapor_kematian
            'nama_pelapor' => ['required', 'string', 'max:255'],
            'nik_pelapor' => ['required', 'string', 'digits:16'],
            'tempat_lahir_pelapor' => ['required', 'string', 'max:255'],
            'tanggal_lahir_pelapor' => ['required', 'date'],
            'jenis_kelamin_pelapor' => ['required', 'in:Laki-laki,Perempuan'],
            'pekerjaan_pelapor' => ['required', 'string', 'max:255'],
            'alamat_pelapor' => ['required', 'string'],
            'hubungan_dengan_almarhum' => ['required', 'string', 'max:255'],
        ]);

        // Menggunakan DB Transaction untuk memastikan kedua data berhasil disimpan
        try {
            DB::beginTransaction();

            // 1. Simpan data ke tabel surat_skm
            $suratSkm = SuratSkm::create([
                'user_id' => Auth::id(),
                'nomor_surat' => 'SKM/' . date('Y/m') . '/' . strtoupper(Str::random(6)),
                'nama_almarhum' => $validatedData['nama_almarhum'],
                'nik_almarhum' => $validatedData['nik_almarhum'],
                'tempat_lahir_almarhum' => $validatedData['tempat_lahir_almarhum'],
                'tanggal_lahir_almarhum' => $validatedData['tanggal_lahir_almarhum'],
                'jenis_kelamin_almarhum' => $validatedData['jenis_kelamin_almarhum'],
                'agama_almarhum' => $validatedData['agama_almarhum'],
                'tanggal_kematian' => $validatedData['tanggal_kematian'],
                'waktu_kematian' => $validatedData['waktu_kematian'],
                'penyebab_kematian' => $validatedData['penyebab_kematian'],
                'alamat_almarhum' => $validatedData['alamat_almarhum'],
            ]);

            // 2. Simpan data ke tabel pelapor_kematian
            PelaporKematian::create([
                'surat_skm_id' => $suratSkm->id, // Ambil ID dari surat yang baru dibuat
                'nama_pelapor' => $validatedData['nama_pelapor'],
                'nik_pelapor' => $validatedData['nik_pelapor'],
                'tempat_lahir_pelapor' => $validatedData['tempat_lahir_pelapor'],
                'tanggal_lahir_pelapor' => $validatedData['tanggal_lahir_pelapor'],
                'jenis_kelamin_pelapor' => $validatedData['jenis_kelamin_pelapor'],
                'pekerjaan_pelapor' => $validatedData['pekerjaan_pelapor'],
                'alamat_pelapor' => $validatedData['alamat_pelapor'],
                'hubungan_dengan_almarhum' => $validatedData['hubungan_dengan_almarhum'],
            ]);

            DB::commit(); // Jika semua berhasil, simpan perubahan

            return redirect()->route('surat.index')
                             ->with('success', 'Surat Keterangan Kematian berhasil diajukan.');

        } catch (\Exception $e) {
            DB::rollBack(); // Jika ada error, batalkan semua perubahan
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratSkm $skm)
    {
        // Keamanan: pastikan user hanya bisa melihat surat miliknya
        if ($skm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // Muat relasi agar data pelapor tersedia di view
        $skm->load('pelaporKematian');

        return view('user.skm.show', compact('skm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratSkm $skm)
    {
        // Pastikan user hanya bisa edit surat miliknya
        if ($skm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // Pastikan surat hanya bisa diedit jika statusnya 'diproses'
        if ($skm->status !== 'diproses') {
            return redirect()->route('surat.tracking')->with('error', 'Surat yang sudah diproses tidak dapat diedit.');
        }
        
        // Eager load relasi pelaporKematian agar bisa diakses di view
        $skm->load('pelaporKematian');

        return view('user.skm.edit', compact('skm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratSkm $skm)
    {
        // Pastikan user hanya bisa update surat miliknya
        if ($skm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $validatedData = $request->validate([
            'nama_almarhum' => ['required', 'string', 'max:255'],
            'nik_almarhum' => ['required', 'string', 'digits:16'],
            'tempat_lahir_almarhum' => ['required', 'string', 'max:255'],
            'tanggal_lahir_almarhum' => ['required', 'date'],
            'jenis_kelamin_almarhum' => ['required', 'in:Laki-laki,Perempuan'],
            'agama_almarhum' => ['required', 'string', 'max:255'],
            'tanggal_kematian' => ['required', 'date'],
            'waktu_kematian' => ['required'],
            'penyebab_kematian' => ['required', 'string', 'max:255'],
            'alamat_almarhum' => ['required', 'string'],
            'nama_pelapor' => ['required', 'string', 'max:255'],
            'nik_pelapor' => ['required', 'string', 'digits:16'],
            'tempat_lahir_pelapor' => ['required', 'string', 'max:255'],
            'tanggal_lahir_pelapor' => ['required', 'date'],
            'jenis_kelamin_pelapor' => ['required', 'in:Laki-laki,Perempuan'],
            'pekerjaan_pelapor' => ['required', 'string', 'max:255'],
            'alamat_pelapor' => ['required', 'string'],
            'hubungan_dengan_almarhum' => ['required', 'string', 'max:255'],
        ]);

        try {
            DB::beginTransaction();

            // 1. Update data di tabel surat_skm
            $skm->update($validatedData);

            // 2. Update data di tabel pelapor_kematian melalui relasi
            if ($skm->pelaporKematian) {
                $skm->pelaporKematian->update($validatedData);
            }

            DB::commit();

            return redirect()->route('surat.tracking')
                             ->with('success', 'Data Surat Keterangan Kematian berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratSkm $skm)
    {
        // Keamanan: pastikan user hanya bisa menghapus surat miliknya
        if ($skm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // Logika tambahan: mungkin hanya surat dengan status tertentu yang bisa dihapus
        if ($skm->status == 'selesai') {
            return back()->with('error', 'Surat yang sudah selesai tidak dapat dihapus.');
        }

        try {
            // Hapus data surat
            $skm->delete();
            
            // Redirect kembali ke halaman tracking dengan pesan sukses
            return redirect()->route('surat.tracking')
                             ->with('success', 'Surat berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
