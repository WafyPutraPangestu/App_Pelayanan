<x-layout>
    <div x-data="{
        showUpdateModal: false,
        newStatus: '{{ $surat->status }}',
        newCatatan: '{{ $surat->catatan ?? '' }}',
        showUploadModal: false
    }" class="space-y-6">

        <!-- Header dengan Breadcrumb -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('pengajuanSurat.index') }}" class="hover:text-blue-600 transition-colors">Pengajuan Surat</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Detail Surat</span>
            </nav>
            
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $surat->jenis_surat }}</h1>
                    <p class="text-gray-600 mt-1">Nomor: <span class="font-mono">{{ $surat->nomor_surat }}</span></p>
                </div>
                
                <div class="flex items-center gap-3">
                    <!-- Status Badge -->
                    @switch($surat->status)
                        @case('diproses')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                Diproses
                            </span>
                            @break
                        @case('selesai')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                Selesai
                            </span>
                            @break
                        @case('ditolak')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800 border border-red-200">
                                <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                Ditolak
                            </span>
                            @break
                    @endswitch

                    <!-- Action Buttons -->
                    <button @click="showUpdateModal = true" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                        Update Status
                    </button>

                    {{-- Download Button (Commented for future implementation) --}}
                    {{-- @if($surat->status === 'selesai')
                        <a href="{{ route('pengajuanSurat.download', [$jenis, $surat->id]) }}" 
                           class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                            Download PDF
                        </a>
                    @endif --}}

                    {{-- Upload Button (Commented for future implementation) --}}
                    {{-- @if($surat->status === 'selesai')
                        <button @click="showUploadModal = true"
                                class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                            Upload Signed
                        </button>
                    @endif --}}
                </div>
            </div>
        </div>

        <!-- Informasi Pemohon -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                Informasi Pemohon
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="text-gray-900 font-medium">{{ $surat->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="text-gray-900">{{ $surat->user->email }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">No. Telepon</label>
                        <p class="text-gray-900">{{ $surat->user->nomor_telepon ?? 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tanggal Pengajuan</label>
                        <p class="text-gray-900">{{ $surat->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Surat -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-1a1 1 0 00-1-1H9a1 1 0 00-1 1v1a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                Detail {{ $surat->jenis_surat }}
            </h2>

            @if($jenis === 'domisili')
                @include('admin.pengajuan_surat.partials.domisili-detail')
            @elseif($jenis === 'skm')
                @include('admin.pengajuan_surat.partials.skm-detail')
            @elseif($jenis === 'sku')
                @include('admin.pengajuan_surat.partials.sku-detail')
            @elseif($jenis === 'sktm')
                @include('admin.pengajuan_surat.partials.sktm-detail')
            @elseif($jenis === 'keterangan_lahir')
                @include('admin.pengajuan_surat.partials.keterangan-lahir-detail')
            @elseif($jenis === 'pengantar')
                @include('admin.pengajuan_surat.partials.pengantar-detail')
            @elseif($jenis === 'keterangan_menikah')
                @include('admin.pengajuan_surat.partials.keterangan-menikah-detail')
            @endif
        </div>

        <!-- Status dan Catatan -->
        @if($surat->catatan || $surat->tanggal_disetujui)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                Informasi Status
            </h2>
            
            <div class="space-y-4">
                @if($surat->catatan)
                <div>
                    <label class="text-sm font-medium text-gray-500">Catatan</label>
                    <div class="mt-1 p-4 bg-gray-50 rounded-xl">
                        <p class="text-gray-900">{{ $surat->catatan }}</p>
                    </div>
                </div>
                @endif

                @if($surat->tanggal_disetujui)
                <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal Disetujui</label>
                    <p class="text-gray-900 font-medium">{{ $surat->tanggal_disetujui->format('d F Y, H:i') }} WIB</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Timeline Status -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                Timeline Status
            </h2>

            <div class="space-y-4">
                <!-- Pengajuan -->
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Pengajuan Dibuat</p>
                        <p class="text-xs text-gray-500">{{ $surat->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>

                <!-- Status saat ini -->
                @if($surat->status === 'diproses')
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Sedang Diproses</p>
                        <p class="text-xs text-gray-500">Menunggu review admin</p>
                    </div>
                </div>
                @elseif($surat->status === 'selesai')
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Surat Selesai</p>
                        <p class="text-xs text-gray-500">{{ $surat->tanggal_disetujui ? $surat->tanggal_disetujui->format('d F Y, H:i') . ' WIB' : '' }}</p>
                    </div>
                </div>
                @elseif($surat->status === 'ditolak')
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Pengajuan Ditolak</p>
                        <p class="text-xs text-gray-500">{{ $surat->updated_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Modal Update Status -->
        <div x-show="showUpdateModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="showUpdateModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Status Surat</h3>
                
                <form method="POST" action="{{ route('pengajuanSurat.update', [$jenis, $surat->id]) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" x-model="newStatus" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="diproses" {{ $surat->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $surat->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $surat->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                            <textarea name="catatan" x-model="newCatatan" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Tambahkan catatan untuk pemohon...">{{ $surat->catatan }}</textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" @click="showUpdateModal = false"
                                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Upload Signed Document Modal (Commented for future implementation) --}}
        {{-- <div x-show="showUploadModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="showUploadModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Surat Bertanda Tangan</h3>
                
                <form method="POST" action="{{ route('pengajuanSurat.uploadSigned', [$jenis, $surat->id]) }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File PDF Bertanda Tangan</label>
                            <input type="file" name="surat_signed" accept=".pdf" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Maksimal 5MB, format PDF</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" @click="showUploadModal = false"
                                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl transition-colors">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}

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