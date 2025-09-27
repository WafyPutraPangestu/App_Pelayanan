<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar semua berita.
     */
    public function index()
    {
        $beritas = Berita::with('user')->latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'required|string|max:500',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dipublikasikan' => 'required|boolean',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        // Tambahkan user_id dari admin yang sedang login
        $validatedData['user_id'] = Auth::id();

        // Handle upload gambar
        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('berita_images', 'public');
        }

        Berita::create($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat!');
    }

    /**
     * Menampilkan detail satu berita (opsional untuk admin).
     */
    public function show(Berita $berita)
    {
        // Model 'Berita' akan otomatis ditemukan berdasarkan slug
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Memperbarui berita di database.
     */
    public function update(Request $request, Berita $berita)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => ['nullable', 'string', Rule::unique('berita')->ignore($berita->id)],
            'ringkasan' => 'required|string|max:500',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dipublikasikan' => 'required|boolean',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('berita_images', 'public');
        }

        $berita->update($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita dari database.
     */
    public function destroy(Berita $berita)
    {
        // Hapus gambar dari storage sebelum menghapus record
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}