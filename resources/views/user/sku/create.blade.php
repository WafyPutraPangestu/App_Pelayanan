<x-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ activeSection: 'pemilik' }">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-3 bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">
                Formulir Surat Keterangan Usaha (SKU)
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Isi formulir berikut dengan data yang benar dan lengkap untuk pengajuan Surat Keterangan Usaha
            </p>
        </div>

        <!-- Progress Steps -->
        <div class="flex justify-center mb-12">
            <div class="flex items-center space-x-4">
                <button @click="activeSection = 'pemilik'" 
                        :class="activeSection === 'pemilik' ? 'bg-blue-600 text-white' : 'bg-white text-gray-400 border border-gray-300'"
                        class="w-10 h-10 rounded-full flex items-center justify-center font-semibold transition-all duration-300 shadow-md">
                    1
                </button>
                <div class="w-16 h-1 bg-gray-300 rounded-full"></div>
                <button @click="activeSection = 'usaha'" 
                        :class="activeSection === 'usaha' ? 'bg-blue-600 text-white' : 'bg-white text-gray-400 border border-gray-300'"
                        class="w-10 h-10 rounded-full flex items-center justify-center font-semibold transition-all duration-300 shadow-md">
                    2
                </button>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <form action="{{ route('sku.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Section 1: Data Pemilik Usaha -->
                <div x-show="activeSection === 'pemilik'" x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-x-4"
                     x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <!-- Section Header -->
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">1</span>
                                </div>
                                <h2 class="text-xl font-bold text-white">Data Pemilik Usaha</h2>
                            </div>
                        </div>
                        
                        <!-- Form Fields -->
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Lengkap -->
                                <div class="space-y-2">
                                    <label for="nama" class="block text-sm font-semibold text-gray-700 flex items-center">
                                        <span class="text-red-500 mr-1">*</span>Nama Lengkap
                                    </label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400"
                                           placeholder="Sesuai KTP">
                                    @error('nama') 
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- NIK -->
                                <div class="space-y-2">
                                    <label for="nik" class="block text-sm font-semibold text-gray-700 flex items-center">
                                        <span class="text-red-500 mr-1">*</span>NIK
                                    </label>
                                    <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400"
                                           placeholder="16 digit NIK">
                                    @error('nik') 
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Tempat & Tanggal Lahir -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        @error('tempat_lahir') 
                                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        @error('tanggal_lahir') 
                                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jenis Kelamin & Agama -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" 
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white">
                                            <option value="" disabled selected class="text-gray-400">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                                            <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin') 
                                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="agama" class="block text-sm font-semibold text-gray-700">Agama</label>
                                        <input type="text" id="agama" name="agama" value="{{ old('agama') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        @error('agama') 
                                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kewarganegaraan -->
                                <div class="space-y-2">
                                    <label for="kewarganegaraan" class="block text-sm font-semibold text-gray-700">Kewarganegaraan</label>
                                    <input type="text" id="kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan', 'Indonesia') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('kewarganegaraan') 
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                            <button type="button" @click="activeSection = 'usaha'" 
                                    class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 font-semibold shadow-md">
                                Lanjut ke Data Usaha →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Data Usaha -->
                <div x-show="activeSection === 'usaha'" x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-4"
                     x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <!-- Section Header -->
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">2</span>
                                </div>
                                <h2 class="text-xl font-bold text-white">Data Usaha</h2>
                            </div>
                        </div>
                        
                        <!-- Form Fields -->
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Usaha -->
                                <div class="space-y-2">
                                    <label for="nama_usaha" class="block text-sm font-semibold text-gray-700 flex items-center">
                                        <span class="text-red-500 mr-1">*</span>Nama Usaha
                                    </label>
                                    <input type="text" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 placeholder-gray-400"
                                           placeholder="Contoh: Toko Kelontong Berkah">
                                    @error('nama_usaha') 
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Jenis Usaha -->
                                <div class="space-y-2">
                                    <label for="jenis_usaha" class="block text-sm font-semibold text-gray-700 flex items-center">
                                        <span class="text-red-500 mr-1">*</span>Jenis Usaha
                                    </label>
                                    <input type="text" id="jenis_usaha" name="jenis_usaha" value="{{ old('jenis_usaha') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 placeholder-gray-400"
                                           placeholder="Contoh: Perdagangan/Jasa/dll">
                                    @error('jenis_usaha') 
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Alamat Usaha -->
                                <div class="md:col-span-2 space-y-2">
                                    <label for="alamat_usaha" class="block text-sm font-semibold text-gray-700 flex items-center">
                                        <span class="text-red-500 mr-1">*</span>Alamat Lengkap Usaha
                                    </label>
                                    <textarea id="alamat_usaha" name="alamat_usaha" rows="4"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none">{{ old('alamat_usaha') }}</textarea>
                                    @error('alamat_usaha') 
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between">
                            <button type="button" @click="activeSection = 'pemilik'" 
                                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 font-semibold">
                                ← Kembali ke Data Pemilik
                            </button>
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 font-semibold shadow-md transform hover:scale-105">
                                Kirim Pengajuan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>