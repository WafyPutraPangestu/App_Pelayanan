<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Formulir Surat Keterangan Kelahiran</h1>
                <p class="text-gray-600">Isi data dengan lengkap dan benar</p>
            </div>

            {{-- Form Container --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <form action="{{ route('keterangan_lahir.store') }}" method="POST" x-data="{ activeSection: 'anak' }">
                    @csrf

                    {{-- Progress Steps --}}
                    <div class="border-b border-gray-200">
                        <div class="flex justify-center space-x-8 px-8">
                            <button type="button" @click="activeSection = 'anak'" 
                                    :class="activeSection === 'anak' ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-gray-300'"
                                    class="py-4 border-b-2 font-medium text-sm transition-colors duration-200">
                                Data Anak
                            </button>
                            <button type="button" @click="activeSection = 'orangtua'" 
                                    :class="activeSection === 'orangtua' ? 'text-blue-600 border-blue-600' : 'text-gray-500 border-gray-300'"
                                    class="py-4 border-b-2 font-medium text-sm transition-colors duration-200">
                                Data Orang Tua
                            </button>
                        </div>
                    </div>

                    <div class="p-8">
                        {{-- Data Anak Section --}}
                        <div x-show="activeSection === 'anak'" x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 transform translate-x-4" 
                             x-transition:enter-end="opacity-100 transform translate-x-0">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama Lengkap --}}
                                <div class="md:col-span-2">
                                    <label for="nama_lengkap" class="block text-sm font-semibold text-gray-800 mb-2">Nama Lengkap Anak</label>
                                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           placeholder="Masukkan nama lengkap anak">
                                    @error('nama_lengkap') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- Tempat & Tanggal Lahir --}}
                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-semibold text-gray-800 mb-2">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           placeholder="Kota kelahiran">
                                    @error('tempat_lahir') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-800 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    @error('tanggal_lahir') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- Waktu Lahir & Jenis Kelamin --}}
                                <div>
                                    <label for="waktu_lahir" class="block text-sm font-semibold text-gray-800 mb-2">Waktu Lahir</label>
                                    <input type="time" name="waktu_lahir" value="{{ old('waktu_lahir') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    @error('waktu_lahir') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-800 mb-2">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none bg-white">
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                                        <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- Agama --}}
                                <div class="md:col-span-2">
                                    <label for="agama" class="block text-sm font-semibold text-gray-800 mb-2">Agama</label>
                                    <input type="text" name="agama" value="{{ old('agama') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           placeholder="Masukkan agama">
                                    @error('agama') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                                <button type="button" @click="activeSection = 'orangtua'" 
                                        class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center">
                                    Selanjutnya
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Data Orang Tua Section --}}
                        <div x-show="activeSection === 'orangtua'" x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 transform translate-x-4" 
                             x-transition:enter-end="opacity-100 transform translate-x-0">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama Ayah --}}
                                <div>
                                    <label for="nama_ayah" class="block text-sm font-semibold text-gray-800 mb-2">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           placeholder="Nama lengkap ayah">
                                    @error('nama_ayah') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- Nama Ibu --}}
                                <div>
                                    <label for="nama_ibu" class="block text-sm font-semibold text-gray-800 mb-2">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           placeholder="Nama lengkap ibu">
                                    @error('nama_ibu') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- Alamat --}}
                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-sm font-semibold text-gray-800 mb-2">Alamat Lengkap Orang Tua</label>
                                    <textarea name="alamat" rows="4" 
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                              placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat') 
                                        <span class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                                <button type="button" @click="activeSection = 'anak'" 
                                        class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Kembali
                                </button>
                                <button type="submit" 
                                        class="px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 flex items-center shadow-lg shadow-green-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Kirim Pengajuan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>