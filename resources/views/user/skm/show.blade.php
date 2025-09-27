<x-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white p-8 rounded-xl shadow-lg border">

            <div class="text-center mb-8 pb-6 border-b">
                <h1 class="text-3xl font-bold text-gray-800">Detail Surat Keterangan Kematian</h1>
                <p class="text-gray-500 mt-2">Nomor Surat: 
                    <span class="font-semibold text-gray-700">{{ $skm->nomor_surat ?? 'Belum Terbit' }}</span>
                </p>
                <div class="mt-4">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium capitalize
                        @switch($skm->status)
                            @case('selesai') bg-green-100 text-green-800 @break
                            @case('ditolak') bg-red-100 text-red-800 @break
                            @default bg-yellow-100 text-yellow-800
                        @endswitch">
                        Status: {{ $skm->status }}
                    </span>
                </div>
            </div>

            <div class="space-y-10">
                {{-- DATA ALMARHUM --}}
                <section>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Data Almarhum / Almarhumah</h2>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Nama Lengkap</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->nama_almarhum }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">NIK</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->nik_almarhum }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Tempat, Tgl Lahir</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->tempat_lahir_almarhum }}, {{ $skm->tanggal_lahir_almarhum->format('d M Y') }}</dd>
                        </div>
                         <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Jenis Kelamin</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->jenis_kelamin_almarhum }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Tanggal Kematian</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->tanggal_kematian->format('d M Y') }}, Pukul {{ $skm->waktu_kematian->format('H:i') }}</dd>
                        </div>
                         <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Penyebab</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->penyebab_kematian }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-2 items-start md:col-span-2">
                            <dt class="font-medium text-gray-500 col-span-1">Alamat Terakhir</dt>
                            <dd class="text-gray-900 col-span-2 md:col-span-2">{{ $skm->alamat_almarhum }}</dd>
                        </div>
                    </dl>
                </section>

                {{-- DATA PELAPOR --}}
                <section>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Data Pelapor</h2>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Nama Lengkap</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->pelaporKematian->nama_pelapor }}</dd>
                        </div>
                         <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">NIK</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->pelaporKematian->nik_pelapor }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Hubungan</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->pelaporKematian->hubungan_dengan_almarhum }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <dt class="font-medium text-gray-500 col-span-1">Pekerjaan</dt>
                            <dd class="text-gray-900 col-span-2">{{ $skm->pelaporKematian->pekerjaan_pelapor }}</dd>
                        </div>
                         <div class="grid grid-cols-3 gap-2 items-start md:col-span-2">
                            <dt class="font-medium text-gray-500 col-span-1">Alamat Pelapor</dt>
                            <dd class="text-gray-900 col-span-2 md:col-span-2">{{ $skm->pelaporKematian->alamat_pelapor }}</dd>
                        </div>
                    </dl>
                </section>
            </div>

            <div class="mt-10 pt-6 border-t flex justify-end">
                <a href="{{ route('surat.tracking') }}" class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</x-layout>