<x-layout>
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Formulir Surat Keterangan Kematian (SKM)</h1>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border">
        <form action="{{ route('skm.update', $skm->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Method untuk update --}}
            
            {{-- DATA ALMARHUM --}}
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Data Almarhum / Almarhumah</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nama_almarhum" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_almarhum" value="{{ old('nama_almarhum', $skm->nama_almarhum) }}" class="w-full form-input">
                    @error('nama_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="nik_almarhum" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                    <input type="text" name="nik_almarhum" value="{{ old('nik_almarhum', $skm->nik_almarhum) }}" class="w-full form-input">
                    @error('nik_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tempat_lahir_almarhum" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_almarhum" value="{{ old('tempat_lahir_almarhum', $skm->tempat_lahir_almarhum) }}" class="w-full form-input">
                        @error('tempat_lahir_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="tanggal_lahir_almarhum" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir_almarhum" value="{{ old('tanggal_lahir_almarhum', $skm->tanggal_lahir_almarhum->format('Y-m-d')) }}" class="w-full form-input">
                         @error('tanggal_lahir_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                 <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="jenis_kelamin_almarhum" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin_almarhum" class="w-full form-select">
                            <option value="" disabled>Pilih...</option>
                            <option value="Laki-laki" @selected(old('jenis_kelamin_almarhum', $skm->jenis_kelamin_almarhum) == 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('jenis_kelamin_almarhum', $skm->jenis_kelamin_almarhum) == 'Perempuan')>Perempuan</option>
                        </select>
                        @error('jenis_kelamin_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="agama_almarhum" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                        <input type="text" name="agama_almarhum" value="{{ old('agama_almarhum', $skm->agama_almarhum) }}" class="w-full form-input">
                        @error('agama_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                 <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tanggal_kematian" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kematian</label>
                        <input type="date" name="tanggal_kematian" value="{{ old('tanggal_kematian', $skm->tanggal_kematian->format('Y-m-d')) }}" class="w-full form-input">
                        @error('tanggal_kematian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="waktu_kematian" class="block text-sm font-medium text-gray-700 mb-1">Waktu Kematian</label>
                        <input type="time" name="waktu_kematian" value="{{ old('waktu_kematian', $skm->waktu_kematian->format('H:i')) }}" class="w-full form-input">
                        @error('waktu_kematian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="penyebab_kematian" class="block text-sm font-medium text-gray-700 mb-1">Penyebab Kematian</label>
                    <input type="text" name="penyebab_kematian" value="{{ old('penyebab_kematian', $skm->penyebab_kematian) }}" class="w-full form-input" placeholder="Sakit/Kecelakaan/dll">
                    @error('penyebab_kematian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                 <div class="md:col-span-2">
                     <label for="alamat_almarhum" class="block text-sm font-medium text-gray-700 mb-1">Alamat Terakhir Almarhum</label>
                    <textarea name="alamat_almarhum" rows="3" class="w-full form-input">{{ old('alamat_almarhum', $skm->alamat_almarhum) }}</textarea>
                    @error('alamat_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- DATA PELAPOR --}}
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6 mt-10">Data Pelapor</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nama_pelapor" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Pelapor</label>
                    <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor', $skm->pelaporKematian->nama_pelapor) }}" class="w-full form-input">
                    @error('nama_pelapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="nik_pelapor" class="block text-sm font-medium text-gray-700 mb-1">NIK Pelapor</label>
                    <input type="text" name="nik_pelapor" value="{{ old('nik_pelapor', $skm->pelaporKematian->nik_pelapor) }}" class="w-full form-input">
                    @error('nik_pelapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                     <div>
                        <label for="tempat_lahir_pelapor" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_pelapor" value="{{ old('tempat_lahir_pelapor', $skm->pelaporKematian->tempat_lahir_pelapor) }}" class="w-full form-input">
                         @error('tempat_lahir_pelapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="tanggal_lahir_pelapor" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir_pelapor" value="{{ old('tanggal_lahir_pelapor', $skm->pelaporKematian->tanggal_lahir_pelapor->format('Y-m-d')) }}" class="w-full form-input">
                        @error('tanggal_lahir_pelapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                 <div class="grid grid-cols-2 gap-4">
                     <div>
                        <label for="jenis_kelamin_pelapor" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin_pelapor" class="w-full form-select">
                           <option value="" disabled>Pilih...</option>
                           <option value="Laki-laki" @selected(old('jenis_kelamin_pelapor', $skm->pelaporKematian->jenis_kelamin_pelapor) == 'Laki-laki')>Laki-laki</option>
                           <option value="Perempuan" @selected(old('jenis_kelamin_pelapor', $skm->pelaporKematian->jenis_kelamin_pelapor) == 'Perempuan')>Perempuan</option>
                        </select>
                         @error('jenis_kelamin_pelapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                     <div>
                        <label for="pekerjaan_pelapor" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <input type="text" name="pekerjaan_pelapor" value="{{ old('pekerjaan_pelapor', $skm->pelaporKematian->pekerjaan_pelapor) }}" class="w-full form-input">
                        @error('pekerjaan_pelapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                 </div>
                 <div>
                    <label for="hubungan_dengan_almarhum" class="block text-sm font-medium text-gray-700 mb-1">Hubungan dengan Almarhum</label>
                    <input type="text" name="hubungan_dengan_almarhum" value="{{ old('hubungan_dengan_almarhum', $skm->pelaporKematian->hubungan_dengan_almarhum) }}" class="w-full form-input" placeholder="Anak/Istri/Suami/dll">
                     @error('hubungan_dengan_almarhum') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                 <div class="md:col-span-2">
                     <label for="alamat_pelapor" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Pelapor</label>
                    <textarea name="alamat_pelapor" rows="3" class="w-full form-input">{{ old('alamat_pelapor', $skm->pelaporKematian->alamat_pelapor) }}</textarea>
                    @error('alamat_pelapor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="btn-primary">Update Pengajuan</button>
            </div>
        </form>
    </div>
</x-layout>