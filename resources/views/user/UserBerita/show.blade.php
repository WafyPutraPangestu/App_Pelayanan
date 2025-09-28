<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50" 
         x-data="{ 
             showShareModal: false, 
             copied: false,
             scrollProgress: 0,
             showBackToTop: false,
             socialShared: false
         }"
         x-init="
             window.addEventListener('scroll', () => {
                 const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                 const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                 scrollProgress = (winScroll / height) * 100;
                 showBackToTop = winScroll > 500;
             })
         ">
        
        <!-- Progress Bar -->
        <div class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50">
            <div class="h-1 bg-gradient-to-r from-blue-500 to-purple-600 transition-all duration-300" 
                 :style="`width: ${scrollProgress}%`"></div>
        </div>

        <!-- Back to Top Button -->
        <button 
            x-show="showBackToTop"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-75"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-75"
            @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-8 right-8 bg-gradient-to-r from-blue-500 to-purple-600 text-white p-4 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-110 z-40"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

        <!-- Share Modal -->
        <div x-show="showShareModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             @click.away="showShareModal = false">
            <div class="bg-white rounded-3xl p-8 max-w-md w-full transform"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-75"
                 x-transition:enter-end="opacity-100 transform scale-100">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Bagikan Artikel</h3>
                    <p class="text-gray-600">Bagikan artikel ini ke teman-teman Anda</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank"
                       class="flex items-center justify-center space-x-3 p-4 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="font-medium">Facebook</span>
                    </a>
                    
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}" 
                       target="_blank"
                       class="flex items-center justify-center space-x-3 p-4 bg-sky-500 text-white rounded-2xl hover:bg-sky-600 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                        <span class="font-medium">Twitter</span>
                    </a>
                    
                    <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}" 
                       target="_blank"
                       class="flex items-center justify-center space-x-3 p-4 bg-green-500 text-white rounded-2xl hover:bg-green-600 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        <span class="font-medium">WhatsApp</span>
                    </a>
                    
                    <button @click="
                        navigator.clipboard.writeText(window.location.href);
                        copied = true;
                        setTimeout(() => copied = false, 2000);
                    " class="flex items-center justify-center space-x-3 p-4 bg-gray-600 text-white rounded-2xl hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium" x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                    </button>
                </div>
                
                <button @click="showShareModal = false" 
                        class="w-full py-3 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition-colors duration-200 font-medium">
                    Tutup
                </button>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <nav class="flex items-center space-x-2 text-sm">
                    <a href="{{ route('user.berita.index') }}" class="text-blue-600 hover:text-blue-700 transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9 6 9-6"></path>
                        </svg>
                        Berita
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-600 truncate max-w-md">{{ $berita->judul }}</span>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Article Header -->
            <header class="mb-12 animate-fade-in-up">
                <div class="mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                        {{ $berita->judul }}
                    </h1>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center justify-between gap-6 py-6 border-y border-gray-200">
                        <div class="flex items-center space-x-6">
                            <!-- Author -->
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-lg font-bold">{{ substr($berita->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $berita->user->name }}</p>
                                    <p class="text-sm text-gray-500">Penulis</p>
                                </div>
                            </div>
                            
                            <!-- Date -->
                            <div class="hidden sm:block">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="font-medium">{{ $berita->tanggal_publikasi->format('d F Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ $berita->tanggal_publikasi->format('H:i') }} WIB</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Views -->
                            <div class="hidden md:block">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <div>
                                        <p class="font-medium">{{ number_format($berita->dilihat) }}</p>
                                        <p class="text-sm text-gray-500">Dibaca</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Share Button -->
                        <button @click="showShareModal = true" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-2xl hover:shadow-lg transition-all duration-300 hover:scale-105 group">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            <span class="font-semibold">Bagikan</span>
                        </button>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($berita->gambar)
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl mb-8 animate-fade-in-up animation-delay-200">
                        <img 
                            src="{{ asset('storage/' . $berita->gambar) }}" 
                            alt="{{ $berita->judul }}"
                            class="w-full h-96 md:h-[500px] object-cover hover:scale-105 transition-transform duration-700"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                @endif

                <!-- Summary -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-l-4 border-blue-500 p-8 rounded-r-2xl mb-8 animate-fade-in-up animation-delay-300">
                    <p class="text-lg text-gray-700 leading-relaxed font-medium">
                        {{ $berita->ringkasan }}
                    </p>
                </div>
            </header>

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none animate-fade-in-up animation-delay-400">
                <div class="text-gray-800 leading-relaxed space-y-6" style="line-height: 1.8;">
                    {!! nl2br(e($berita->konten)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <footer class="mt-16 pt-12 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600 font-medium">Bagikan artikel ini:</span>
                        <div class="flex items-center space-x-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-200 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition-all duration-200 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-all duration-200 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <a href="{{ route('user.berita.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-2xl transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span class="font-semibold">Kembali ke Berita</span>
                    </a>
                </div>
            </footer>
        </article>

        <!-- Related Articles -->
        @if($beritaTerbaru->count() > 0)
            <section class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Artikel Terkait</h2>
                        <p class="text-xl text-gray-600">Baca juga artikel menarik lainnya</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($beritaTerbaru as $index => $item)
                            <article class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-200 transform hover:-translate-y-2"
                                     x-data="{ visible: false }"
                                     x-intersect="visible = true"
                                     x-show="visible"
                                     x-transition:enter="transition ease-out duration-700"
                                     x-transition:enter-start="opacity-0 transform translate-y-8"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     style="transition-delay: {{ $index * 200 }}ms">
                                
                                <!-- Image -->
                                <div class="relative h-48 overflow-hidden">
                                    @if($item->gambar)
                                        <img 
                                            src="{{ asset('storage/' . $item->gambar) }}" 
                                            alt="{{ $item->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                        >
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Date badge -->
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $item->tanggal_publikasi->format('d M') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                        {{ $item->judul }}
                                    </h3>

                                    <p class="text-gray-600 mb-4 line-clamp-2 leading-relaxed text-sm">
                                        {{ $item->ringkasan }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ number_format($item->dilihat) }}
                                        </div>
                                        
                                        <a href="{{ route('user.berita.show', $item->slug) }}" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm group/link">
                                            Baca
                                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
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

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-300 {
            animation-delay: 0.3s;
        }

        .animation-delay-400 {
            animation-delay: 0.4s;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .prose {
            font-size: 1.125rem;
        }

        .prose p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
            color: #1f2937;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 0.5rem;
        }

        .prose ul, .prose ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }

        .prose li {
            margin: 0.5rem 0;
        }
    </style>
</x-layout>