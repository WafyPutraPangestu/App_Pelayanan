<?php

namespace App\Http\Controllers;

use App\Models\SuratSktm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
    public function show(SuratSktm $sktm)
    {
        if ($sktm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('user.sktm.show', compact('sktm'));
    }

    public function edit(SuratSktm $sktm)
    {
        if ($sktm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($sktm->status !== 'diproses') {
            return redirect()->route('surat.tracking')->with('error', 'Surat yang sudah diproses tidak dapat diedit.');
        }
        return view('user.sktm.edit', compact('sktm'));
    }

    public function update(Request $request, SuratSktm $sktm)
    {
        if ($sktm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16', Rule::unique('surat_sktm')->ignore($sktm->id)],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        $sktm->update($validatedData);
        return redirect()->route('surat.tracking')->with('success', 'Data Surat Keterangan Tidak Mampu berhasil diperbarui!');
    }

    public function destroy(SuratSktm $sktm)
    {
        if ($sktm->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($sktm->status === 'selesai') {
            return back()->with('error', 'Surat yang sudah selesai tidak dapat dihapus.');
        }
        $sktm->delete();
        return redirect()->route('surat.tracking')->with('success', 'Surat Keterangan Tidak Mampu berhasil dihapus.');
    }
}
