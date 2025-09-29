<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManajemenUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian dari request
        $search = $request->get('search');

        // Query builder untuk user
        $query = User::where('role', 'user');

        // Jika ada pencarian, filter berdasarkan nama atau email
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Hitung total user (untuk ditampilkan di header)
        $totalUsers = User::where('role', 'user')->count();

        // Ambil data user dengan paginasi
        $users = $query->latest()->simplePaginate(10);

        return view('admin.user.index', compact('users', 'totalUsers'));
    }
}