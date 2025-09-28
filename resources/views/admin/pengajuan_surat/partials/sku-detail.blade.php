<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div>
            <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
            <p class="text-gray-900 font-medium">{{ $surat->nama }}</p>
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
            <label class="text-sm font-medium text-gray-500">Agama</label>
            <p class="text-gray-900">{{ $surat->agama }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Kewarganegaraan</label>
            <p class="text-gray-900">{{ $surat->kewarganegaraan }}</p>
        </div>
    </div>
    <div class="space-y-4">
        <div>
            <label class="text-sm font-medium text-gray-500">NIK</label>
            <p class="text-gray-900 font-mono">{{ $surat->nik }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Nama Usaha</label>
            <p class="text-gray-900 font-semibold">{{ $surat->nama_usaha }}</p>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-500">Jenis Usaha</label>
            <p class="text-gray-900">{{ $surat->jenis_usaha }}</p>
        </div