<x-layout>
    <div x-data="trackingData()" class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tracking Surat</h1>
                        <p class="mt-2 text-gray-600">Lacak status semua surat yang telah diajukan dengan mudah dan cepat</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Status Summary Cards -->
                        <div class="bg-yellow-100 rounded-lg px-4 py-2">
                            <div class="text-yellow-800 text-sm font-medium">Diproses</div>
                            <div class="text-yellow-900 text-2xl font-bold">{{ $semuaSurat->where('status', 'diproses')->count() }}</div>
                        </div>
                        <div class="bg-green-100 rounded-lg px-4 py-2">
                            <div class="text-green-800 text-sm font-medium">Selesai</div>
                            <div class="text-green-900 text-2xl font-bold">{{ $semuaSurat->where('status', 'selesai')->count() }}</div>
                        </div>
                        <div class="bg-red-100 rounded-lg px-4 py-2">
                            <div class="text-red-800 text-sm font-medium">Ditolak</div>
                            <div class="text-red-900 text-2xl font-bold">{{ $semuaSurat->where('status', 'ditolak')->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Surat</label>
                        <input 
                            type="text" 
                            x-model="searchQuery"
                            placeholder="Cari berdasarkan nama atau nomor surat..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                        <select 
                            x-model="statusFilter"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                            <option value="">Semua Status</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Dalam Proses">Dalam Proses</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter Jenis</label>
                        <select 
                            x-model="jenisFilter"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                            <option value="">Semua Jenis</option>
                            <option value="Surat Keterangan Menikah">Surat Keterangan Menikah</option>
                            <option value="Surat Keterangan Kematian">Surat Keterangan Kematian</option>
                            <option value="Surat Keterangan Lahir">Surat Keterangan Lahir</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Surat</h3>
                </div>

                @if($semuaSurat->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Surat</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemohon / Subjek</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Surat</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($semuaSurat as $surat)
                                    <tr 
                                        class="hover:bg-gray-50 transition-colors duration-200"
                                        x-show="filterSurat('{{ $surat->jenis_surat }}', '{{ $surat->status }}', '{{ $surat->nomor_surat ?? '' }}')"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                        @if($surat->jenis_surat == 'Surat Keterangan Menikah')
                                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                            </svg>
                                                        @elseif($surat->jenis_surat == 'Surat Keterangan Kematian')
                                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        @elseif($surat->jenis_surat == 'Surat Keterangan Lahir')
                                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $surat->jenis_surat }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 font-medium">
                                                @if ($surat->jenis_surat == 'Surat Keterangan Menikah')
                                                    <div class="flex items-center space-x-2">
                                                        <span>{{ $surat->calonPria->nama ?? 'N/A' }}</span>
                                                        <span class="text-gray-400">&</span>
                                                        <span>{{ $surat->calonWanita->nama ?? 'N/A' }}</span>
                                                    </div>
                                                @elseif ($surat->jenis_surat == 'Surat Keterangan Kematian')
                                                    {{ $surat->nama_almarhum }}
                                                @elseif ($surat->jenis_surat == 'Surat Keterangan Lahir')
                                                    {{ $surat->nama_lengkap }}
                                                @else
                                                    {{ $surat->nama }}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($surat->nomor_surat)
                                                <div class="text-sm font-mono text-gray-900 bg-gray-100 px-3 py-1 rounded-full inline-block">
                                                    {{ $surat->nomor_surat }}
                                                </div>
                                            @else
                                                <span class="text-sm text-gray-500 italic">Belum Terbit</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex flex-col">
                                                <span class="font-medium">{{ $surat->created_at->format('d M Y') }}</span>
                                                <span class="text-xs text-gray-500">{{ $surat->created_at->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                @if($surat->status == 'Disetujui') 
                                                    bg-green-100 text-green-800 ring-1 ring-green-600/20
                                                @elseif($surat->status == 'Ditolak') 
                                                    bg-red-100 text-red-800 ring-1 ring-red-600/20
                                                @else 
                                                    bg-yellow-100 text-yellow-800 ring-1 ring-yellow-600/20
                                                @endif">
                                                <div class="w-1.5 h-1.5 mr-2 rounded-full
                                                    @if($surat->status == 'Disetujui') bg-green-600
                                                    @elseif($surat->status == 'Ditolak') bg-red-600
                                                    @else bg-yellow-600 @endif">
                                                </div>
                                                {{ $surat->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Lihat Detail">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                                @if($surat->status == 'Disetujui' && $surat->nomor_surat)
                                                    <button class="text-green-600 hover:text-green-800 transition-colors duration-200" title="Download">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada data surat</h3>
                        <p class="mt-2 text-sm text-gray-500">Belum ada surat yang diajukan saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function trackingData() {
            return {
                searchQuery: '',
                statusFilter: '',
                jenisFilter: '',
                
                filterSurat(jenis, status, nomor) {
                    // Filter berdasarkan pencarian
                    if (this.searchQuery) {
                        const query = this.searchQuery.toLowerCase();
                        const searchMatch = jenis.toLowerCase().includes(query) || 
                                          (nomor && nomor.toLowerCase().includes(query));
                        if (!searchMatch) return false;
                    }
                    
                    // Filter berdasarkan status
                    if (this.statusFilter && status !== this.statusFilter) {
                        return false;
                    }
                    
                    // Filter berdasarkan jenis
                    if (this.jenisFilter && jenis !== this.jenisFilter) {
                        return false;
                    }
                    
                    return true;
                }
            }
        }
    </script>
</x-layout>