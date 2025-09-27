<x-layout>
    <h1 class="text-2xl font-bold text-center mb-6">Edit Surat Keterangan Kelahiran</h1>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border">
        <form action="{{ route('keterangan_lahir.update', $keterangan_lahir->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium">Nama Lengkap Anak</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $keterangan_lahir->nama_lengkap) }}" class="w-full form-input">
                    @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full form-select">
                        <option value="Laki-laki" @selected(old('jenis_kelamin', $keterangan_lahir->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('jenis_kelamin', $keterangan_lahir->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $keterangan_lahir->tempat_lahir) }}" class="w-full form-input">
                    @error('tempat_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $keterangan_lahir->tanggal_lahir->format('Y-m-d')) }}" class="w-full form-input">
                        @error('tanggal_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="waktu_lahir" class="block text-sm font-medium">Waktu Lahir</label>
                        <input type="time" name="waktu_lahir" value="{{ old('waktu_lahir', $keterangan_lahir->waktu_lahir->format('H:i')) }}" class="w-full form-input">
                        @error('waktu_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="agama" class="block text-sm font-medium">Agama</label>
                    <input type="text" name="agama" value="{{ old('agama', $keterangan_lahir->agama) }}" class="w-full form-input">
                    @error('agama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="nama_ayah" class="block text-sm font-medium">Nama Ayah</label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $keterangan_lahir->nama_ayah) }}" class="w-full form-input">
                        @error('nama_ayah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="nama_ibu" class="block text-sm font-medium">Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $keterangan_lahir->nama_ibu) }}" class="w-full form-input">
                        @error('nama_ibu') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium">Alamat Keluarga</label>
                    <textarea name="alamat" rows="3" class="w-full form-input">{{ old('alamat', $keterangan_lahir->alamat) }}</textarea>
                    @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="btn-primary">Update Pengajuan</button>
            </div>
        </form>
    </div>
</x-layout>