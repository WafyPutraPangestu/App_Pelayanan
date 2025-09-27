<?php

namespace App\Http\Controllers;

use App\Models\SuratDomisili;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
    public function show(string $id)
    {
        return view('user.domisili.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.domisili.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
