<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'nomor_telepon' => '081234567890', // pakai "nomor_telepon" sesuai migration
            'password' => Hash::make('test1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'aktif' => true,
        ]);
        
        User::create([
            'name' => 'User Satu',
            'email' => 'user@gmail.com',
            'nomor_telepon' => '081298765432', // pakai "nomor_telepon"
            'password' => Hash::make('test1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'user',
            'aktif' => true,
        ]);
        
    }
}
