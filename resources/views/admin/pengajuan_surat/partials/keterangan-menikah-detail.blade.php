<div class="space-y-6">
    <!-- Status Perkawinan -->
    <div>
        <h3 class="font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Status Perkawinan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="text-sm font-medium text-gray-500">Status Perkawinan Pria</label>
                <p class="text-gray-900">{{ $surat->status_perkawinan_pria }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Status Perkawinan Wanita</label>
                <p class="text-gray-900">{{ $surat->status_perkawinan_wanita }}</p>
            </div>
        </div>
    </div>

    @foreach($surat->calonPengantin as $calon)
    <!-- Data Calon -->
    <div>
        <h3 class="font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
            Data Calon {{ $calon->jenis_kelamin === 'Laki-laki' ? 'Mempelai Pria' : 'Mempelai Wanita' }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                    <p class="text-gray-900 font-medium">{{ $calon->nama }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                    <p class="text-gray-900">{{ $calon->tempat_lahir }}, {{ $calon->tanggal_lahir->format('d F Y') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Agama</label>
                    <p class="text-gray-900">{{ $calon->agama }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">NIK</label>
                    <p class="text-gray-900 font-mono">{{ $calon->nik }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Pekerjaan</label>
                    <p class="text-gray-900">{{ $calon->pekerjaan }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Kewarganegaraan</label>
                    <p class="text-gray-900">{{ $calon->kewarganegaraan }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Alamat</label>
                    <p class="text-gray-900">{{ $calon->alamat }}</p>
                </div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        @if($calon->orangTua->count() > 0)
        <div class="mt-6">
            <h4 class="font-medium text-gray-900 mb-3">Data Orang Tua</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($calon->orangTua as $orangTua)
                <div class="bg-gray-50 p-4 rounded-xl">
                    <h5 class="font-medium text-gray-900 mb-3">{{ ucfirst($orangTua->jenis_orang_tua) }}</h5>
                    <div class="space-y-2 text-sm">
                        <div>
                            <span class="text-gray-500">Nama:</span>
                            <span class="text-gray-900 font-medium">{{ $orangTua->nama }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">TTL:</span>
                            <span class="text-gray-900">{{ $orangTua->tempat_lahir }}, {{ $orangTua->tanggal_lahir->format('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Pekerjaan:</span>
                            <span class="text-gray-900">{{ $orangTua->pekerjaan }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">NIK:</span>
                            <span class="text-gray-900 font-mono">{{ $orangTua->nik }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    @endforeach
</div>