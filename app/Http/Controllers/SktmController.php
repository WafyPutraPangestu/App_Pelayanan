<?php

namespace App\Http\Controllers;

use App\Models\SuratSktm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SktmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.sktm.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.sktm.create');
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
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['nomor_surat'] = 'SKTM/' . date('Y/m') . '/' . strtoupper(Str::random(6));

        SuratSktm::create($validatedData);

        return redirect()->route('surat.index') // Ganti dengan route Anda
                         ->with('success', 'Surat Keterangan Tidak Mampu berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.sktm.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.sktm.edit');
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
