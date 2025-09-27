<x-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white p-8 rounded-xl shadow-lg border">
            <div class="text-center mb-8 pb-6 border-b">
                <h1 class="text-3xl font-bold text-gray-800">Detail Surat Keterangan Usaha</h1>
                <p class="text-gray-500 mt-2">Nomor Surat: <span class="font-semibold text-gray-700">{{ $sku->nomor_surat ?? 'Belum Terbit' }}</span></p>
            </div>

            <section class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Data Pemohon</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                    {{-- Data Pemohon --}}
                    <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500 col-span-1">Nama</dt><dd class="text-gray-900 col-span-2">{{ $sku->nama }}</dd></div>
                    <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500 col-span-1">NIK</dt><dd class="text-gray-900 col-span-2">{{ $sku->nik }}</dd></div>
                    <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500 col-span-1">Kelahiran</dt><dd class="text-gray-900 col-span-2">{{ $sku->tempat_lahir }}, {{ $sku->tanggal_lahir->format('d M Y') }}</dd></div>
                    <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500 col-span-1">Jenis Kelamin</dt><dd class="text-gray-900 col-span-2">{{ $sku->jenis_kelamin }}</dd></div>
                </dl>
            </section>
            
            <section>
                <h2 class="text-xl font-semibold text-gray-700 border-b pb-3 mb-6">Data Usaha</h2>
                 <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                    {{-- Data Usaha --}}
                    <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500 col-span-1">Nama Usaha</dt><dd class="text-gray-900 col-span-2">{{ $sku->nama_usaha }}</dd></div>
                    <div class="grid grid-cols-3 gap-2"><dt class="font-medium text-gray-500 col-span-1">Jenis Usaha</dt><dd class="text-gray-900 col-span-2">{{ $sku->jenis_usaha }}</dd></div>
                    <div class="grid grid-cols-3 gap-2 md:col-span-2"><dt class="font-medium text-gray-500 col-span-1">Alamat Usaha</dt><dd class="text-gray-900 col-span-2">{{ $sku->alamat_usaha }}</dd></div>
                </dl>
            </section>

            <div class="mt-10 pt-6 border-t flex justify-end">
                <a href="{{ route('surat.tracking') }}" class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">Kembali</a>
            </div>
        </div>
    </div>
</x-layout>