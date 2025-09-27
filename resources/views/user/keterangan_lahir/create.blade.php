<x-layout>
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulir Surat Keterangan Kelahiran</h1>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border">
        <form action="{{ route('keterangan_lahir.store') }}" method="POST">
            @csrf
             {{-- DATA ANAK --}}
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Data Anak</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                 <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Anak</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full form-input">
                    @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                 <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full form-input">
                        @error('tempat_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full form-input">
                        @error('tanggal_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                 <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="waktu_lahir" class="block text-sm font-medium text-gray-700 mb-1">Waktu Lahir</label>
                        <input type="time" name="waktu_lahir" value="{{ old('waktu_lahir') }}" class="w-full form-input">
                         @error('waktu_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                     <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full form-select">
                            <option value="" selected disabled>Pilih...</option>
                            <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                 <div>
                    <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                    <input type="text" name="agama" value="{{ old('agama') }}" class="w-full form-input">
                    @error('agama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- DATA ORANG TUA --}}
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6 mt-10">Data Orang Tua</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" class="w-full form-input">
                    @error('nama_ayah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" class="w-full form-input">
                    @error('nama_ibu') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                     <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Orang Tua</label>
                    <textarea name="alamat" rows="3" class="w-full form-input">{{ old('alamat') }}</textarea>
                    @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="btn-primary">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
</x-layout>