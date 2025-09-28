<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center tracking-tight" x-data="{ show: false }" x-init="$nextTick(() => show = true)" x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                Formulir Surat Keterangan Kematian (SKM)
            </h1>

            <div class="bg-white rounded-2xl shadow-xl p-8" x-data="{ show: false }" x-init="$nextTick(() => show = true)" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                <form action="{{ route('skm.store') }}" method="POST">
                    @csrf
                    <!-- DATA ALMARHUM -->
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b-2 border-indigo-100">Data Almarhum / Almarhumah</h2>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_almarhum" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_almarhum" value="{{ old('nama_almarhum') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                @error('nama_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="nik_almarhum" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                <input type="text" name="nik_almarhum" value="{{ old('nik_almarhum') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                @error('nik_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="tempat_lahir_almarhum" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir_almarhum" value="{{ old('tempat_lahir_almarhum') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('tempat_lahir_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="tanggal_lahir_almarhum" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir_almarhum" value="{{ old('tanggal_lahir_almarhum') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('tanggal_lahir_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="jenis_kelamin_almarhum" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                    <select name="jenis_kelamin_almarhum" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                        <option value="" selected disabled>Pilih...</option>
                                        <option value="Laki-laki" @selected(old('jenis_kelamin_almarhum') == 'Laki-laki')>Laki-laki</option>
                                        <option value="Perempuan" @selected(old('jenis_kelamin_almarhum') == 'Perempuan')>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="agama_almarhum" class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                                    <input type="text" name="agama_almarhum" value="{{ old('agama_almarhum') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('agama_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="tanggal_kematian" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kematian</label>
                                    <input type="date" name="tanggal_kematian" value="{{ old('tanggal_kematian') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('tanggal_kematian') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="waktu_kematian" class="block text-sm font-medium text-gray-700 mb-2">Waktu Kematian</label>
                                    <input type="time" name="waktu_kematian" value="{{ old('waktu_kematian') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('waktu_kematian') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div>
                                <label for="penyebab_kematian" class="block text-sm font-medium text-gray-700 mb-2">Penyebab Kematian</label>
                                <input type="text" name="penyebab_kematian" value="{{ old('penyebab_kematian') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" placeholder="Sakit/Kecelakaan/dll">
                                @error('penyebab_kematian') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="alamat_almarhum" class="block text-sm font-medium text-gray-700 mb-2">Alamat Terakhir Almarhum</label>
                                <textarea name="alamat_almarhum" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">{{ old('alamat_almarhum') }}</textarea>
                                @error('alamat_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- DATA PELAPOR -->
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b-2 border-indigo-100 mt-10">Data Pelapor</h2>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap Pelapor</label>
                                <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                @error('nama_pelapor') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="nik_pelapor" class="block text-sm font-medium text-gray-700 mb-2">NIK Pelapor</label>
                                <input type="text" name="nik_pelapor" value="{{ old('nik_pelapor') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                @error('nik_pelapor') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="tempat_lahir_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir_pelapor" value="{{ old('tempat_lahir_pelapor') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('tempat_lahir_pelapor') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="tanggal_lahir_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir_pelapor" value="{{ old('tanggal_lahir_pelapor') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('tanggal_lahir_pelapor') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="jenis_kelamin_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                    <select name="jenis_kelamin_pelapor" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                        <option value="" selected disabled>Pilih...</option>
                                        <option value="Laki-laki" @selected(old('jenis_kelamin_pelapor') == 'Laki-laki')>Laki-laki</option>
                                        <option value="Perempuan" @selected(old('jenis_kelamin_pelapor') == 'Perempuan')>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin_pelapor') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="pekerjaan_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                    <input type="text" name="pekerjaan_pelapor" value="{{ old('pekerjaan_pelapor') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    @error('pekerjaan_pelapor') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div>
                                <label for="hubungan_dengan_almarhum" class="block text-sm font-medium text-gray-700 mb-2">Hubungan dengan Almarhum</label>
                                <input type="text" name="hubungan_dengan_almarhum" value="{{ old('hubungan_dengan_almarhum') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" placeholder="Anak/Istri/Suami/dll">
                                @error('hubungan_dengan_almarhum') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="alamat_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap Pelapor</label>
                                <textarea name="alamat_pelapor" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">{{ old('alamat_pelapor') }}</textarea>
                                @error('alamat_pelapor') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-medium">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>