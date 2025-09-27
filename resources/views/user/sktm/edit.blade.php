<x-layout>
    <h1 class="text-2xl font-bold text-center mb-6">Edit Surat Keterangan Tidak Mampu</h1>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border">
        <form action="{{ route('sktm.update', $sktm->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <label for="nama" class="block text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $sktm->nama) }}" class="w-full form-input">
                    @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="nik" class="block text-sm font-medium">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $sktm->nik) }}" class="w-full form-input">
                    @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $sktm->tempat_lahir) }}" class="w-full form-input">
                    @error('tempat_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $sktm->tanggal_lahir->format('Y-m-d')) }}" class="w-full form-input">
                    @error('tanggal_lahir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                 <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full form-select">
                        <option value="Laki-laki" @selected(old('jenis_kelamin', $sktm->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('jenis_kelamin', $sktm->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="agama" class="block text-sm font-medium">Agama</label>
                    <input type="text" name="agama" value="{{ old('agama', $sktm->agama) }}" class="w-full form-input">
                    @error('agama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="pekerjaan" class="block text-sm font-medium">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $sktm->pekerjaan) }}" class="w-full form-input">
                    @error('pekerjaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full form-input">{{ old('alamat', $sktm->alamat) }}</textarea>
                    @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="btn-primary">Update Pengajuan</button>
            </div>
        </form>
    </div>
</x-layout>