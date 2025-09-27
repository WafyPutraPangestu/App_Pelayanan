<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
    public function show(SuratPengantar $surat_pengantar)
    {
        if ($surat_pengantar->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('user.surat_pengantar.show', compact('surat_pengantar'));
    }

    public function edit(SuratPengantar $surat_pengantar)
    {
        if ($surat_pengantar->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($surat_pengantar->status !== 'diproses') {
            return redirect()->route('surat.tracking')->with('error', 'Surat yang sudah diproses tidak dapat diedit.');
        }
        return view('user.surat_pengantar.edit', compact('surat_pengantar'));
    }

    public function update(Request $request, SuratPengantar $surat_pengantar)
    {
        if ($surat_pengantar->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16', Rule::unique('surat_pengantar')->ignore($surat_pengantar->id)],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'maksud_dan_tujuan' => ['required', 'string'],
        ]);

        $surat_pengantar->update($validatedData);
        return redirect()->route('surat.tracking')->with('success', 'Data Surat Pengantar berhasil diperbarui!');
    }

    public function destroy(SuratPengantar $surat_pengantar)
    {
        if ($surat_pengantar->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($surat_pengantar->status === 'selesai') {
            return back()->with('error', 'Surat yang sudah selesai tidak dapat dihapus.');
        }
        $surat_pengantar->delete();
        return redirect()->route('surat.tracking')->with('success', 'Surat Pengantar berhasil dihapus.');
    }
}
