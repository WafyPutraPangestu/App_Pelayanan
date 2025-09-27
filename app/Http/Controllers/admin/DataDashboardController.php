<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataDashboard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataDashboardController extends Controller
{
    /**
     * Menampilkan daftar semua data wilayah.
     */
    public function index()
    {
        $dataWilayah = DataDashboard::orderBy('nama_wilayah')->get();
        return view('admin.data_dashboard.index', compact('dataWilayah'));
    }

    /**
     * Menampilkan form untuk menambah data wilayah baru.
     */
    public function create()
    {
        return view('admin.data_dashboard.create');
    }

    /**
     * Menyimpan data wilayah baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_wilayah' => 'required|string|max:255|unique:data_dashboard,nama_wilayah',
            'jumlah_keluarga' => 'required|integer|min:0',
            'jumlah_penduduk' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'jumlah_perempuan' => 'required|integer|min:0',
            'anggaran_apbdes' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        DataDashboard::create($validatedData);

        return redirect()->route('dataDashboard.index')->with('success', 'Data wilayah berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data wilayah.
     */
    public function edit(DataDashboard $dataDashboard)
    {
        return view('admin.data_dashboard.edit', compact('dataDashboard'));
    }

    /**
     * Memperbarui data wilayah di database.
     */
    public function update(Request $request, DataDashboard $dataDashboard)
    {
        $validatedData = $request->validate([
            'nama_wilayah' => ['required', 'string', 'max:255', Rule::unique('data_dashboard')->ignore($dataDashboard->id)],
            'jumlah_keluarga' => 'required|integer|min:0',
            'jumlah_penduduk' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'jumlah_perempuan' => 'required|integer|min:0',
            'anggaran_apbdes' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $dataDashboard->update($validatedData);

        return redirect()->route('dataDashboard.index')->with('success', 'Data wilayah berhasil diperbarui.');
    }

    /**
     * Menghapus data wilayah dari database.
     */
    public function destroy(DataDashboard $dataDashboard)
    {
        $dataDashboard->delete();
        return redirect()->route('dataDashboard.index')->with('success', 'Data wilayah berhasil dihapus.');
    }
}