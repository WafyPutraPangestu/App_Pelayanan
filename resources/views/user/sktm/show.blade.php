<x-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white p-8 rounded-xl shadow-lg border">
            <div class="text-center mb-8 pb-6 border-b">
                <h1 class="text-3xl font-bold text-gray-800">Detail Surat Keterangan Tidak Mampu</h1>
                <p class="text-gray-500 mt-2">Nomor Surat: <span class="font-semibold text-gray-700">{{ $sktm->nomor_surat ?? 'Belum Terbit' }}</span></p>
            </div>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                <div class="grid grid-cols-3 gap-2">
                    <dt class="font-medium text-gray-500 col-span-1">Nama Lengkap</dt>
                    <dd class="text-gray-900 col-span-2">{{ $sktm->nama }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <dt class="font-medium text-gray-500 col-span-1">NIK</dt>
                    <dd class="text-gray-900 col-span-2">{{ $sktm->nik }}</dd>
                </div>
                 <div class="grid grid-cols-3 gap-2">
                    <dt class="font-medium text-gray-500 col-span-1">Tempat, Tgl Lahir</dt>
                    <dd class="text-gray-900 col-span-2">{{ $sktm->tempat_lahir }}, {{ $sktm->tanggal_lahir->format('d M Y') }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <dt class="font-medium text-gray-500 col-span-1">Jenis Kelamin</dt>
                    <dd class="text-gray-900 col-span-2">{{ $sktm->jenis_kelamin }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <dt class="font-medium text-gray-500 col-span-1">Pekerjaan</dt>
                    <dd class="text-gray-900 col-span-2">{{ $sktm->pekerjaan }}</dd>
                </div>
                 <div class="grid grid-cols-3 gap-2">
                    <dt class="font-medium text-gray-500 col-span-1">Status</dt>
                    <dd class="text-gray-900 col-span-2 capitalize">{{ $sktm->status }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 md:col-span-2">
                    <dt class="font-medium text-gray-500 col-span-1">Alamat</dt>
                    <dd class="text-gray-900 col-span-2">{{ $sktm->alamat }}</dd>
                </div>
            </dl>

            <div class="mt-10 pt-6 border-t flex justify-end">
                <a href="{{ route('surat.tracking') }}" class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">Kembali</a>
            </div>
        </div>
    </div>
</x-layout>