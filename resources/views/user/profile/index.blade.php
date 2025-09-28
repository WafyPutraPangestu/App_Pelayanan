<!-- resources/views/user/profile/index.blade.php -->
<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4" x-data="profile()">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Profile Saya</h1>
                <p class="text-gray-600 mt-2">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
            </div>

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-white">
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                            <p class="text-blue-100">{{ $user->email }}</p>
                            <p class="text-blue-100 text-sm mt-1">{{ $user->nomor_telepon ?? 'Belum diatur' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <form action="{{ route('UserProfile.update', $user) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-green-700">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <ul class="text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informasi Akun -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informasi Akun</h3>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <input type="password" id="password" name="password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Konfirmasi password baru">
                        </div>

                        <!-- Informasi Pribadi -->
                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informasi Pribadi</h3>
                        </div>

                        <div>
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $biodata->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $biodata->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $biodata->tanggal_lahir ? \Carbon\Carbon::parse($biodata->tanggal_lahir)->format('Y-m-d') : '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                            <input type="text" id="agama" name="agama" value="{{ old('agama', $biodata->agama) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ old('nik', $biodata->nik) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   maxlength="16">
                        </div>

                        <div>
                            <label for="kewarganegaraan" class="block text-sm font-medium text-gray-700 mb-2">Kewarganegaraan</label>
                            <input type="text" id="kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan', $biodata->kewarganegaraan) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div>
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                            <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $biodata->pekerjaan) }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>

                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">{{ old('alamat', $biodata->alamat) }}</textarea>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('UserDashboard.index') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 font-medium">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition duration-200 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Warning -->
        <div x-show="showWarning" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90"
             class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
             style="display: none;">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Peringatan Penting!</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Harap lengkapi seluruh biodata Anda terlebih dahulu sebelum dapat menggunakan layanan lain. 
                            Biodata yang lengkap diperlukan untuk keamanan dan verifikasi akun Anda.
                        </p>
                        <p class="text-sm text-gray-600 mt-2 font-medium">
                            Field yang wajib diisi: NIK, Tempat Lahir, Tanggal Lahir, dan Alamat.
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button @click="showWarning = false"
                                class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Saya Mengerti
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Alpine.js untuk interaksi tambahan
        document.addEventListener('alpine:init', () => {
            Alpine.data('profile', () => ({
                showWarning: false,
                init() {
                    // Cek apakah ada session warning dari middleware
                    @if(session('warning'))
                        setTimeout(() => {
                            this.showWarning = true;
                        }, 500);
                    @else
                        // Hanya cek kelengkapan biodata jika TIDAK ada session warning
                        // Tunggu sampai DOM selesai load
                        setTimeout(() => {
                            const nik = document.getElementById('nik')?.value?.trim() || '';
                            const tempatLahir = document.getElementById('tempat_lahir')?.value?.trim() || '';
                            const tanggalLahir = document.getElementById('tanggal_lahir')?.value?.trim() || '';
                            const alamat = document.getElementById('alamat')?.value?.trim() || '';

                            // Tampilkan warning hanya jika ada field yang kosong
                            if (!nik || !tempatLahir || !tanggalLahir || !alamat) {
                                this.showWarning = true;
                            }
                        }, 100);
                    @endif
                }
            }))
        });
    </script>
</x-layout>