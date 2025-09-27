<x-layout>
    <h1>HALAMAN INPUT SURAT DOMISILI</h1>
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        <form action="{{ route('domisili.store') }}" method="POST" x-data="{}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
    
                {{-- Kolom Kiri --}}
                <div class="space-y-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="Sesuai KTP">
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="16 digit angka NIK" maxlength="16">
                        @error('nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                                   placeholder="Kota Kelahiran">
                             @error('tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition">
                             @error('tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                           <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="" disabled selected>Pilih salah satu</option>
                                <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                                <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                             <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <input type="text" id="agama" name="agama" value="{{ old('agama') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                                   placeholder="Contoh: Islam">
                            @error('agama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
    
                {{-- Kolom Kanan --}}
                <div class="space-y-6">
                    <div>
                        <label for="alamat_sekarang" class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili Saat Ini</label>
                        <textarea id="alamat_sekarang" name="alamat_sekarang" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                                  placeholder="Masukkan alamat lengkap domisili Anda saat ini">{{ old('alamat_sekarang') }}</textarea>
                        @error('alamat_sekarang') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div>
                        <label for="alamat_sebelumnya" class="block text-sm font-medium text-gray-700 mb-1">Alamat Sesuai KTP</label>
                        <textarea id="alamat_sebelumnya" name="alamat_sebelumnya" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                                  placeholder="Masukkan alamat sesuai yang tertera di KTP">{{ old('alamat_sebelumnya') }}</textarea>
                        @error('alamat_sebelumnya') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
    
                    <div>
                        <label for="maksud_dan_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Maksud dan Tujuan</label>
                        <textarea id="maksud_dan_tujuan" name="maksud_dan_tujuan" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                                  placeholder="Contoh: Sebagai syarat untuk melamar pekerjaan">{{ old('maksud_dan_tujuan') }}</textarea>
                        @error('maksud_dan_tujuan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
    
            {{-- Tombol Aksi --}}
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                <button type="submit"
                        class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</x-layout>