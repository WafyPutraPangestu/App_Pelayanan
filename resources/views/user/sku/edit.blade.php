<x-layout>
    <h1 class="text-2xl font-bold text-center mb-6">Edit Surat Keterangan Usaha</h1>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border">
        <form action="{{ route('sku.update', $sku->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Data Pemohon</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- Data Pemohon --}}
                <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama', $sku->nama) }}" class="w-full form-input">
                <input type="text" name="nik" placeholder="NIK" value="{{ old('nik', $sku->nik) }}" class="w-full form-input">
                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $sku->tempat_lahir) }}" class="w-full form-input">
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $sku->tanggal_lahir->format('Y-m-d')) }}" class="w-full form-input">
                <select name="jenis_kelamin" class="w-full form-select">
                    <option value="Laki-laki" @selected(old('jenis_kelamin', $sku->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin', $sku->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                </select>
                <input type="text" name="agama" placeholder="Agama" value="{{ old('agama', $sku->agama) }}" class="w-full form-input">
                <input type="text" name="kewarganegaraan" placeholder="Kewarganegaraan" value="{{ old('kewarganegaraan', $sku->kewarganegaraan) }}" class="w-full form-input md:col-span-2">
            </div>

            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6 mt-10">Data Usaha</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                 {{-- Data Usaha --}}
                <input type="text" name="nama_usaha" placeholder="Nama Usaha" value="{{ old('nama_usaha', $sku->nama_usaha) }}" class="w-full form-input">
                <input type="text" name="jenis_usaha" placeholder="Jenis Usaha" value="{{ old('jenis_usaha', $sku->jenis_usaha) }}" class="w-full form-input">
                <div class="md:col-span-2">
                    <textarea name="alamat_usaha" placeholder="Alamat Usaha" rows="3" class="w-full form-input">{{ old('alamat_usaha', $sku->alamat_usaha) }}</textarea>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="btn-primary">Update Pengajuan</button>
            </div>
        </form>
    </div>
</x-layout>