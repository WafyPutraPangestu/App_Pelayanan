<x-layout>
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulir Surat Keterangan Usaha (SKU)</h1>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border">
        <form action="{{ route('sku.store') }}" method="POST">
            @csrf
            {{-- DATA PEMILIK USAHA --}}
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Data Pemilik Usaha</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="w-full form-input" placeholder="Sesuai KTP">
                    @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik') }}" class="w-full form-input" placeholder="16 digit NIK">
                    @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full form-input">
                        @error('tempat_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full form-input">
                        @error('tanggal_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full form-select">
                            <option value="" disabled selected>Pilih...</option>
                            <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                        <input type="text" id="agama" name="agama" value="{{ old('agama') }}" class="w-full form-input">
                        @error('agama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                 <div>
                    <label for="kewarganegaraan" class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan</label>
                    <input type="text" id="kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan', 'Indonesia') }}" class="w-full form-input">
                    @error('kewarganegaraan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- DATA USAHA --}}
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6 mt-10">Data Usaha</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nama_usaha" class="block text-sm font-medium text-gray-700 mb-1">Nama Usaha</label>
                    <input type="text" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}" class="w-full form-input" placeholder="Contoh: Toko Kelontong Berkah">
                    @error('nama_usaha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="jenis_usaha" class="block text-sm font-medium text-gray-700 mb-1">Jenis Usaha</label>
                    <input type="text" id="jenis_usaha" name="jenis_usaha" value="{{ old('jenis_usaha') }}" class="w-full form-input" placeholder="Contoh: Perdagangan/Jasa/dll">
                    @error('jenis_usaha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="alamat_usaha" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Usaha</label>
                    <textarea id="alamat_usaha" name="alamat_usaha" rows="3" class="w-full form-input">{{ old('alamat_usaha') }}</textarea>
                    @error('alamat_usaha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="btn-primary">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
</x-layout>