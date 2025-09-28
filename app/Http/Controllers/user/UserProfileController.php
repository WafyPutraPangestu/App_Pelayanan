<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BiodataPengguna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Display the user's profile page with editable form.
     */
    public function index()
    {
        $user = Auth::user();
        $biodata = $user->biodata ?? new BiodataPengguna();

        return view('user.profile.index', compact('user', 'biodata'));
    }

    /**
     * Update the user's profile and biodata in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate user and biodata fields
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'nomor_telepon' => ['nullable', 'string', 'max:15'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'agama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16', Rule::unique('biodata_pengguna')->ignore($user->biodata?->id)],
            'kewarganegaraan' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        // Update user data
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
        ];

        if ($validated['password']) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        // Update or create biodata
        $biodataData = [
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'agama' => $validated['agama'],
            'nik' => $validated['nik'],
            'kewarganegaraan' => $validated['kewarganegaraan'],
            'pekerjaan' => $validated['pekerjaan'],
            'alamat' => $validated['alamat'],
            'nomor_telepon' => $validated['nomor_telepon'],
        ];

        if ($user->biodata) {
            $user->biodata->update($biodataData);
        } else {
            $biodataData['user_id'] = $user->id;
            BiodataPengguna::create($biodataData);
        }

        return redirect()->route('UserProfile.index')->with('success', 'Profile updated successfully.');
    }
}