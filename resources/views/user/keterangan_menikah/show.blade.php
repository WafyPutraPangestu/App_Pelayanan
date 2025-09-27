<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Detail Surat Keterangan Menikah</h1>
                <p class="text-gray-600">Nomor Surat: 
                    <span class="font-semibold text-gray-700">{{ $menikah->nomor_surat ?? 'Belum Terbit' }}</span>
                </p>
                <div class="mt-4">
                     <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium capitalize
                        @switch($menikah->status)
                            @case('selesai') bg-green-100 text-green-800 @break
                            @case('ditolak') bg-red-100 text-red-800 @break
                            @default bg-yellow-100 text-yellow-800
                        @endswitch">
                        Status: {{ $menikah->status }}
                    </span>
                </div>
            </div>
            
            <div class="space-y-8">
                {{-- KARTU STATUS PERKAWINAN --}}
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Informasi Status Perkawinan
                    </h2>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div class="grid grid-cols-2 gap-2">
                            <dt class="font-medium text-gray-500">Status Pria</dt>
                            <dd class="text-gray-900 font-semibold">{{ $menikah->status_perkawinan_pria }}</dd>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <dt class="font-medium text-gray-500">Status Wanita</dt>
                            <dd class="text-gray-900 font-semibold">{{ $menikah->status_perkawinan_wanita }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- KARTU DATA PRIA --}}
                    <div class="bg-white rounded-xl shadow-lg p-8 space-y-6">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Calon Pengantin Pria
                        </h2>
                        
                        {{-- Detail Calon Pria --}}
                        <dl class="space-y-3 text-sm">
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Nama Lengkap</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->nama }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">NIK</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->nik }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Kelahiran</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->tempat_lahir }}, {{ $menikah->calonPria->tanggal_lahir->format('d F Y') }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Agama</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->agama }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Pekerjaan</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->pekerjaan }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Kewarganegaraan</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->kewarganegaraan }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Alamat</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->alamat }}</dd></div>
                        </dl>

                        {{-- Detail Orang Tua Pria --}}
                        <div class="pt-4 border-t">
                            <h3 class="text-md font-semibold text-gray-700 mb-3">Data Ayah</h3>
                            <dl class="space-y-3 text-sm">
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Nama</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->ayah->nama }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">NIK</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->ayah->nik }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Alamat</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->ayah->alamat }}</dd></div>
                            </dl>
                        </div>
                         <div class="pt-4 border-t">
                            <h3 class="text-md font-semibold text-gray-700 mb-3">Data Ibu</h3>
                            <dl class="space-y-3 text-sm">
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Nama</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->ibu->nama }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">NIK</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->ibu->nik }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Alamat</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonPria->ibu->alamat }}</dd></div>
                            </dl>
                        </div>
                    </div>

                    {{-- KARTU DATA WANITA --}}
                    <div class="bg-white rounded-xl shadow-lg p-8 space-y-6">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <svg class="w-8 h-8 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Calon Pengantin Wanita
                        </h2>
                        
                        {{-- Detail Calon Wanita --}}
                         <dl class="space-y-3 text-sm">
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Nama Lengkap</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->nama }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">NIK</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->nik }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Kelahiran</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->tempat_lahir }}, {{ $menikah->calonWanita->tanggal_lahir->format('d F Y') }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Agama</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->agama }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Pekerjaan</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->pekerjaan }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Kewarganegaraan</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->kewarganegaraan }}</dd></div>
                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Alamat</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->alamat }}</dd></div>
                        </dl>
                        
                        {{-- Detail Orang Tua Wanita --}}
                         <div class="pt-4 border-t">
                            <h3 class="text-md font-semibold text-gray-700 mb-3">Data Ayah</h3>
                            <dl class="space-y-3 text-sm">
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Nama</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->ayah->nama }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">NIK</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->ayah->nik }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Alamat</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->ayah->alamat }}</dd></div>
                            </dl>
                        </div>
                         <div class="pt-4 border-t">
                            <h3 class="text-md font-semibold text-gray-700 mb-3">Data Ibu</h3>
                            <dl class="space-y-3 text-sm">
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Nama</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->ibu->nama }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">NIK</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->ibu->nik }}</dd></div>
                                <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500">Alamat</dt><dd class="text-gray-900 col-span-2">{{ $menikah->calonWanita->ibu->alamat }}</dd></div>
                            </dl>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('surat.tracking') }}" class="px-8 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Daftar
                        </a>
                        @if($menikah->status == 'selesai')
                        <a href="#" class="px-8 py-3 bg-gradient-to-r from-green-500 to-teal-500 text-white font-semibold rounded-lg hover:from-green-600 hover:to-teal-600 transition-all duration-200 flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download Surat
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>