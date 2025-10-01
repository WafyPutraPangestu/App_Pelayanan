<x-layout>
    <div x-data="pengaduanIndex()" class="min-h-screen bg-gradient-to-br from-gray-50 via-purple-50 to-pink-50">
        <div class="container mx-auto px-4 py-8">
            <!-- Header dengan Gradient -->
            <div class="mb-8 animate-fade-in">
                <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 rounded-3xl shadow-2xl p-8 text-white relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32 animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24 animate-pulse delay-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center space-x-4 mb-3">
                            <div class="p-3 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-4xl font-extrabold tracking-tight">Kelola Pengaduan</h1>
                                <p class="text-purple-100 text-lg mt-1">Kelola dan tanggapi pengaduan dari masyarakat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Cards dengan Animasi -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Pengaduan -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 transition-all duration-300 hover:scale-105 hover:shadow-2xl animate-slide-in group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300">
                                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Pengaduan</p>
                                    <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">{{ $statistik['total'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Baru -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 transition-all duration-300 hover:scale-105 hover:shadow-2xl animate-slide-in animation-delay-100 group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl group-hover:from-yellow-200 group-hover:to-yellow-300 transition-all duration-300">
                                    <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Baru</p>
                                    <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-orange-600">{{ $statistik['baru'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Diproses -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-orange-500 transition-all duration-300 hover:scale-105 hover:shadow-2xl animate-slide-in animation-delay-200 group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl group-hover:from-orange-200 group-hover:to-orange-300 transition-all duration-300">
                                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Diproses</p>
                                    <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-red-600">{{ $statistik['diproses'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 transition-all duration-300 hover:scale-105 hover:shadow-2xl animate-slide-in animation-delay-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-gradient-to-br from-green-100 to-green-200 rounded-xl group-hover:from-green-200 group-hover:to-green-300 transition-all duration-300">
                                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Selesai</p>
                                    <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600">{{ $statistik['selesai'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter dan Search dengan Style Modern -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 mb-8 overflow-hidden animate-slide-up">
                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Filter Pengaduan</h2>
                    </div>
                </div>
                <div class="p-6">
                    <form method="GET" action="{{ route('pengaduanAdmin.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                            <select name="status" id="status" x-model="selectedStatus" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 hover:border-purple-300">
                                <option value="semua">Semua Status</option>
                                <option value="baru" {{ $status == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="diproses" {{ $status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="category" class="block text-sm font-semibold text-gray-700">Jenis Layanan</label>
                            <select name="category" id="category" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 hover:border-purple-300">
                                <option value="semua">Semua Layanan</option>
                                @foreach($mainCategoryList as $cat)
                                    <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ ucwords($cat) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="space-y-2">
                            <label for="kategori" class="block text-sm font-semibold text-gray-700">Kategori</label>
                            <select name="kategori" id="kategori" x-model="selectedKategori" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 hover:border-purple-300">
                                <option value="semua">Semua Kategori</option>
                                @foreach($kategoriList as $kat)
                                    <option value="{{ $kat }}" {{ $kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg font-semibold flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                <span>Filter</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Pengaduan dengan Style Modern -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-slide-up animation-delay-100">
                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Daftar Pengaduan</h2>
                        </div>
                        <div class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                            Total: {{ $pengaduan->total() }}
                        </div>
                    </div>
                </div>

                @if($pengaduan->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-gray-50 to-purple-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nomor</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pengadu</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis Layanan</th>
                                    {{-- <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kategori</th> --}}
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($pengaduan as $pengaduanItem)
                                    <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all duration-300">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-bold text-purple-600">{{ $pengaduanItem->nomor_pengaduan }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold">
                                                    {{ strtoupper(substr($pengaduanItem->user->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <span class="text-sm font-semibold text-gray-900">{{ $pengaduanItem->user->name ?? 'Tidak diketahui' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="max-w-xs">
                                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $pengaduanItem->judul }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 text-xs font-bold bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 rounded-full capitalize">
                                                {{ $pengaduanItem->category }}
                                            </span>
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 text-xs font-bold bg-gray-100 text-gray-800 rounded-full">
                                                {{ $pengaduanItem->kategori }}
                                            </span>
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($pengaduanItem->status == 'baru')
                                                <span class="px-3 py-1.5 text-xs font-bold bg-gradient-to-r from-yellow-400 to-orange-400 text-white rounded-full shadow-sm animate-pulse-subtle">Baru</span>
                                            @elseif($pengaduanItem->status == 'diproses')
                                                <span class="px-3 py-1.5 text-xs font-bold bg-gradient-to-r from-orange-400 to-red-400 text-white rounded-full shadow-sm">Diproses</span>
                                            @elseif($pengaduanItem->status == 'selesai')
                                                <span class="px-3 py-1.5 text-xs font-bold bg-gradient-to-r from-green-400 to-emerald-400 text-white rounded-full shadow-sm">Selesai</span>
                                            @else
                                                <span class="px-3 py-1.5 text-xs font-bold bg-gradient-to-r from-red-400 to-pink-400 text-white rounded-full shadow-sm">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-2 text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-sm font-medium">{{ $pengaduanItem->created_at->format('d/m/Y') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex space-x-3">
                                                <a href="{{ route('pengaduanAdmin.show', $pengaduanItem) }}" 
                                                   class="p-2 bg-blue-100 text-blue-600 hover:bg-blue-200 rounded-lg transition-all duration-300 transform hover:scale-110 hover:shadow-md" 
                                                   title="Lihat Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <button @click="confirmDelete({{ $pengaduanItem->id }}, '{{ addslashes($pengaduanItem->judul) }}')" 
                                                        class="p-2 bg-red-100 text-red-600 hover:bg-red-200 rounded-lg transition-all duration-300 transform hover:scale-110 hover:shadow-md" 
                                                        title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination dengan Style Modern -->
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-purple-50 border-t border-gray-100">
                        {{ $pengaduan->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="p-16 text-center">
                        <div class="inline-flex p-6 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full mb-6">
                            <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada pengaduan</h3>
                        <p class="text-gray-500">Belum ada pengaduan yang ditemukan dengan filter yang dipilih.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus dengan Animasi -->
        <div x-show="showDeleteModal" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center" 
             style="display: none;">
            <div x-show="showDeleteModal"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-75"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-75"
                 class="relative mx-4 p-6 border w-full max-w-md shadow-2xl rounded-3xl bg-white">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-red-100 to-pink-100 animate-bounce-subtle">
                        <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl leading-6 font-bold text-gray-900 mt-6">Hapus Pengaduan</h3>
                    <div class="mt-4 px-4 py-3">
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Apakah Anda yakin ingin menghapus pengaduan "<span x-text="deleteTitle" class="font-bold text-gray-900"></span>"? 
                            <br><span class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan.</span>
                        </p>
                    </div>
                    <div class="flex items-center justify-center space-x-4 px-4 py-4">
                        <button @click="showDeleteModal = false" 
                                class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-300 transform hover:scale-105">
                            Batal
                        </button>
                        <button @click="deleteItem()" 
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white text-sm font-semibold rounded-xl hover:from-red-700 hover:to-pink-700 focus:outline-none focus:ring-4 focus:ring-red-300 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS Animations -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slide-in {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse-subtle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.02); }
        }

        @keyframes bounce-subtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-in {
            animation: slide-in 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }

        .animate-pulse-subtle {
            animation: pulse-subtle 2s ease-in-out infinite;
        }

        .animate-bounce-subtle {
            animation: bounce-subtle 2s ease-in-out infinite;
        }

        .animation-delay-100 {
            animation-delay: 0.1s;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-300 {
            animation-delay: 0.3s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        /* Hover effects untuk table rows */
        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            transform: translateX(5px);
        }
    </style>

    <script>
        function pengaduanIndex() {
            return {
                selectedStatus: '{{ $status }}',
                // selectedKategori: '{{ $kategori }}',
                showDeleteModal: false,
                deleteId: null,
                deleteTitle: '',

                confirmDelete(id, title) {
                    this.deleteId = id;
                    this.deleteTitle = title;
                    this.showDeleteModal = true;
                },

                async deleteItem() {
                    try {
                        const formData = new FormData();
                        formData.append('_method', 'DELETE');
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                        const response = await fetch(`/admin/pengaduanAdmin/${this.deleteId}`, {
                            method: 'POST',
                            body: formData
                        });

                        if (response.ok) {
                            window.location.reload();
                        } else {
                            alert('Gagal menghapus pengaduan');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus pengaduan');
                    }

                    this.showDeleteModal = false;
                }
            }
        }
    </script>
</x-layout>