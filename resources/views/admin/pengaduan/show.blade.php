<x-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-sm border p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Pengaduan</h1>
                    <p class="text-sm text-gray-600 mt-1">Nomor: <span class="font-semibold">{{ $pengaduan->nomor_pengaduan }}</span></p>
                </div>
                <a href="{{ route('pengaduanAdmin.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Pengaduan</h2>
                </div>
                <div class="p-4 space-y-4 text-gray-700">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="font-semibold">Pelapor</div>
                        <div class="col-span-2">{{ $pengaduan->user->name }}</div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="font-semibold">Tanggal Lapor</div>
                        <div class="col-span-2">{{ $pengaduan->created_at->format('d F Y, H:i') }} WIB</div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="font-semibold">Kategori</div>
                        <div class="col-span-2"><span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">{{ $pengaduan->kategori }}</span></div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="font-semibold">Judul</div>
                        <div class="col-span-2">{{ $pengaduan->judul }}</div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="font-semibold">Isi Pengaduan</div>
                        <div class="col-span-2 prose max-w-none text-gray-800">{{ $pengaduan->isi_pengaduan }}</div>
                    </div>
                    @if($pengaduan->lampiran)
                    <div class="grid grid-cols-3 gap-4">
                        <div class="font-semibold">Lampiran</div>
                        <div class="col-span-2">
                            <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank" class="text-blue-600 hover:underline">
                                Lihat/Unduh Lampiran
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-900">Beri Tanggapan</h2>
                </div>
                <div class="p-4">
                    <form method="POST" action="{{ route('pengaduanAdmin.update', $pengaduan) }}">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="tanggapan" class="block text-sm font-medium text-gray-700 mb-2">Tanggapan Anda</label>
                                <textarea name="tanggapan" id="tanggapan" rows="8" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Kirim Tanggapan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>