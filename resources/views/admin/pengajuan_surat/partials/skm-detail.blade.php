<div class="space-y-6">
    <!-- Data Almarhum -->
    <div>
        <h3 class="font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Data Almarhum</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Nama Almarhum</label>
                    <p class="text-gray-900 font-medium">{{ $surat->nama_almarhum }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                    <p class="text-gray-900">{{ $surat->jenis_kelamin_almarhum }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                    <p class="text-gray-900">{{ $surat->tempat_lahir_almarhum }}, {{ $surat->tanggal_lahir_almarhum->format('d F Y') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Agama</label>
                    <p class="text-gray-900">{{ $surat->agama_almarhum }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">NIK</label>
                    <p class="text-gray-900 font-mono">{{ $surat->nik_almarhum }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Alamat</label>
                    <p class="text-gray-900">{{ $surat->alamat_almarhum }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Penyebab Kematian</label>
                    <p class="text-gray-900">{{ $surat->penyebab_kematian }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal & Waktu Kematian</label>
                    <p class="text-gray-900">{{ $surat->tanggal_kematian->format('d F Y') }}, {{ $surat->waktu_kematian->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Pelapor -->
    @if($surat->pelaporKematian)
    <div>
        <h3 class="font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Data Pelapor</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Nama Pelapor</label>
                    <p class="text-gray-900 font-medium">{{ $surat->pelaporKematian->nama_pelapor }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                    <p class="text-gray-900">{{ $surat->pelaporKematian->jenis_kelamin_pelapor }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                    <p class="text-gray-900">{{ $surat->pelaporKematian->tempat_lahir_pelapor }}, {{ $surat->pelaporKematian->tanggal_lahir_pelapor->format('d F Y') }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">NIK Pelapor</label>
                    <p class="text-gray-900 font-mono">{{ $surat->pelaporKematian->nik_pelapor }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Pekerjaan</label>
                    <p class="text-gray-900">{{ $surat->pelaporKematian->pekerjaan_pelapor }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Alamat Pelapor</label>
                    <p class="text-gray-900">{{ $surat->pelaporKematian->alamat_pelapor }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Hubungan dengan Almarhum</label>
                    <p class="text-gray-900">{{ $surat->pelaporKematian->hubungan_dengan_almarhum }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>