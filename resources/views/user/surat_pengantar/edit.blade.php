<x-layout>
    <h1 class="text-2xl font-bold text-center mb-6">Edit Surat Pengantar</h1>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border">
        <form action="{{ route('surat_pengantar.update', $surat_pengantar->id) }}" method="POST">
            @csrf
            @method('PUT')
             <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- Fields copied from SktmController and adjusted --}}
                <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama', $surat_pengantar->nama) }}" class="w-full form-input">
                <input type="text" name="nik" placeholder="NIK" value="{{ old('nik', $surat_pengantar->nik) }}" class="w-full form-input">
                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $surat_pengantar->tempat_lahir) }}" class="w-full form-input">
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $surat_pengantar->tanggal_lahir->format('Y-m-d')) }}" class="w-full form-input">
                <select name="jenis_kelamin" class="w-full form-select">
                    <option value="Laki-laki" @selected(old('jenis_kelamin', $surat_pengantar->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin', $surat_pengantar->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                </select>
                <input type="text" name="agama" placeholder="Agama" value="{{ old('agama', $surat_pengantar->agama) }}" class="w-full form-input">
                <input type="text" name="pekerjaan" placeholder="Pekerjaan" value="{{ old('pekerjaan', $surat_pengantar->pekerjaan) }}" class="w-full form-input md:col-span-2">
                <div class="md:col-span-2">
                    <textarea name="alamat" placeholder="Alamat Lengkap" rows="3" class="w-full form-input">{{ old('alamat', $surat_pengantar->alamat) }}</textarea>
                </div>
                 <div class="md:col-span-2">
                    <textarea name="maksud_dan_tujuan" placeholder="Maksud dan Tujuan" rows="3" class="w-full form-input">{{ old('maksud_dan_tujuan', $surat_pengantar->maksud_dan_tujuan) }}</textarea>
                </div>
            </div>
             <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="btn-primary">Update Pengajuan</button>
            </div>
        </form>
    </div>
</x-layout>