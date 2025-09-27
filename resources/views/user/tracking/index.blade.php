<x-layout>
    <div x-data="trackingData()" class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Surat Masuk</h1>
                        <p class="mt-2 text-gray-600">Lacak status semua surat yang telah diajukan dengan mudah dan cepat</p>
                    </div>
                    <div class="flex items-center space-x-4">
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
                            <option value="diproses">Dalam Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter Jenis</label>
                        <select 
                            x-model="jenisFilter"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                            <option value="">Semua Jenis</option>
                            {{-- Opsi filter jenis surat bisa Anda tambahkan di sini jika perlu --}}
                            @foreach ($opsiJenisSurat as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

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
                                        x-show="filterSurat('{{ $surat->jenis_surat }}', '{{ $surat->status }}', '{{ $surat->nomor_surat ?? '' }}', '{{ $surat->nama ?? $surat->nama_almarhum ?? $surat->nama_lengkap ?? '' }}')"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
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
                                             <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium capitalize
                                                @switch($surat->status)
                                                    @case('selesai')
                                                        bg-green-100 text-green-800 ring-1 ring-green-600/20
                                                        @break
                                                    @case('ditolak')
                                                        bg-red-100 text-red-800 ring-1 ring-red-600/20
                                                        @break
                                                    @default
                                                        bg-yellow-100 text-yellow-800 ring-1 ring-yellow-600/20
                                                @endswitch">
                                                {{ $surat->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center space-x-3">
                                                
                                                {{-- Tombol Lihat Detail (Show) --}}
                                                <a href="{{ route($surat->show_route_name, $surat->id) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Lihat Detail">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                
                                                {{-- Tombol Edit, HANYA MUNCUL jika status 'diproses' --}}
                                                @if($surat->status == 'diproses')
                                                    <a href="{{ route($surat->edit_route_name, $surat->id) }}" class="text-yellow-600 hover:text-yellow-800 transition-colors duration-200" title="Edit Surat">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </a>
                                                @endif
                                                
                                                @if($surat->status != 'selesai')
                                                <form action="{{ route($surat->destroy_route_name, $surat->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Hapus Surat" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini? Data yang dihapus tidak dapat dikembalikan.')">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                                @endif
                                                {{-- Tombol Download, HANYA MUNCUL jika status 'selesai' --}}
                                                @if($surat->status == 'selesai' && $surat->nomor_surat)
                                                    <a href="#" class="text-green-600 hover:text-green-800 transition-colors duration-200" title="Download">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    </a>
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
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
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
                
                filterSurat(jenis, status, nomor, nama) {
                    const query = this.searchQuery.toLowerCase();
                    const statusMatch = !this.statusFilter || status === this.statusFilter;
                    const jenisMatch = !this.jenisFilter || jenis === this.jenisFilter;
                    const searchMatch = !this.searchQuery || 
                                        nomor.toLowerCase().includes(query) || 
                                        nama.toLowerCase().includes(query);

                    return statusMatch && jenisMatch && searchMatch;
                }
            }
        }
    </script>
</x-layout>