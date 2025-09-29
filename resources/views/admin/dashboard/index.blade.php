<x-layout>
    <div x-data="adminDashboard()" x-init="initCharts()" class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50">
        <div class="p-8">
            <!-- Header Section dengan Animasi -->
            <div class="mb-10 animate-fade-in">
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl p-8 text-white relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32 animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24 animate-pulse delay-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center space-x-4 mb-3">
                            <div class="p-3 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm">
                                <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-4xl font-extrabold tracking-tight">Dashboard Admin</h1>
                                <p class="mt-2 text-indigo-100 text-lg">Selamat datang kembali, <span class="font-bold text-white">{{ Auth::user()->name }}</span>! Lihat ringkasan aktivitas sistem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Cards dengan Animasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Jumlah Pengguna -->
                <div class="bg-white p-6 rounded-3xl shadow-xl border-l-4 border-indigo-500 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 animate-slide-up group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="p-3 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl group-hover:from-indigo-200 group-hover:to-indigo-300 transition-all duration-300">
                                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Jumlah Pengguna</p>
                            <p class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mt-2">{{ number_format($statistik['jumlah_pengguna']) }}</p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Total akun terdaftar
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Surat -->
                <div class="bg-white p-6 rounded-3xl shadow-xl border-l-4 border-teal-500 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 animate-slide-up animation-delay-100 group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="p-3 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl group-hover:from-teal-200 group-hover:to-teal-300 transition-all duration-300">
                                    <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Surat</p>
                            <p class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-600 mt-2">{{ number_format($statistik['jumlah_surat_masuk']) }}</p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                                Surat masuk terarsip
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Pengaduan -->
                <div class="bg-white p-6 rounded-3xl shadow-xl border-l-4 border-purple-500 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 animate-slide-up animation-delay-200 group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="p-3 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl group-hover:from-purple-200 group-hover:to-purple-300 transition-all duration-300">
                                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Pengaduan</p>
                            <p class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mt-2">{{ number_format($statistik['jumlah_pengaduan']) }}</p>
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Semua pengaduan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Baru -->
                <div class="bg-gradient-to-br from-yellow-400 via-orange-400 to-red-400 p-6 rounded-3xl shadow-xl border-2 border-yellow-300 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 animate-slide-up animation-delay-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16 animate-spin-slow"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="p-3 bg-white bg-opacity-30 rounded-xl backdrop-blur-sm">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-white uppercase tracking-wide">Pengaduan Baru</p>
                                <p class="text-4xl font-extrabold text-white mt-2 animate-pulse-subtle">{{ number_format($statistik['pengaduan_baru']) }}</p>
                                <p class="text-xs text-yellow-100 mt-2 flex items-center font-semibold">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Menunggu tindakan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Chart Penduduk -->
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow duration-300 animate-slide-up-delay relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full -mr-20 -mt-20 opacity-50"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-indigo-100 rounded-lg">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Populasi Penduduk per Wilayah</h3>
                            </div>
                        </div>
                        <div class="relative" style="height: 350px;">
                            <canvas x-ref="chartPenduduk" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart Tren Surat -->
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow duration-300 animate-slide-up-delay-200 relative overflow-hidden">
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-gradient-to-tr from-emerald-100 to-teal-100 rounded-full -ml-20 -mb-20 opacity-50"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-emerald-100 rounded-lg">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Tren Pengajuan Surat</h3>
                            </div>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">7 Hari Terakhir</span>
                        </div>
                        <div class="relative" style="height: 350px;">
                            <canvas x-ref="chartTrenSurat" class="w-full h-full"></canvas>
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

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse-subtle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.05); }
        }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }

        .animate-slide-up-delay {
            animation: slide-up 0.8s ease-out 0.3s both;
        }

        .animate-slide-up-delay-200 {
            animation: slide-up 0.8s ease-out 0.4s both;
        }

        .animate-pulse-subtle {
            animation: pulse-subtle 2s ease-in-out infinite;
        }

        .animate-spin-slow {
            animation: spin-slow 20s linear infinite;
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
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function adminDashboard() {
            return {
                initCharts() {
                    // Data dari Controller
                    const dataPenduduk = @json($dataPenduduk);
                    const trenSurat = @json($trenSurat);

                    // Inisialisasi Chart Penduduk dengan Gradient
                    const ctxPenduduk = this.$refs.chartPenduduk.getContext('2d');
                    const gradientPenduduk = ctxPenduduk.createLinearGradient(0, 0, 0, 350);
                    gradientPenduduk.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
                    gradientPenduduk.addColorStop(1, 'rgba(168, 85, 247, 0.4)');

                    new Chart(ctxPenduduk, {
                        type: 'bar',
                        data: {
                            labels: dataPenduduk.map(d => d.nama_wilayah),
                            datasets: [{
                                label: 'Jumlah Penduduk',
                                data: dataPenduduk.map(d => d.jumlah_penduduk),
                                backgroundColor: gradientPenduduk,
                                borderColor: 'rgba(99, 102, 241, 1)',
                                borderWidth: 2,
                                borderRadius: 12,
                                barThickness: 30,
                                hoverBackgroundColor: 'rgba(99, 102, 241, 1)',
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
                                        font: { size: 12, weight: '600', family: 'Inter' }
                                    }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        color: '#6B7280',
                                        font: { size: 12, weight: '600', family: 'Inter' }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    padding: 16,
                                    cornerRadius: 12,
                                    titleFont: { size: 14, weight: 'bold', family: 'Inter' },
                                    bodyFont: { size: 13, family: 'Inter' },
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

                    // Inisialisasi Chart Tren Surat dengan Gradient
                    const ctxTrenSurat = this.$refs.chartTrenSurat.getContext('2d');
                    const gradientTrenSurat = ctxTrenSurat.createLinearGradient(0, 0, 0, 350);
                    gradientTrenSurat.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
                    gradientTrenSurat.addColorStop(1, 'rgba(16, 185, 129, 0.05)');

                    new Chart(ctxTrenSurat, {
                        type: 'line',
                        data: {
                            labels: trenSurat.labels,
                            datasets: [{
                                label: 'Jumlah Pengajuan Surat',
                                data: trenSurat.data,
                                fill: true,
                                backgroundColor: gradientTrenSurat,
                                borderColor: 'rgba(16, 185, 129, 1)',
                                borderWidth: 3,
                                tension: 0.4,
                                pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 3,
                                pointRadius: 6,
                                pointHoverRadius: 10,
                                pointHoverBackgroundColor: 'rgba(16, 185, 129, 1)',
                                pointHoverBorderWidth: 4
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
                                        font: { size: 12, weight: '600', family: 'Inter' }
                                    }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        color: '#6B7280',
                                        font: { size: 12, weight: '600', family: 'Inter' }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    padding: 16,
                                    cornerRadius: 12,
                                    titleFont: { size: 14, weight: 'bold', family: 'Inter' },
                                    bodyFont: { size: 13, family: 'Inter' },
                                    displayColors: false,
                                    callbacks: {
                                        label: function(context) {
                                            return 'Pengajuan: ' + context.parsed.y + ' surat';
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
                }
            }
        }
    </script>
</x-layout>