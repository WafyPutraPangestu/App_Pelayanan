<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section dengan Gradient -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl shadow-2xl p-6 mb-8 text-white relative overflow-hidden animate-fade-in">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-10 rounded-full -mr-24 -mt-24 animate-pulse"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -ml-16 -mb-16 animate-pulse delay-300"></div>
                
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-extrabold tracking-tight">Detail Pengaduan</h1>
                            <p class="text-blue-100 mt-1">
                                Nomor: <span class="font-bold text-black bg-white bg-opacity-20 px-3 py-1 rounded-full">{{ $pengaduan->nomor_pengaduan }}</span>
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('pengaduanAdmin.index') }}" class="inline-flex items-center px-5 py-3 bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                       <span class="text-black"> Kembali </span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informasi Pengaduan -->
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-slide-in-left">
                    <div class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Informasi Pengaduan</h2>
                        </div>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <!-- Pelapor -->
                        <div class="flex items-start space-x-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl hover:shadow-md transition-shadow duration-300">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    {{ strtoupper(substr($pengaduan->user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pelapor</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $pengaduan->user->name }}</p>
                            </div>
                        </div>

                        <!-- Tanggal Lapor -->
                        <div class="flex items-start space-x-4 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl hover:shadow-md transition-shadow duration-300">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Tanggal Lapor</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $pengaduan->created_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- Jenis Layanan & Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl hover:shadow-md transition-shadow duration-300">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Jenis Layanan</p>
                                </div>
                                <p class="text-lg font-bold text-gray-900 capitalize">{{ $pengaduan->category }}</p>
                            </div>

                            {{-- <div class="p-4 bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl hover:shadow-md transition-shadow duration-300">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Kategori</p>
                                </div>
                                <span class="inline-block px-4 py-2 text-sm font-bold bg-gradient-to-r from-orange-100 to-red-100 text-orange-700 rounded-xl">{{ $pengaduan->kategori }}</span>
                            </div> --}}
                        </div>

                        <!-- Judul -->
                        <div class="p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center space-x-2 mb-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Judul Pengaduan</p>
                            </div>
                            <p class="text-xl font-bold text-gray-900">{{ $pengaduan->judul }}</p>
                        </div>

                        <!-- Isi Pengaduan -->
                        <div class="p-6 bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl border-2 border-gray-200 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center space-x-2 mb-4">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Isi Pengaduan</p>
                            </div>
                            <div class="prose max-w-none text-gray-800 leading-relaxed">
                                {{ $pengaduan->isi_pengaduan }}
                            </div>
                        </div>

                        <!-- Lampiran -->
                        @if($pengaduan->lampiran)
                        <div class="p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="p-3 bg-yellow-100 rounded-xl">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Lampiran</p>
                                        <p class="text-sm text-gray-700 mt-1">File pendukung pengaduan</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 text-white font-semibold rounded-xl hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat File
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Form Tanggapan -->
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-slide-in-right h-fit sticky top-8">
                    <div class="p-6 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Beri Tanggapan</h2>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <form method="POST" action="{{ route('pengaduanAdmin.update', $pengaduan) }}">
                            @csrf
                            @method('PUT')
                            <div class="space-y-6">
                                <!-- Tanggapan -->
                                <div class="space-y-2">
                                    <label for="tanggapan" class="flex items-center space-x-2 text-sm font-bold text-gray-700">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        <span>Tanggapan Anda</span>
                                    </label>
                                    <textarea name="tanggapan" id="tanggapan" rows="8" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 hover:border-green-300 resize-none" placeholder="Tulis tanggapan Anda di sini..." required>{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                                </div>

                                <!-- Status -->
                                <div class="space-y-2">
                                    <label for="status" class="flex items-center space-x-2 text-sm font-bold text-gray-700">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Ubah Status</span>
                                    </label>
                                    <select name="status" id="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 hover:border-green-300 font-semibold">
                                        <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                                        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                        <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold py-4 rounded-xl hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-4 focus:ring-green-300 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        <span>Kirim Tanggapan</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Status Current Badge -->
                    <div class="p-6 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-100">
                        <p class="text-sm font-semibold text-gray-600 mb-3">Status Saat Ini:</p>
                        <div class="flex justify-center">
                            @if($pengaduan->status == 'baru')
                                <span class="px-6 py-3 text-sm font-bold bg-gradient-to-r from-yellow-400 to-orange-400 text-white rounded-xl shadow-lg animate-pulse-subtle">
                                    🆕 Baru
                                </span>
                            @elseif($pengaduan->status == 'diproses')
                                <span class="px-6 py-3 text-sm font-bold bg-gradient-to-r from-orange-400 to-red-400 text-white rounded-xl shadow-lg">
                                    🔄 Diproses
                                </span>
                            @elseif($pengaduan->status == 'selesai')
                                <span class="px-6 py-3 text-sm font-bold bg-gradient-to-r from-green-400 to-emerald-400 text-white rounded-xl shadow-lg">
                                    ✅ Selesai
                                </span>
                            @else
                                <span class="px-6 py-3 text-sm font-bold bg-gradient-to-r from-red-400 to-pink-400 text-white rounded-xl shadow-lg">
                                    ❌ Ditolak
                                </span>
                            @endif
                        </div>
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

        @keyframes slide-in-left {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes pulse-subtle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.02); }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-out 0.2s both;
        }

        .animate-pulse-subtle {
            animation: pulse-subtle 2s ease-in-out infinite;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</x-layout>