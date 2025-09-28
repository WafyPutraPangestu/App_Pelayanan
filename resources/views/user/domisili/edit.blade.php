<x-layout>
    <!-- Header Section with Gradient -->
    <div class="relative bg-gradient-to-br from-emerald-900 via-teal-900 to-cyan-800 py-16 px-4">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Edit Surat Domisili</h1>
            <p class="text-xl text-emerald-100 max-w-2xl mx-auto">Perbarui data pengajuan surat domisili Anda</p>
        </div>
    </div>

    <!-- Main Form Container -->
    <div class="relative -mt-8 pb-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                
                <!-- Document Info Header -->
                <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-cyan-50 p-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $suratDomisili->nomor_surat }}</h3>
                                <p class="text-gray-600">Nomor Surat Domisili</p>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <div class="inline-flex items-center px-4 py-2 bg-white rounded-full shadow-sm border border-gray-200">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3 animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700">{{ ucwords($suratDomisili->status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form action="{{ route('domisili.update', $suratDomisili->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            
                            <!-- Left Column - Personal Info -->
                            <div class="space-y-6">
                                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-6 rounded-2xl">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                                        <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        Informasi Pribadi
                                    </h3>
                                    
                                    <div class="space-y-6">
                                        <!-- Nama Lengkap -->
                                        <div class="group">
                                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                            <div class="relative">
                                                <input type="text" id="nama" name="nama" value="{{ old('nama', $suratDomisili->nama) }}"
                                                       class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all duration-200 group-hover:border-gray-300"
                                                       placeholder="Masukkan nama lengkap sesuai KTP">
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('nama') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- NIK -->
                                        <div class="group">
                                            <label for="nik" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Induk Kependudukan (NIK)</label>
                                            <div class="relative">
                                                <input type="text" id="nik" name="nik" value="{{ old('nik', $suratDomisili->nik) }}"
                                                       class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all duration-200 group-hover:border-gray-300"
                                                       placeholder="16 digit angka NIK" maxlength="16">
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('nik') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Tempat & Tanggal Lahir -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="group">
                                                <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir</label>
                                                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $suratDomisili->tempat_lahir) }}"
                                                       class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all duration-200 group-hover:border-gray-300"
                                                       placeholder="Kota kelahiran">
                                                @error('tempat_lahir') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="group">
                                                <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $suratDomisili->tanggal_lahir->format('Y-m-d')) }}"
                                                       class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all duration-200 group-hover:border-gray-300">
                                                @error('tanggal_lahir') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <!-- Jenis Kelamin & Agama -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="group">
                                                <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                                                <select id="jenis_kelamin" name="jenis_kelamin" 
                                                        class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all duration-200 group-hover:border-gray-300">
                                                    <option value="" disabled>Pilih jenis kelamin</option>
                                                    <option value="Laki-laki" @selected(old('jenis_kelamin', $suratDomisili->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                                                    <option value="Perempuan" @selected(old('jenis_kelamin', $suratDomisili->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="group">
                                                <label for="agama" class="block text-sm font-semibold text-gray-700 mb-2">Agama</label>
                                                <input type="text" id="agama" name="agama" value="{{ old('agama', $suratDomisili->agama) }}"
                                                       class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all duration-200 group-hover:border-gray-300"
                                                       placeholder="Contoh: Islam">
                                                @error('agama') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Address Info -->
                            <div class="space-y-6">
                                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 p-6 rounded-2xl">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                                        <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        Informasi Alamat
                                    </h3>
                                    
                                    <div class="space-y-6">
                                        <!-- Alamat Domisili -->
                                        <div class="group">
                                            <label for="alamat_sekarang" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Domisili Saat Ini</label>
                                            <textarea id="alamat_sekarang" name="alamat_sekarang" rows="4"
                                                      class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-200 group-hover:border-gray-300 resize-none"
                                                      placeholder="Masukkan alamat lengkap domisili Anda saat ini">{{ old('alamat_sekarang', $suratDomisili->alamat_sekarang) }}</textarea>
                                            @error('alamat_sekarang') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Alamat KTP -->
                                        <div class="group">
                                            <label for="alamat_sebelumnya" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Sesuai KTP</label>
                                            <textarea id="alamat_sebelumnya" name="alamat_sebelumnya" rows="4"
                                                      class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-200 group-hover:border-gray-300 resize-none"
                                                      placeholder="Masukkan alamat sesuai yang tertera di KTP">{{ old('alamat_sebelumnya', $suratDomisili->alamat_sebelumnya) }}</textarea>
                                            @error('alamat_sebelumnya') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Maksud dan Tujuan -->
                                        <div class="group">
                                            <label for="maksud_dan_tujuan" class="block text-sm font-semibold text-gray-700 mb-2">Maksud dan Tujuan</label>
                                            <textarea id="maksud_dan_tujuan" name="maksud_dan_tujuan" rows="4"
                                                      class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-teal-100 focus:border-teal-400 transition-all duration-200 group-hover:border-gray-300 resize-none"
                                                      placeholder="Contoh: Sebagai syarat untuk melamar pekerjaan">{{ old('maksud_dan_tujuan', $suratDomisili->maksud_dan_tujuan) }}</textarea>
                                            @error('maksud_dan_tujuan') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-10 pt-8 border-t border-gray-100">
                            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                                <button type="button" 
                                        onclick="history.back()"
                                        class="px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-xl shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 transition-all duration-200">
                                    Batal
                                </button>
                                <button type="submit"
                                        class="px-12 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl shadow-lg hover:from-emerald-700 hover:to-teal-700 focus:outline-none focus:ring-4 focus:ring-emerald-200 transform hover:scale-105 transition-all duration-200">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                        Update Pengajuan
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>