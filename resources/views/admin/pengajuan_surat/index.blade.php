<x-layout>
    <div x-data="{
        showBatchActions: false,
        selectedSurats: [],
        showBatchModal: false,
        batchStatus: '',
        batchCatatan: '',
        
        toggleSurat(suratId) {
            const index = this.selectedSurats.indexOf(suratId);
            if (index > -1) {
                this.selectedSurats.splice(index, 1);
            } else {
                this.selectedSurats.push(suratId);
            }
            this.showBatchActions = this.selectedSurats.length > 0;
        },
        
        selectAll() {
            const checkboxes = document.querySelectorAll('input[name=\'surat_ids[]\']');
            if (this.selectedSurats.length === checkboxes.length) {
                this.selectedSurats = [];
                checkboxes.forEach(cb => cb.checked = false);
            } else {
                this.selectedSurats = [];
                checkboxes.forEach(cb => {
                    cb.checked = true;
                    this.selectedSurats.push(cb.value);
                });
            }
            this.showBatchActions = this.selectedSurats.length > 0;
        }
    }" class="space-y-6">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Pengajuan Surat</h1>
                    <p class="text-gray-600 mt-1">Kelola dan approve pengajuan surat dari masyarakat</p>
                </div>
                
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-blue-700">{{ $statistik['total'] }}</div>
                        <div class="text-sm text-blue-600">Total</div>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-yellow-700">{{ $statistik['diproses'] }}</div>
                        <div class="text-sm text-yellow-600">Diproses</div>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-green-700">{{ $statistik['selesai'] }}</div>
                        <div class="text-sm text-green-600">Selesai</div>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                        <div class="text-2xl font-bold text-red-700">{{ $statistik['ditolak'] }}</div>
                        <div class="text-sm text-red-600">Ditolak</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                        <select name="jenis" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="semua" {{ $jenisSurat == 'semua' ? 'selected' : '' }}>Semua Jenis</option>
                            <option value="domisili" {{ $jenisSurat == 'domisili' ? 'selected' : '' }}>Surat Domisili</option>
                            <option value="skm" {{ $jenisSurat == 'skm' ? 'selected' : '' }}>Surat Keterangan Meninggal</option>
                            <option value="sku" {{ $jenisSurat == 'sku' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                            <option value="sktm" {{ $jenisSurat == 'sktm' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                            <option value="keterangan_lahir" {{ $jenisSurat == 'keterangan_lahir' ? 'selected' : '' }}>Surat Keterangan Lahir</option>
                            <option value="pengantar" {{ $jenisSurat == 'pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                            <option value="keterangan_menikah" {{ $jenisSurat == 'keterangan_menikah' ? 'selected' : '' }}>Surat Keterangan Menikah</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="semua" {{ $status == 'semua' ? 'selected' : '' }}>Semua Status</option>
                            <option value="diproses" {{ $status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div x-show="showBatchActions" x-transition class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    <span x-text="selectedSurats.length"></span> surat dipilih
                </div>
                <button @click="showBatchModal = true" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition-colors">
                    Batch Update Status
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @if($pengajuanSurat->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left">
                                    <input type="checkbox" @click="selectAll()" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Surat</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Surat</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pengajuanSurat as $surat)
                                @php
                                    $jenisSlug = '';
                                    switch($surat->jenis_surat) {
                                        case 'Surat Domisili': $jenisSlug = 'domisili'; break;
                                        case 'Surat Keterangan Meninggal': $jenisSlug = 'skm'; break;
                                        case 'Surat Keterangan Usaha': $jenisSlug = 'sku'; break;
                                        case 'Surat Keterangan Tidak Mampu': $jenisSlug = 'sktm'; break;
                                        case 'Surat Keterangan Lahir': $jenisSlug = 'keterangan_lahir'; break;
                                        case 'Surat Pengantar': $jenisSlug = 'pengantar'; break;
                                        case 'Surat Keterangan Menikah': $jenisSlug = 'keterangan_menikah'; break;
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" 
                                               name="surat_ids[]" 
                                               value="{{ $jenisSlug }}-{{ $surat->id }}"
                                               @click="toggleSurat('{{ $jenisSlug }}-{{ $surat->id }}')"
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $surat->nomor_surat }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $surat->jenis_surat }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900 font-medium">{{ $surat->user->name }}</div>
                                        <div class="text-gray-500 text-sm">{{ $surat->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $surat->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @switch($surat->status)
                                            @case('diproses')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Diproses</span>
                                                @break
                                            @case('selesai')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                                                @break
                                            @case('ditolak')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-4">
                                            <a href="{{ route('pengajuanSurat.show', [$jenisSlug, $surat->id]) }}" 
                                               class="text-blue-600 hover:text-blue-900 font-medium text-sm">
                                                Detail
                                            </a>
                                            
                                            @if($surat->status === 'selesai')
                                                <a href="{{ route('pengajuanSurat.download', [$jenisSlug, $surat->id]) }}" 
                                                   class="text-green-600 hover:text-green-900 font-medium text-sm">
                                                    Download Draf
                                                </a>
                                                <a href="{{ route('suratMasuk.create', ['jenis' => $jenisSlug, 'surat_id' => $surat->id]) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                                    Arsipkan
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
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 text-gray-300">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 3a1 1 0 000 2h10a1 1 0 100-2H5zM5 9a1 1 0 000 2h6a1 1 0 100-2H5z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada pengajuan surat</h3>
                    <p class="text-gray-500">Belum ada pengajuan surat yang masuk dengan filter yang dipilih.</p>
                </div>
            @endif
        </div>

        <div x-show="showBatchModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="showBatchModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Batch Update Status</h3>
                
                <form method="POST" action="{{ route('pengajuanSurat.batchUpdate') }}">
                    @csrf
                    <template x-for="suratId in selectedSurats" :key="suratId">
                        <input type="hidden" name="surat_ids[]" :value="suratId">
                    </template>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="batch_status" x-model="batchStatus" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Pilih Status</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                            <textarea name="batch_catatan" x-model="batchCatatan" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tambahkan catatan (opsional)"></textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" @click="showBatchModal = false" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">Update Status</button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-layout>