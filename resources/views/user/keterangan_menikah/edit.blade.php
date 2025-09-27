<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Edit Surat Keterangan Menikah</h1>
                <p class="text-gray-600">Perbarui data calon pengantin untuk surat keterangan menikah</p>
            </div>
            
            <form action="{{ route('keterangan_menikah.update', $menikah->id) }}" method="POST" x-data="formData()" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Informasi Status Perkawinan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan Pria</label>
                            <select name="status_perkawinan_pria" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Pilih Status</option>
                                <option value="Belum Menikah" @selected(old('status_perkawinan_pria', $menikah->status_perkawinan_pria) == 'Belum Menikah')>Belum Menikah</option>
                                <option value="Cerai Hidup" @selected(old('status_perkawinan_pria', $menikah->status_perkawinan_pria) == 'Cerai Hidup')>Cerai Hidup</option>
                                <option value="Cerai Mati" @selected(old('status_perkawinan_pria', $menikah->status_perkawinan_pria) == 'Cerai Mati')>Cerai Mati</option>
                            </select>
                            @error('status_perkawinan_pria') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan Wanita</label>
                            <select name="status_perkawinan_wanita" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Pilih Status</option>
                                <option value="Belum Menikah" @selected(old('status_perkawinan_wanita', $menikah->status_perkawinan_wanita) == 'Belum Menikah')>Belum Menikah</option>
                                <option value="Cerai Hidup" @selected(old('status_perkawinan_wanita', $menikah->status_perkawinan_wanita) == 'Cerai Hidup')>Cerai Hidup</option>
                                <option value="Cerai Mati" @selected(old('status_perkawinan_wanita', $menikah->status_perkawinan_wanita) == 'Cerai Mati')>Cerai Mati</option>
                            </select>
                            @error('status_perkawinan_wanita') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Data Calon Pengantin Pria
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pria_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="pria_nama" name="pria[nama]" value="{{ old('pria.nama', $menikah->calonPria->nama) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('pria.nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="pria_nik" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                            <input type="text" id="pria_nik" name="pria[nik]" value="{{ old('pria.nik', $menikah->calonPria->nik) }}" maxlength="16" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('pria.nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="pria_tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                            <input type="text" id="pria_tempat_lahir" name="pria[tempat_lahir]" value="{{ old('pria.tempat_lahir', $menikah->calonPria->tempat_lahir) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('pria.tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="pria_tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" id="pria_tanggal_lahir" name="pria[tanggal_lahir]" value="{{ old('pria.tanggal_lahir', $menikah->calonPria->tanggal_lahir->format('Y-m-d')) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('pria.tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="pria_agama" class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                            <select id="pria_agama" name="pria[agama]" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Pilih Agama</option>
                                <option value="Islam" @selected(old('pria.agama', $menikah->calonPria->agama) == 'Islam')>Islam</option>
                                <option value="Kristen" @selected(old('pria.agama', $menikah->calonPria->agama) == 'Kristen')>Kristen</option>
                                <option value="Katolik" @selected(old('pria.agama', $menikah->calonPria->agama) == 'Katolik')>Katolik</option>
                                <option value="Hindu" @selected(old('pria.agama', $menikah->calonPria->agama) == 'Hindu')>Hindu</option>
                                <option value="Buddha" @selected(old('pria.agama', $menikah->calonPria->agama) == 'Buddha')>Buddha</option>
                                <option value="Konghucu" @selected(old('pria.agama', $menikah->calonPria->agama) == 'Konghucu')>Konghucu</option>
                            </select>
                            @error('pria.agama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="pria_pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                            <input type="text" id="pria_pekerjaan" name="pria[pekerjaan]" value="{{ old('pria.pekerjaan', $menikah->calonPria->pekerjaan) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('pria.pekerjaan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="pria_kewarganegaraan" class="block text-sm font-medium text-gray-700 mb-2">Kewarganegaraan</label>
                            <input type="text" id="pria_kewarganegaraan" name="pria[kewarganegaraan]" value="{{ old('pria.kewarganegaraan', $menikah->calonPria->kewarganegaraan) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('pria.kewarganegaraan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="pria_alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea id="pria_alamat" name="pria[alamat]" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none">{{ old('pria.alamat', $menikah->calonPria->alamat) }}</textarea>
                            @error('pria.alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mt-8 mb-4">Data Orang Tua</h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="border-l-4 border-blue-500 pl-6">
                            <h4 class="text-md font-medium text-gray-700 mb-4">Data Ayah</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Ayah</label>
                                    <input type="text" name="pria[ayah_nama]" value="{{ old('pria.ayah_nama', $menikah->calonPria->ayah->nama) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @error('pria.ayah_nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">NIK Ayah</label>
                                    <input type="text" name="pria[ayah_nik]" value="{{ old('pria.ayah_nik', $menikah->calonPria->ayah->nik) }}" maxlength="16" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @error('pria.ayah_nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tempat Lahir</label>
                                        <input type="text" name="pria[ayah_tempat_lahir]" value="{{ old('pria.ayah_tempat_lahir', $menikah->calonPria->ayah->tempat_lahir) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @error('pria.ayah_tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="pria[ayah_tanggal_lahir]" value="{{ old('pria.ayah_tanggal_lahir', $menikah->calonPria->ayah->tanggal_lahir->format('Y-m-d')) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @error('pria.ayah_tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Agama</label>
                                        <select name="pria[ayah_agama]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" @selected(old('pria.ayah_agama', $menikah->calonPria->ayah->agama) == 'Islam')>Islam</option>
                                            <option value="Kristen" @selected(old('pria.ayah_agama', $menikah->calonPria->ayah->agama) == 'Kristen')>Kristen</option>
                                            <option value="Katolik" @selected(old('pria.ayah_agama', $menikah->calonPria->ayah->agama) == 'Katolik')>Katolik</option>
                                            <option value="Hindu" @selected(old('pria.ayah_agama', $menikah->calonPria->ayah->agama) == 'Hindu')>Hindu</option>
                                            <option value="Buddha" @selected(old('pria.ayah_agama', $menikah->calonPria->ayah->agama) == 'Buddha')>Buddha</option>
                                            <option value="Konghucu" @selected(old('pria.ayah_agama', $menikah->calonPria->ayah->agama) == 'Konghucu')>Konghucu</option>
                                        </select>
                                        @error('pria.ayah_agama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Pekerjaan</label>
                                        <input type="text" name="pria[ayah_pekerjaan]" value="{{ old('pria.ayah_pekerjaan', $menikah->calonPria->ayah->pekerjaan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @error('pria.ayah_pekerjaan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Kewarganegaraan</label>
                                    <input type="text" name="pria[ayah_kewarganegaraan]" value="{{ old('pria.ayah_kewarganegaraan', $menikah->calonPria->ayah->kewarganegaraan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @error('pria.ayah_kewarganegaraan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                                    <textarea name="pria[ayah_alamat]" rows="2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ old('pria.ayah_alamat', $menikah->calonPria->ayah->alamat) }}</textarea>
                                    @error('pria.ayah_alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="border-l-4 border-pink-500 pl-6">
                            <h4 class="text-md font-medium text-gray-700 mb-4">Data Ibu</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Ibu</label>
                                    <input type="text" name="pria[ibu_nama]" value="{{ old('pria.ibu_nama', $menikah->calonPria->ibu->nama) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                    @error('pria.ibu_nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">NIK Ibu</label>
                                    <input type="text" name="pria[ibu_nik]" value="{{ old('pria.ibu_nik', $menikah->calonPria->ibu->nik) }}" maxlength="16" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                    @error('pria.ibu_nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tempat Lahir</label>
                                        <input type="text" name="pria[ibu_tempat_lahir]" value="{{ old('pria.ibu_tempat_lahir', $menikah->calonPria->ibu->tempat_lahir) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                        @error('pria.ibu_tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="pria[ibu_tanggal_lahir]" value="{{ old('pria.ibu_tanggal_lahir', $menikah->calonPria->ibu->tanggal_lahir->format('Y-m-d')) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                        @error('pria.ibu_tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Agama</label>
                                        <select name="pria[ibu_agama]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" @selected(old('pria.ibu_agama', $menikah->calonPria->ibu->agama) == 'Islam')>Islam</option>
                                            <option value="Kristen" @selected(old('pria.ibu_agama', $menikah->calonPria->ibu->agama) == 'Kristen')>Kristen</option>
                                            <option value="Katolik" @selected(old('pria.ibu_agama', $menikah->calonPria->ibu->agama) == 'Katolik')>Katolik</option>
                                            <option value="Hindu" @selected(old('pria.ibu_agama', $menikah->calonPria->ibu->agama) == 'Hindu')>Hindu</option>
                                            <option value="Buddha" @selected(old('pria.ibu_agama', $menikah->calonPria->ibu->agama) == 'Buddha')>Buddha</option>
                                            <option value="Konghucu" @selected(old('pria.ibu_agama', $menikah->calonPria->ibu->agama) == 'Konghucu')>Konghucu</option>
                                        </select>
                                        @error('pria.ibu_agama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Pekerjaan</label>
                                        <input type="text" name="pria[ibu_pekerjaan]" value="{{ old('pria.ibu_pekerjaan', $menikah->calonPria->ibu->pekerjaan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                        @error('pria.ibu_pekerjaan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Kewarganegaraan</label>
                                    <input type="text" name="pria[ibu_kewarganegaraan]" value="{{ old('pria.ibu_kewarganegaraan', $menikah->calonPria->ibu->kewarganegaraan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                    @error('pria.ibu_kewarganegaraan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                                    <textarea name="pria[ibu_alamat]" rows="2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors resize-none">{{ old('pria.ibu_alamat', $menikah->calonPria->ibu->alamat) }}</textarea>
                                    @error('pria.ibu_alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-8 h-8 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Data Calon Pengantin Wanita
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="wanita[nama]" value="{{ old('wanita.nama', $menikah->calonWanita->nama) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('wanita.nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                            <input type="text" name="wanita[nik]" value="{{ old('wanita.nik', $menikah->calonWanita->nik) }}" maxlength="16" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('wanita.nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                            <input type="text" name="wanita[tempat_lahir]" value="{{ old('wanita.tempat_lahir', $menikah->calonWanita->tempat_lahir) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('wanita.tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="wanita[tanggal_lahir]" value="{{ old('wanita.tanggal_lahir', $menikah->calonWanita->tanggal_lahir->format('Y-m-d')) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('wanita.tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                            <select name="wanita[agama]" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">Pilih Agama</option>
                                <option value="Islam" @selected(old('wanita.agama', $menikah->calonWanita->agama) == 'Islam')>Islam</option>
                                <option value="Kristen" @selected(old('wanita.agama', $menikah->calonWanita->agama) == 'Kristen')>Kristen</option>
                                <option value="Katolik" @selected(old('wanita.agama', $menikah->calonWanita->agama) == 'Katolik')>Katolik</option>
                                <option value="Hindu" @selected(old('wanita.agama', $menikah->calonWanita->agama) == 'Hindu')>Hindu</option>
                                <option value="Buddha" @selected(old('wanita.agama', $menikah->calonWanita->agama) == 'Buddha')>Buddha</option>
                                <option value="Konghucu" @selected(old('wanita.agama', $menikah->calonWanita->agama) == 'Konghucu')>Konghucu</option>
                            </select>
                            @error('wanita.agama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                            <input type="text" name="wanita[pekerjaan]" value="{{ old('wanita.pekerjaan', $menikah->calonWanita->pekerjaan) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('wanita.pekerjaan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kewarganegaraan</label>
                            <input type="text" name="wanita[kewarganegaraan]" value="{{ old('wanita.kewarganegaraan', $menikah->calonWanita->kewarganegaraan) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            @error('wanita.kewarganegaraan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="wanita[alamat]" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none">{{ old('wanita.alamat', $menikah->calonWanita->alamat) }}</textarea>
                            @error('wanita.alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mt-8 mb-4">Data Orang Tua</h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="border-l-4 border-blue-500 pl-6">
                            <h4 class="text-md font-medium text-gray-700 mb-4">Data Ayah</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Ayah</label>
                                    <input type="text" name="wanita[ayah_nama]" value="{{ old('wanita.ayah_nama', $menikah->calonWanita->ayah->nama) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @error('wanita.ayah_nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">NIK Ayah</label>
                                    <input type="text" name="wanita[ayah_nik]" value="{{ old('wanita.ayah_nik', $menikah->calonWanita->ayah->nik) }}" maxlength="16" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @error('wanita.ayah_nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tempat Lahir</label>
                                        <input type="text" name="wanita[ayah_tempat_lahir]" value="{{ old('wanita.ayah_tempat_lahir', $menikah->calonWanita->ayah->tempat_lahir) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @error('wanita.ayah_tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="wanita[ayah_tanggal_lahir]" value="{{ old('wanita.ayah_tanggal_lahir', $menikah->calonWanita->ayah->tanggal_lahir->format('Y-m-d')) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @error('wanita.ayah_tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Agama</label>
                                        <select name="wanita[ayah_agama]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" @selected(old('wanita.ayah_agama', $menikah->calonWanita->ayah->agama) == 'Islam')>Islam</option>
                                            <option value="Kristen" @selected(old('wanita.ayah_agama', $menikah->calonWanita->ayah->agama) == 'Kristen')>Kristen</option>
                                            <option value="Katolik" @selected(old('wanita.ayah_agama', $menikah->calonWanita->ayah->agama) == 'Katolik')>Katolik</option>
                                            <option value="Hindu" @selected(old('wanita.ayah_agama', $menikah->calonWanita->ayah->agama) == 'Hindu')>Hindu</option>
                                            <option value="Buddha" @selected(old('wanita.ayah_agama', $menikah->calonWanita->ayah->agama) == 'Buddha')>Buddha</option>
                                            <option value="Konghucu" @selected(old('wanita.ayah_agama', $menikah->calonWanita->ayah->agama) == 'Konghucu')>Konghucu</option>
                                        </select>
                                        @error('wanita.ayah_agama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Pekerjaan</label>
                                        <input type="text" name="wanita[ayah_pekerjaan]" value="{{ old('wanita.ayah_pekerjaan', $menikah->calonWanita->ayah->pekerjaan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        @error('wanita.ayah_pekerjaan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Kewarganegaraan</label>
                                    <input type="text" name="wanita[ayah_kewarganegaraan]" value="{{ old('wanita.ayah_kewarganegaraan', $menikah->calonWanita->ayah->kewarganegaraan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @error('wanita.ayah_kewarganegaraan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                                    <textarea name="wanita[ayah_alamat]" rows="2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ old('wanita.ayah_alamat', $menikah->calonWanita->ayah->alamat) }}</textarea>
                                    @error('wanita.ayah_alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="border-l-4 border-pink-500 pl-6">
                            <h4 class="text-md font-medium text-gray-700 mb-4">Data Ibu</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Ibu</label>
                                    <input type="text" name="wanita[ibu_nama]" value="{{ old('wanita.ibu_nama', $menikah->calonWanita->ibu->nama) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                    @error('wanita.ibu_nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">NIK Ibu</label>
                                    <input type="text" name="wanita[ibu_nik]" value="{{ old('wanita.ibu_nik', $menikah->calonWanita->ibu->nik) }}" maxlength="16" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                    @error('wanita.ibu_nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tempat Lahir</label>
                                        <input type="text" name="wanita[ibu_tempat_lahir]" value="{{ old('wanita.ibu_tempat_lahir', $menikah->calonWanita->ibu->tempat_lahir) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                        @error('wanita.ibu_tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="wanita[ibu_tanggal_lahir]" value="{{ old('wanita.ibu_tanggal_lahir', $menikah->calonWanita->ibu->tanggal_lahir->format('Y-m-d')) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                        @error('wanita.ibu_tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Agama</label>
                                        <select name="wanita[ibu_agama]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" @selected(old('wanita.ibu_agama', $menikah->calonWanita->ibu->agama) == 'Islam')>Islam</option>
                                            <option value="Kristen" @selected(old('wanita.ibu_agama', $menikah->calonWanita->ibu->agama) == 'Kristen')>Kristen</option>
                                            <option value="Katolik" @selected(old('wanita.ibu_agama', $menikah->calonWanita->ibu->agama) == 'Katolik')>Katolik</option>
                                            <option value="Hindu" @selected(old('wanita.ibu_agama', $menikah->calonWanita->ibu->agama) == 'Hindu')>Hindu</option>
                                            <option value="Buddha" @selected(old('wanita.ibu_agama', $menikah->calonWanita->ibu->agama) == 'Buddha')>Buddha</option>
                                            <option value="Konghucu" @selected(old('wanita.ibu_agama', $menikah->calonWanita->ibu->agama) == 'Konghucu')>Konghucu</option>
                                        </select>
                                        @error('wanita.ibu_agama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Pekerjaan</label>
                                        <input type="text" name="wanita[ibu_pekerjaan]" value="{{ old('wanita.ibu_pekerjaan', $menikah->calonWanita->ibu->pekerjaan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                        @error('wanita.ibu_pekerjaan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Kewarganegaraan</label>
                                    <input type="text" name="wanita[ibu_kewarganegaraan]" value="{{ old('wanita.ibu_kewarganegaraan', $menikah->calonWanita->ibu->kewarganegaraan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors">
                                    @error('wanita.ibu_kewarganegaraan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                                    <textarea name="wanita[ibu_alamat]" rows="2" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors resize-none">{{ old('wanita.ibu_alamat', $menikah->calonWanita->ibu->alamat) }}</textarea>
                                    @error('wanita.ibu_alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('surat.tracking') }}" class="px-8 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" x-bind:disabled="isSubmitting"
                                class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed shadow-lg">
                            <svg x-show="!isSubmitting" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="isSubmitting ? 'Memperbarui...' : 'Update Pengajuan'"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formData() {
            return {
                isSubmitting: false,
                init() {
                    this.$el.addEventListener('submit', () => {
                        this.isSubmitting = true;
                    });
                }
            }
        }
    </script>
</x-layout>