<?php

namespace App\Http\Controllers;

use App\Models\SuratDomisili;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DomisiliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.domisili.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.domisili.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $validatedData = $request->validate([
            'nama'              => ['required', 'string', 'max:255'],
            'nik'               => ['required', 'string', 'digits:16', 'unique:surat_domisili,nik'],
            'tempat_lahir'      => ['required', 'string', 'max:255'],
            'tanggal_lahir'     => ['required', 'date'],
            'jenis_kelamin'     => ['required', 'in:Laki-laki,Perempuan'],
            'agama'             => ['required', 'string', 'max:255'],
            'alamat_sekarang'   => ['required', 'string'],
            'alamat_sebelumnya' => ['required', 'string'],
            'maksud_dan_tujuan' => ['required', 'string'],
        ]);
        $validatedData['user_id'] = Auth::id(); 
        $validatedData['nomor_surat'] = 'SD/' . date('Y/m') . '/' . strtoupper(Str::random(6));
        SuratDomisili::create($validatedData);
        return redirect()->route('surat.index') 
                         ->with('success', 'Pengajuan Surat Domisili berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratDomisili $domisili)
    {
        if ($domisili->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('user.domisili.show', compact('domisili'));
    }

    public function edit(SuratDomisili $domisili)
    {
        if ($domisili->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($domisili->status !== 'diproses') {
            return redirect()->route('surat.tracking')->with('error', 'Surat yang sudah diproses tidak dapat diedit.');
        }
        return view('user.domisili.edit', ['suratDomisili' => $domisili]);
    }

    public function update(Request $request, SuratDomisili $domisili)
    {
        if ($domisili->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16', Rule::unique('surat_domisili')->ignore($domisili->id)],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'alamat_sekarang' => ['required', 'string'],
            'alamat_sebelumnya' => ['required', 'string'],
            'maksud_dan_tujuan' => ['required', 'string'],
        ]);
        $domisili->update($validatedData);
        return redirect()->route('surat.tracking')->with('success', 'Data Surat Domisili berhasil diperbarui!');
    }

    public function destroy(SuratDomisili $domisili)
    {
        if ($domisili->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($domisili->status === 'selesai') {
            return back()->with('error', 'Surat yang sudah selesai tidak dapat dihapus.');
        }
        $domisili->delete();
        return redirect()->route('surat.tracking')->with('success', 'Surat Domisili berhasil dihapus.');
    }
}
