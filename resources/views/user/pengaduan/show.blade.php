<x-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="border-b pb-6 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-sm font-medium text-blue-600 bg-blue-100 px-3 py-1 rounded-full">{{ $pengaduan->nomor_pengaduan }}</span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-3">{{ $pengaduan->judul }}</h1>
                        <p class="text-gray-500 text-sm mt-2">Dibuat oleh: {{ $pengaduan->user->name }} pada {{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
                        
                        <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2 items-center text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <strong>Jenis Layanan:</strong><span class="ml-2 capitalize">{{ $pengaduan->category }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                <strong>Kategori:</strong><span class="ml-2">{{ $pengaduan->kategori }}</span>
                            </div>
                        </div>
                    </div>
                    <span class="px-4 py-1 text-sm font-semibold rounded-full capitalize {{ $pengaduan->status === 'baru' ? 'bg-orange-100 text-orange-800' : ($pengaduan->status === 'diproses' ? 'bg-yellow-100 text-yellow-800' : ($pengaduan->status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                        {{ $pengaduan->status }}
                    </span>
                </div>
            </div>
            
            <div class="space-y-8">
                <section>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Isi Pengaduan</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($pengaduan->isi_pengaduan)) !!}
                    </div>
                </section>
                
                @if($pengaduan->lampiran)
                <section>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Lampiran</h2>
                    <a href="{{ Storage::url($pengaduan->lampiran) }}" target="_blank" class="text-blue-600 hover:underline">
                        Lihat/Unduh Lampiran
                    </a>
                </section>
                @endif
                
                @if($pengaduan->tanggapan)
                <section class="bg-gray-50 p-6 rounded-xl border">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Tanggapan Admin</h2>
                    <p class="text-gray-500 text-sm mb-4">Ditanggapi pada: {{ $pengaduan->tanggal_ditanggapi->format('d F Y, H:i') }}</p>
                    <div class="prose max-w-none text-gray-700">
                         {!! nl2br(e($pengaduan->tanggapan)) !!}
                    </div>
                </section>
                @else
                 <section class="bg-blue-50 p-6 rounded-xl border border-blue-200 text-center">
                    <p class="text-blue-800">Pengaduan Anda sedang ditinjau. Belum ada tanggapan dari admin.</p>
                </section>
                @endif
            </div>

            <div class="mt-10 pt-6 border-t flex justify-end">
                <a href="{{ route('pengaduan.index') }}" class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-layout>

