<?php

namespace App\Http\Controllers;

use App\Models\SuratSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.sku.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.sku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'kewarganegaraan' => ['required', 'string', 'max:255'],
            'nama_usaha' => ['required', 'string', 'max:255'],
            'jenis_usaha' => ['required', 'string', 'max:255'],
            'alamat_usaha' => ['required', 'string'],
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['nomor_surat'] = 'SKU/' . date('Y/m') . '/' . strtoupper(Str::random(6));

        SuratSku::create($validatedData);

        return redirect()->route('surat.index') // Ganti dengan route Anda
                         ->with('success', 'Surat Keterangan Usaha berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratSku $sku)
    {
        if ($sku->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('user.sku.show', compact('sku'));
    }

    public function edit(SuratSku $sku)
    {
        if ($sku->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($sku->status !== 'diproses') {
            return redirect()->route('surat.tracking')->with('error', 'Surat yang sudah diproses tidak dapat diedit.');
        }
        return view('user.sku.edit', compact('sku'));
    }

    public function update(Request $request, SuratSku $sku)
    {
        if ($sku->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16', Rule::unique('surat_sku')->ignore($sku->id)],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'kewarganegaraan' => ['required', 'string', 'max:255'],
            'nama_usaha' => ['required', 'string', 'max:255'],
            'jenis_usaha' => ['required', 'string', 'max:255'],
            'alamat_usaha' => ['required', 'string'],
        ]);

        $sku->update($validatedData);
        return redirect()->route('surat.tracking')->with('success', 'Data Surat Keterangan Usaha berhasil diperbarui!');
    }

    public function destroy(SuratSku $sku)
    {
        if ($sku->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($sku->status === 'selesai') {
            return back()->with('error', 'Surat yang sudah selesai tidak dapat dihapus.');
        }
        $sku->delete();
        return redirect()->route('surat.tracking')->with('success', 'Surat Keterangan Usaha berhasil dihapus.');
    }
}
