<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-4 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">Layanan Surat</h1>
            <p class="text-slate-600 text-lg">Pilih jenis surat yang ingin Anda buat</p>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl">
            
            <!-- Keterangan Domisili -->
            <a href="{{ route('domisili.create') }}" 
               class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-400 to-blue-600 p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
               x-data="{ hover: false }" 
               @mouseenter="hover = true" 
               @mouseleave="hover = false">
                <div class="relative z-10">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Keterangan Domisili</h3>
                    <p class="text-blue-100 text-sm opacity-90">Surat keterangan tempat tinggal</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 to-blue-700/20 transition-opacity duration-300"
                     :class="hover ? 'opacity-100' : 'opacity-0'"></div>
            </a>

            <!-- S.K.U -->
            <a href="{{ route('sku.create') }}" 
               class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-green-400 to-green-600 p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
               x-data="{ hover: false }" 
               @mouseenter="hover = true" 
               @mouseleave="hover = false">
                <div class="relative z-10">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">S.K.U</h3>
                    <p class="text-green-100 text-sm opacity-90">Surat Keterangan Usaha</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-green-500/0 to-green-700/20 transition-opacity duration-300"
                     :class="hover ? 'opacity-100' : 'opacity-0'"></div>
            </a>

            <!-- S.K.T.M -->
            <a href="{{ route('sktm.create') }}" 
               class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-purple-400 to-purple-600 p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
               x-data="{ hover: false }" 
               @mouseenter="hover = true" 
               @mouseleave="hover = false">
                <div class="relative z-10">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11 17h2v-6h-2v6zm1-8q.425 0 .713-.288Q13 8.425 13 8t-.287-.713Q12.425 7 12 7t-.712.287Q11 7.575 11 8t.288.712Q11.575 9 12 9zm0 13q-2.075 0-3.9-.788-1.825-.787-3.175-2.137-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175 1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138 1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175-1.35 1.35-3.175 2.137Q14.075 22 12 22z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">S.K.T.M</h3>
                    <p class="text-purple-100 text-sm opacity-90">Surat Keterangan Tidak Mampu</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500/0 to-purple-700/20 transition-opacity duration-300"
                     :class="hover ? 'opacity-100' : 'opacity-0'"></div>
            </a>

            <!-- S.K.M -->
            <a href="{{ route('skm.create') }}" 
               class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-amber-400 to-orange-500 p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
               x-data="{ hover: false }" 
               @mouseenter="hover = true" 
               @mouseleave="hover = false">
                <div class="relative z-10">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">S.K.M</h3>
                    <p class="text-amber-100 text-sm opacity-90">Surat Keterangan Mampu</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500/0 to-orange-600/20 transition-opacity duration-300"
                     :class="hover ? 'opacity-100' : 'opacity-0'"></div>
            </a>

            <!-- Surat Pengantar -->
            <a href="{{ route('surat_pengantar.create') }}" 
               class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-cyan-400 to-teal-500 p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
               x-data="{ hover: false }" 
               @mouseenter="hover = true" 
               @mouseleave="hover = false">
                <div class="relative z-10">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Surat Pengantar</h3>
                    <p class="text-cyan-100 text-sm opacity-90">Surat pengantar keperluan administrasi</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/0 to-teal-600/20 transition-opacity duration-300"
                     :class="hover ? 'opacity-100' : 'opacity-0'"></div>
            </a>

            <!-- Keterangan Lahir -->
            <a href="{{ route('keterangan_lahir.create') }}" 
               class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-pink-400 to-rose-500 p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
               x-data="{ hover: false }" 
               @mouseenter="hover = true" 
               @mouseleave="hover = false">
                <div class="relative z-10">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M19,11C19,14.53 16.39,17.44 13,17.93V21H11V17.93C7.61,17.44 5,14.53 5,11H7A5,5 0 0,0 12,16A5,5 0 0,0 17,11H19Z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Keterangan Lahir</h3>
                    <p class="text-pink-100 text-sm opacity-90">Surat keterangan kelahiran</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-pink-500/0 to-rose-600/20 transition-opacity duration-300"
                     :class="hover ? 'opacity-100' : 'opacity-0'"></div>
            </a>

            <!-- Keterangan Menikah -->
            <a href="{{ route('keterangan_menikah.create') }}" 
               class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-red-400 to-pink-500 p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
               x-data="{ hover: false }" 
               @mouseenter="hover = true" 
               @mouseleave="hover = false">
                <div class="relative z-10">
                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5 2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Keterangan Menikah</h3>
                    <p class="text-red-100 text-sm opacity-90">Surat keterangan pernikahan</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 to-pink-600/20 transition-opacity duration-300"
                     :class="hover ? 'opacity-100' : 'opacity-0'"></div>
            </a>

        </div>

        <!-- Additional Info Section -->
        <div class="mt-12 rounded-3xl bg-white/70 backdrop-blur-sm border border-white/20 p-8 shadow-lg">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A1.5,1.5 0 0,1 10.5,15.5A1.5,1.5 0 0,1 12,14A1.5,1.5 0 0,1 13.5,15.5A1.5,1.5 0 0,1 12,17M14.5,10.5C14.5,9 13.5,8 12,8C10.5,8 9.5,9 9.5,10.5H11C11,9.7 11.4,9.4 12,9.4C12.6,9.4 13,9.7 13,10.5C13,11.3 12.6,11.6 12,12.6V14H10V13C10,11.8 10.9,10.9 12,10.5C12.4,10.3 12.5,10.1 12.5,10C12.5,9.7 12.3,9.5 12,9.5C11.7,9.5 11.5,9.7 11.5,10H10C10,8.9 10.9,8 12,8C13.1,8 14,8.9 14,10C14,10.3 13.9,10.6 13.7,10.9L14.5,10.5Z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Informasi Penting</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Pastikan Anda telah menyiapkan dokumen-dokumen yang diperlukan sebelum membuat surat. 
                        Untuk informasi lebih lanjut mengenai persyaratan setiap jenis surat, silakan hubungi 
                        petugas kelurahan atau desa setempat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>