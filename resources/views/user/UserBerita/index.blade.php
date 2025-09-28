<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50" x-data="{ 
        searchFocused: false,
        animateCards: false
    }" x-init="setTimeout(() => animateCards = true, 100)">
        
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in-up">
                        Portal <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-400">Berita</span>
                    </h1>
                    <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto animate-fade-in-up animation-delay-200">
                        Dapatkan informasi terkini dan terpercaya dari berbagai sumber berita pilihan
                    </p>
                    
                    <!-- Search Bar -->
                    <div class="max-w-2xl mx-auto animate-fade-in-up animation-delay-400">
                        <form method="GET" action="{{ route('user.berita.index') }}" class="relative">
                            <div class="relative group">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ $search }}"
                                    placeholder="Cari berita..."
                                    class="w-full px-6 py-4 text-lg rounded-2xl border-0 shadow-2xl focus:ring-4 focus:ring-blue-300 transition-all duration-300 pr-16 bg-white/95 backdrop-blur-sm"
                                    x-on:focus="searchFocused = true"
                                    x-on:blur="searchFocused = false"
                                >
                                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-r from-blue-500 to-purple-600 text-white p-3 rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            @if($search)
                <div class="mb-8 animate-fade-in-up">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Hasil Pencarian</h2>
                                <p class="text-gray-600 mt-1">Menampilkan hasil untuk: <span class="font-semibold text-blue-600">"{{ $search }}"</span></p>
                                <p class="text-sm text-gray-500 mt-2">{{ $berita->total() }} berita ditemukan</p>
                            </div>
                            <a href="{{ route('user.berita.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Hapus Filter
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            @if($berita->count() > 0)
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($berita as $index => $item)
                        <article 
                            class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-200 transform hover:-translate-y-2"
                            x-show="animateCards"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 transform translate-y-8"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            style="transition-delay: {{ $index * 100 }}ms"
                        >
                            <!-- Image -->
                            <div class="relative h-64 overflow-hidden">
                                @if($item->gambar)
                                    <img 
                                        src="{{ asset('storage/' . $item->gambar) }}" 
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    >
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Overlay gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Date badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $item->tanggal_publikasi->format('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-8">
                                <!-- Author & Stats -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">{{ substr($item->user->name, 0, 1) }}</span>
                                        </div>
                                        <span class="text-gray-600 text-sm font-medium">{{ $item->user->name }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ number_format($item->dilihat) }}
                                    </div>
                                </div>

                                <!-- Title -->
                                <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                    {{ $item->judul }}
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                    {{ $item->ringkasan }}
                                </p>

                                <!-- Read More Button -->
                                <a href="{{ route('user.berita.show', $item->slug) }}" 
                                   class="inline-flex items-center justify-between w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-2xl hover:shadow-lg transition-all duration-300 group/btn hover:scale-[1.02]">
                                    <span class="font-semibold">Baca Selengkapnya</span>
                                    <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-16">
                    {{ $berita->links() }}
                </div>
                
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">
                            @if($search)
                                Tidak Ada Hasil
                            @else
                                Belum Ada Berita
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-8">
                            @if($search)
                                Maaf, tidak ada berita yang cocok dengan pencarian "{{ $search }}". Coba kata kunci yang lain.
                            @else
                                Saat ini belum ada berita yang tersedia. Silakan kembali lagi nanti.
                            @endif
                        </p>
                        @if($search)
                            <a href="{{ route('user.berita.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18M3 14h18M3 18h18"></path>
                                </svg>
                                Lihat Semua Berita
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-400 {
            animation-delay: 0.4s;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-layout>