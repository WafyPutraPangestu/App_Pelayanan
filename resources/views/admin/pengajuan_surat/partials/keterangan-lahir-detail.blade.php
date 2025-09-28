<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div>
            <label class="text-sm font-medium text-gray-500">Nama Lengkap Bayi</label>
            <p class="text-gray-900 font-medium">{{ $surat->nama_lengkap }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
            <p class="text-gray-900">{{ $surat->jenis_kelamin }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
            <p class="text-gray-900">{{ $surat->tempat_lahir }}, {{ $surat->tanggal_lahir->format('d F Y') }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Waktu Lahir</label>
            <p class="text-gray-900">{{ $surat->waktu_lahir ? $surat->waktu_lahir->format('H:i') . ' WIB' : 'Tidak dicatat' }}</p>
        </div>
    </div>
    <div class="space-y-4">
        <div>
            <label class="text-sm font-medium text-gray-500">Agama</label>
            <p class="text-gray-900">{{ $surat->agama }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Nama Ayah</label>
            <p class="text-gray-900 font-medium">{{ $surat->nama_ayah }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Nama Ibu</label>
            <p class="text-gray-900 font-medium">{{ $surat->nama_ibu }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Alamat</label>
            <p class="text-gray-900">{{ $surat->alamat }}</p>
        </div>
    </div>
</div>