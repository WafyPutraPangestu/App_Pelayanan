<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class beritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $berita = Berita::query()
            // Mengambil relasi 'user' (penulis) untuk menghindari N+1 problem
            ->with('user') 
            // Menggunakan scope 'dipublikasikan' dari model Berita
            ->dipublikasikan() 
            // Menggunakan scope 'terbaru' untuk mengurutkan
            ->terbaru()
            // Logika pencarian: hanya berjalan jika ada input 'search'
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%")
                             ->orWhere('konten', 'like', "%{$search}%");
            })
            // Membagi hasil menjadi beberapa halaman (misal: 9 berita per halaman)
            ->paginate(9)
            // Menambahkan query string (seperti ?search=...) ke link pagination
            ->withQueryString();

        return view('user.UserBerita.index', [
            'berita' => $berita,
            'search' => $search,
        ]);
    }

    /**
     * Menampilkan satu artikel berita berdasarkan slug-nya.
     * Otomatis menambah jumlah 'dilihat'.
     */
    public function show(Berita $berita)
    {
        // Memastikan hanya berita yang sudah dipublikasikan yang bisa diakses
        if (!$berita->dipublikasikan && $berita->tanggal_publikasi > now()) {
            abort(404, 'Berita tidak ditemukan.');
        }

        // Menambah jumlah 'dilihat' setiap kali berita ini dibuka
        // Menggunakan increment() lebih efisien daripada save() biasa
        $berita->increment('dilihat');

        // Mengambil 3 berita terbaru lainnya (selain yang sedang dibuka)
        // untuk ditampilkan sebagai "Baca Juga"
        $beritaTerbaru = Berita::dipublikasikan()
            ->terbaru()
            ->where('id', '!=', $berita->id)
            ->limit(3)
            ->get();

        return view('user.UserBerita.show', [
            'berita' => $berita,
            'beritaTerbaru' => $beritaTerbaru
        ]);
    }
}
