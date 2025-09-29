<x-layout>
    <div x-data="userDashboard()" x-init="initCharts()" class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50">
        <!-- Header Section dengan Animasi -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl shadow-2xl p-8 mb-8 text-white relative overflow-hidden animate-gradient">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32 animate-pulse"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24 animate-pulse delay-300"></div>
                
                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold tracking-tight animate-fade-in" x-text="'Selamat Datang, ' + '{{ Auth::user()->name }}'"></h1>
                    <p class="mt-3 text-blue-100 text-lg animate-fade-in-delay">Ringkasan informasi dan layanan untuk Anda.</p>
                </div>
            </div>

            <!-- Cards Section dengan Hover Effect -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <!-- Surat Siap Download Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl border-l-4 border-blue-500 animate-slide-in-left group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="p-3 bg-blue-100 rounded-xl group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Surat Siap Download</p>
                                    <p class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">{{ $infoUser['surat_siap_download'] }}</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('suratMasuk.index') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Lihat Surat
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Pengaduan Terakhir Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl border-l-4 border-purple-500 animate-slide-in-right group">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-3 bg-purple-100 rounded-xl group-hover:bg-purple-200 transition-colors">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-500">Status Pengaduan Terakhir</p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        @if($infoUser['pengaduan_terakhir'])
                            <p class="text-lg font-bold text-gray-900 flex-1">{{ Str::limit($infoUser['pengaduan_terakhir']->judul, 25) }}</p>
                            <span class="px-4 py-2 text-xs font-bold rounded-xl shadow-sm animate-pulse-subtle
                                @if($infoUser['pengaduan_terakhir']->status == 'baru') bg-gradient-to-r from-yellow-400 to-yellow-500 text-white
                                @elseif($infoUser['pengaduan_terakhir']->status == 'diproses') bg-gradient-to-r from-orange-400 to-orange-500 text-white
                                @elseif($infoUser['pengaduan_terakhir']->status == 'selesai') bg-gradient-to-r from-green-400 to-green-500 text-white
                                @else bg-gradient-to-r from-red-400 to-red-500 text-white @endif">
                                {{ ucfirst($infoUser['pengaduan_terakhir']->status) }}
                            </span>
                        @else
                            <p class="text-gray-500 italic flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                Belum ada pengaduan.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kependudukan Section -->
            <div class="mb-8 animate-fade-in">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="h-8 w-1 bg-gradient-to-b from-blue-600 to-indigo-600 rounded-full"></div>
                    <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-800 to-gray-600">Informasi Kependudukan Desa</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Populasi Penduduk Chart -->
                <div class="lg:col-span-2 animate-slide-up">
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-shadow duration-300 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full -mr-20 -mt-20 opacity-50"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Populasi Penduduk per Wilayah</h3>
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="relative w-full" style="height: 400px;">
                                <canvas x-ref="chartPenduduk" class="w-full h-full"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Jumlah Keluarga & Gender -->
                <div class="space-y-8">
                    <!-- Jumlah Keluarga Card -->
                    <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl shadow-xl p-8 text-white hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-slide-up relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative z-10">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="p-3 bg-white bg-opacity-20 rounded-xl backdrop-blur-sm">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold">Jumlah Keluarga</h3>
                            </div>
                            <p class="text-5xl font-extrabold mb-2 animate-count-up">{{ number_format($jumlahKeluarga) }}</p>
                            <p class="text-green-100 text-sm">Total Kepala Keluarga</p>
                        </div>
                    </div>

                    <!-- Komposisi Gender Chart -->
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-shadow duration-300 animate-slide-up-delay relative overflow-hidden">
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-pink-100 to-blue-100 rounded-full -ml-16 -mb-16 opacity-50"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-gray-800">Komposisi Gender</h3>
                                <div class="p-2 bg-gradient-to-r from-blue-100 to-pink-100 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="relative w-full" style="height: 300px;">
                                <canvas x-ref="chartGender" class="w-full h-full"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- APBDes Section -->
            <div class="mt-12 animate-fade-in">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="h-8 w-1 bg-gradient-to-b from-green-600 to-emerald-600 rounded-full"></div>
                    <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-800 to-gray-600">Informasi Dana Desa & APBDes</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Total Anggaran Card -->
                    <div class="bg-gradient-to-br from-emerald-500 via-green-500 to-teal-600 rounded-3xl shadow-xl p-8 flex flex-col justify-center items-center text-center hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-slide-up relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-40 h-40 bg-white opacity-10 rounded-full -ml-20 -mt-20 animate-pulse"></div>
                        <div class="absolute bottom-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mb-16 animate-pulse delay-300"></div>
                        
                        <div class="relative z-10">
                            <div class="inline-flex p-4 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm mb-4">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-4">Total Anggaran APBDes</h3>
                            <p class="text-4xl font-extrabold text-white mb-2 animate-count-up">Rp {{ number_format($totalAnggaran, 2, ',', '.') }}</p>
                            <p class="text-green-100 text-sm">Total dana yang dianggarkan untuk desa.</p>
                        </div>
                    </div>
                    
                    <!-- Daftar File APBDes -->
                    <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-shadow duration-300 animate-slide-up-delay">
                        <div class="p-6 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800">Dokumen APBDes</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            @if($dataApbdes->isNotEmpty())
                                <ul class="space-y-4">
                                    @foreach($dataApbdes as $data)
                                        <li class="flex items-center justify-between p-5 bg-gradient-to-r from-gray-50 to-green-50 rounded-2xl hover:from-green-50 hover:to-emerald-50 transition-all duration-300 border border-gray-100 hover:border-green-200 hover:shadow-md group">
                                            <div class="flex items-center space-x-4 flex-1">
                                                <div class="p-3 bg-green-100 rounded-xl group-hover:bg-green-200 transition-colors">
                                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-800 text-lg">{{ $data->nama_wilayah }} <span class="text-sm font-semibold text-green-600">{{ $data->created_at->format('Y') }}</span></p>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $data->keterangan ?? 'Dokumen Anggaran Pendapatan dan Belanja Desa' }}</p>
                                                </div>
                                            </div>
                                            <a href="{{ Storage::url($data->file_apbdes) }}" target="_blank" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white text-sm font-semibold rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                Download
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-12">
                                    <div class="inline-flex p-4 bg-gray-100 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-lg">Belum ada file APBDes yang diunggah.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS Animations -->
    <style>
        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 8s ease infinite;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fade-in-delay {
            from { opacity: 0; transform: translateY(-10px); }
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

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse-subtle {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-fade-in-delay {
            animation: fade-in-delay 0.8s ease-out 0.2s both;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.6s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }

        .animate-slide-up-delay {
            animation: slide-up 0.8s ease-out 0.2s both;
        }

        .animate-pulse-subtle {
            animation: pulse-subtle 3s ease-in-out infinite;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }
    </style>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function userDashboard() {
            return {
                initCharts() {
                    // Data dari Controller
                    const dataPenduduk = @json($dataPenduduk);
                    const dataGender = @json($dataGender);

                    // Inisialisasi Chart Penduduk dengan Gradient
                    const ctxPenduduk = this.$refs.chartPenduduk.getContext('2d');
                    const gradientPenduduk = ctxPenduduk.createLinearGradient(0, 0, 0, 400);
                    gradientPenduduk.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
                    gradientPenduduk.addColorStop(1, 'rgba(99, 102, 241, 0.3)');

                    new Chart(ctxPenduduk, {
                        type: 'bar',
                        data: {
                            labels: dataPenduduk.map(d => d.nama_wilayah),
                            datasets: [{
                                label: 'Jumlah Penduduk',
                                data: dataPenduduk.map(d => d.jumlah_penduduk),
                                backgroundColor: gradientPenduduk,
                                borderColor: 'rgba(59, 130, 246, 1)',
                                borderWidth: 2,
                                borderRadius: 12,
                                barThickness: 30,
                                hoverBackgroundColor: 'rgba(59, 130, 246, 1)',
                                hoverBorderWidth: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { 
                                        color: 'rgba(0, 0, 0, 0.05)',
                                        drawBorder: false
                                    },
                                    ticks: { 
                                        color: '#6B7280',
                                        font: { size: 12, weight: '500' }
                                    }
                                },
                                x: { 
                                    grid: { display: false },
                                    ticks: { 
                                        color: '#6B7280',
                                        font: { size: 12, weight: '500' }
                                    }
                                }
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    padding: 16,
                                    cornerRadius: 12,
                                    titleFont: { size: 14, weight: 'bold' },
                                    bodyFont: { size: 13 },
                                    displayColors: false,
                                    callbacks: {
                                        label: function(context) {
                                            return 'Jumlah: ' + context.parsed.y.toLocaleString() + ' jiwa';
                                        }
                                    }
                                }
                            },
                            animation: {
                                duration: 1500,
                                easing: 'easeInOutQuart'
                            }
                        }
                    });

                    // Inisialisasi Chart Gender dengan Gradient
                    const ctxGender = this.$refs.chartGender.getContext('2d');
                    
                    new Chart(ctxGender, {
                        type: 'doughnut',
                        data: {
                            labels: dataGender.labels,
                            datasets: [{
                                label: 'Jumlah',
                                data: dataGender.data,
                                backgroundColor: [
                                    'rgba(59, 130, 246, 0.85)',
                                    'rgba(236, 72, 153, 0.85)'
                                ],
                                borderColor: ['#fff', '#fff'],
                                borderWidth: 3,
                                hoverOffset: 15,
                                hoverBorderWidth: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '65%',
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: '#4B5563',
                                        font: { size: 14, weight: '600' },
                                        padding: 20,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) { label += ': '; }
                                            let value = context.raw;
                                            let total = context.chart.getDatasetMeta(0).total;
                                            let percentage = (value / total * 100).toFixed(1) + '%';
                                            return label + value.toLocaleString() + ' (' + percentage + ')';
                                        }
                                    },
                                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    padding: 16,
                                    cornerRadius: 12,
                                    titleFont: { size: 14, weight: 'bold' },
                                    bodyFont: { size: 13 },
                                    displayColors: true,
                                    usePointStyle: true
                                }
                            },
                            animation: {
                                duration: 1500,
                                easing: 'easeInOutQuart',
                                animateRotate: true,
                                animateScale: true
                            }
                        }
                    });
                }
            }
        }
    </script>
</x-layout>