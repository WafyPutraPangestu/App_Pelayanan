<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeteranganMenikah;
use App\Models\CalonPengantin;
use App\Models\OrangTuaCalonPengantin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeteranganMenikahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.keterangan_menikah.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.keterangan_menikah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'status_perkawinan_pria' => 'required|in:Belum Menikah,Cerai Hidup,Cerai Mati',
        'status_perkawinan_wanita' => 'required|in:Belum Menikah,Cerai Hidup,Cerai Mati',
        
        // Validasi data pria
        'pria.nama' => 'required|string|max:255',
        'pria.nik' => 'required|string|size:16|unique:calon_pengantin,nik',
        'pria.tempat_lahir' => 'required|string|max:255',
        'pria.tanggal_lahir' => 'required|date|before:today',
        'pria.agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'pria.pekerjaan' => 'required|string|max:255',
        'pria.kewarganegaraan' => 'required|string|max:255',
        'pria.alamat' => 'required|string',
        
        // Validasi orang tua pria
        'pria.ayah_nama' => 'required|string|max:255',
        'pria.ayah_nik' => 'required|string|size:16',
        'pria.ayah_tempat_lahir' => 'required|string|max:255',
        'pria.ayah_tanggal_lahir' => 'required|date|before:today',
        'pria.ayah_agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'pria.ayah_pekerjaan' => 'required|string|max:255',
        'pria.ayah_kewarganegaraan' => 'required|string|max:255',
        'pria.ayah_alamat' => 'required|string',
        
        'pria.ibu_nama' => 'required|string|max:255',
        'pria.ibu_nik' => 'required|string|size:16',
        'pria.ibu_tempat_lahir' => 'required|string|max:255',
        'pria.ibu_tanggal_lahir' => 'required|date|before:today',
        'pria.ibu_agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'pria.ibu_pekerjaan' => 'required|string|max:255',
        'pria.ibu_kewarganegaraan' => 'required|string|max:255',
        'pria.ibu_alamat' => 'required|string',
        
        // Validasi data wanita
        'wanita.nama' => 'required|string|max:255',
        'wanita.nik' => 'required|string|size:16|unique:calon_pengantin,nik',
        'wanita.tempat_lahir' => 'required|string|max:255',
        'wanita.tanggal_lahir' => 'required|date|before:today',
        'wanita.agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'wanita.pekerjaan' => 'required|string|max:255',
        'wanita.kewarganegaraan' => 'required|string|max:255',
        'wanita.alamat' => 'required|string',
        
        // Validasi orang tua wanita
        'wanita.ayah_nama' => 'required|string|max:255',
        'wanita.ayah_nik' => 'required|string|size:16',
        'wanita.ayah_tempat_lahir' => 'required|string|max:255',
        'wanita.ayah_tanggal_lahir' => 'required|date|before:today',
        'wanita.ayah_agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'wanita.ayah_pekerjaan' => 'required|string|max:255',
        'wanita.ayah_kewarganegaraan' => 'required|string|max:255',
        'wanita.ayah_alamat' => 'required|string',
        
        'wanita.ibu_nama' => 'required|string|max:255',
        'wanita.ibu_nik' => 'required|string|size:16',
        'wanita.ibu_tempat_lahir' => 'required|string|max:255',
        'wanita.ibu_tanggal_lahir' => 'required|date|before:today',
        'wanita.ibu_agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'wanita.ibu_pekerjaan' => 'required|string|max:255',
        'wanita.ibu_kewarganegaraan' => 'required|string|max:255',
        'wanita.ibu_alamat' => 'required|string',
    ],[
        'pria.nik.unique' => 'NIK calon pengantin pria sudah terdaftar.',
        'wanita.nik.unique' => 'NIK calon pengantin wanita sudah terdaftar.',
        'pria.tanggal_lahir.before' => 'Tanggal lahir calon pengantin pria harus sebelum hari ini.',
        'wanita.tanggal_lahir.before' => 'Tanggal lahir calon pengantin wanita harus sebelum hari ini.',
        'pria.ayah_tanggal_lahir.before' => 'Tanggal lahir ayah calon pengantin pria harus sebelum hari ini.',
        'pria.ibu_tanggal_lahir.before' => 'Tanggal lahir ibu calon pengantin pria harus sebelum hari ini.',
        'wanita.ayah_tanggal_lahir.before' => 'Tanggal lahir ayah calon pengantin wanita harus sebelum hari ini.',
        'wanita.ibu_tanggal_lahir.before' => 'Tanggal lahir ibu calon pengantin wanita harus sebelum hari ini.',
        'pria.nik.size' => 'NIK calon pengantin pria harus 16 digit.',
        'wanita.nik.size' => 'NIK calon pengantin wanita harus 16 digit.',
        'pria.ayah_nik.size' => 'NIK ayah calon pengantin pria harus 16 digit.',
        'pria.ibu_nik.size' => 'NIK ibu calon pengantin pria harus 16 digit.',
        'wanita.ayah_nik.size' => 'NIK ayah calon pengantin wanita harus 16 digit.',
        'wanita.ibu_nik.size' => 'NIK ibu calon pengantin wanita harus 16 digit.',      
        'pria.agama.in' => 'Agama calon pengantin pria tidak valid.',
        'wanita.agama.in' => 'Agama calon pengantin wanita tidak valid.',
        'pria.ayah_agama.in' => 'Agama ayah calon pengantin pria tidak valid.',
        'pria.ibu_agama.in' => 'Agama ibu calon pengantin pria tidak valid.',
        'wanita.ayah_agama.in' => 'Agama ayah calon pengantin wanita tidak valid.',
        'wanita.ibu_agama.in' => 'Agama ibu calon pengantin wanita tidak valid.',
        'status_perkawinan_pria.in' => 'Status perkawinan pria tidak valid.',
        'status_perkawinan_wanita.in' => 'Status perkawinan wanita tidak valid.',
        
    ]);

    DB::beginTransaction();

    try {
        // Generate nomor surat
        $nomorSurat = 'SKM-' . date('Y') . '-' . str_pad(SuratKeteranganMenikah::count() + 1, 4, '0', STR_PAD_LEFT);

        // Simpan surat keterangan menikah
        $suratKeteranganMenikah = SuratKeteranganMenikah::create([
            'user_id' => Auth::id(),
            'nomor_surat' => $nomorSurat,
            'status_perkawinan_pria' => $request->status_perkawinan_pria,
            'status_perkawinan_wanita' => $request->status_perkawinan_wanita,
            'status' => 'diproses',
        ]);

        // Simpan data calon pengantin pria
        $calonPria = CalonPengantin::create([
            'surat_keterangan_menikah_id' => $suratKeteranganMenikah->id,
            'nama' => $request->pria['nama'],
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => $request->pria['tempat_lahir'],
            'tanggal_lahir' => $request->pria['tanggal_lahir'],
            'agama' => $request->pria['agama'],
            'nik' => $request->pria['nik'],
            'pekerjaan' => $request->pria['pekerjaan'],
            'kewarganegaraan' => $request->pria['kewarganegaraan'],
            'alamat' => $request->pria['alamat'],
        ]);

        // Simpan data orang tua pria
        OrangTuaCalonPengantin::create([
            'calon_pengantin_id' => $calonPria->id,
            'jenis_orang_tua' => 'ayah',
            'nama' => $request->pria['ayah_nama'],
            'tempat_lahir' => $request->pria['ayah_tempat_lahir'],
            'tanggal_lahir' => $request->pria['ayah_tanggal_lahir'],
            'agama' => $request->pria['ayah_agama'],
            'nik' => $request->pria['ayah_nik'],
            'pekerjaan' => $request->pria['ayah_pekerjaan'],
            'kewarganegaraan' => $request->pria['ayah_kewarganegaraan'],
            'alamat' => $request->pria['ayah_alamat'],
        ]);

        OrangTuaCalonPengantin::create([
            'calon_pengantin_id' => $calonPria->id,
            'jenis_orang_tua' => 'ibu',
            'nama' => $request->pria['ibu_nama'],
            'tempat_lahir' => $request->pria['ibu_tempat_lahir'],
            'tanggal_lahir' => $request->pria['ibu_tanggal_lahir'],
            'agama' => $request->pria['ibu_agama'],
            'nik' => $request->pria['ibu_nik'],
            'pekerjaan' => $request->pria['ibu_pekerjaan'],
            'kewarganegaraan' => $request->pria['ibu_kewarganegaraan'],
            'alamat' => $request->pria['ibu_alamat'],
        ]);

        // Simpan data calon pengantin wanita
        $calonWanita = CalonPengantin::create([
            'surat_keterangan_menikah_id' => $suratKeteranganMenikah->id,
            'nama' => $request->wanita['nama'],
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => $request->wanita['tempat_lahir'],
            'tanggal_lahir' => $request->wanita['tanggal_lahir'],
            'agama' => $request->wanita['agama'],
            'nik' => $request->wanita['nik'],
            'pekerjaan' => $request->wanita['pekerjaan'],
            'kewarganegaraan' => $request->wanita['kewarganegaraan'],
            'alamat' => $request->wanita['alamat'],
        ]);

        // Simpan data orang tua wanita
        OrangTuaCalonPengantin::create([
            'calon_pengantin_id' => $calonWanita->id,
            'jenis_orang_tua' => 'ayah',
            'nama' => $request->wanita['ayah_nama'],
            'tempat_lahir' => $request->wanita['ayah_tempat_lahir'],
            'tanggal_lahir' => $request->wanita['ayah_tanggal_lahir'],
            'agama' => $request->wanita['ayah_agama'],
            'nik' => $request->wanita['ayah_nik'],
            'pekerjaan' => $request->wanita['ayah_pekerjaan'],
            'kewarganegaraan' => $request->wanita['ayah_kewarganegaraan'],
            'alamat' => $request->wanita['ayah_alamat'],
        ]);

        OrangTuaCalonPengantin::create([
            'calon_pengantin_id' => $calonWanita->id,
            'jenis_orang_tua' => 'ibu',
            'nama' => $request->wanita['ibu_nama'],
            'tempat_lahir' => $request->wanita['ibu_tempat_lahir'],
            'tanggal_lahir' => $request->wanita['ibu_tanggal_lahir'],
            'agama' => $request->wanita['ibu_agama'],
            'nik' => $request->wanita['ibu_nik'],
            'pekerjaan' => $request->wanita['ibu_pekerjaan'],
            'kewarganegaraan' => $request->wanita['ibu_kewarganegaraan'],
            'alamat' => $request->wanita['ibu_alamat'],
        ]);

        DB::commit();

        return redirect()->route('surat.index')
            ->with('success', 'Surat keterangan menikah berhasil diajukan dengan nomor: ' . $nomorSurat);

    } catch (\Exception $e) {
        DB::rollBack();
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.keterangan_menikah.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.keterangan_menikah.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
