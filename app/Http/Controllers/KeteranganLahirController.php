<?php

namespace App\Http\Controllers;

use App\Models\SuratKeteranganLahir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KeteranganLahirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.keterangan_lahir.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.keterangan_lahir.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'waktu_lahir' => ['required'],
            'agama' => ['required', 'string', 'max:255'],
            'nama_ibu' => ['required', 'string', 'max:255'],
            'nama_ayah' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['nomor_surat'] = 'SKL/' . date('Y/m') . '/' . strtoupper(Str::random(6));

        SuratKeteranganLahir::create($validatedData);

        return redirect()->route('surat.index')
                         ->with('success', 'Surat Keterangan Kelahiran berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKeteranganLahir $keterangan_lahir)
    {
        if ($keterangan_lahir->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('user.keterangan_lahir.show', compact('keterangan_lahir'));
    }

    public function edit(SuratKeteranganLahir $keterangan_lahir)
    {
        if ($keterangan_lahir->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($keterangan_lahir->status !== 'diproses') {
            return redirect()->route('surat.tracking')->with('error', 'Surat yang sudah diproses tidak dapat diedit.');
        }
        return view('user.keterangan_lahir.edit', compact('keterangan_lahir'));
    }

    public function update(Request $request, SuratKeteranganLahir $keterangan_lahir)
    {
        if ($keterangan_lahir->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        $validatedData = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'waktu_lahir' => ['required'],
            'agama' => ['required', 'string', 'max:255'],
            'nama_ibu' => ['required', 'string', 'max:255'],
            'nama_ayah' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);
        $keterangan_lahir->update($validatedData);
        return redirect()->route('surat.tracking')->with('success', 'Data Surat Keterangan Lahir berhasil diperbarui!');
    }

    public function destroy(SuratKeteranganLahir $keterangan_lahir)
    {
        if ($keterangan_lahir->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($keterangan_lahir->status === 'selesai') {
            return back()->with('error', 'Surat yang sudah selesai tidak dapat dihapus.');
        }
        $keterangan_lahir->delete();
        return redirect()->route('surat.tracking')->with('success', 'Surat Keterangan Lahir berhasil dihapus.');
    }
}
