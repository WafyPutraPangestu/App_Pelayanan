<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Surat Saya</h1>
            <p class="text-gray-600 mt-1">Daftar surat yang telah selesai diproses dan siap untuk diunduh.</p>
        </div>

        <div class="space-y-6">
            @forelse ($suratMasuk as $surat)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $surat->jenis_surat }}
                                </span>
                                <h2 class="text-xl font-semibold text-gray-800 mt-3">{{ $surat->nomor_surat_resmi }}</h2>
                                <p class="text-sm text-gray-500">Diterbitkan oleh: {{ $surat->admin->name ?? 'Admin' }} pada {{ $surat->tanggal_terbit->format('d F Y') }}</p>

                                @if($surat->catatan_admin)
                                    <div class="mt-4 p-3 bg-gray-50 rounded-lg text-sm text-gray-700 border border-gray-200">
                                        <strong>Catatan dari Admin:</strong> {{ $surat->catatan_admin }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-shrink-0 flex flex-col items-start md:items-end w-full md:w-auto">
                                <a href="{{ route('UserSuratMasuk.download', $surat) }}" 
                                   class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
                                    Download Surat
                                </a>
                                <div class="mt-3 text-xs text-gray-500 text-left md:text-right">
                                    <p>Telah diunduh: {{ $surat->jumlah_download }} kali</p>
                                    @if($surat->tanggal_didownload)
                                        <p>Terakhir diunduh: {{ $surat->tanggal_didownload->diffForHumans() }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 text-center p-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Surat</h3>
                    <p class="mt-1 text-sm text-gray-500">Saat ini belum ada surat final yang tersedia untuk Anda.</p>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $suratMasuk->links() }}
            </div>
        </div>
    </div>
</x-layout>