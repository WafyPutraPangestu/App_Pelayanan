<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SuratPengantarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.surat_pengantar.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.surat_pengantar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'maksud_dan_tujuan' => ['required', 'string'],
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['nomor_surat'] = 'SP/' . date('Y/m') . '/' . strtoupper(Str::random(6));

        SuratPengantar::create($validatedData);

        return redirect()->route('surat.index') // Ganti dengan route Anda
                         ->with('success', 'Surat Pengantar berhasil diajukan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.surat_pengantar.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.surat_pengantar.edit');
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
