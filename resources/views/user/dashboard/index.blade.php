<x-layout>
    <div x-data="userDashboard()" x-init="initCharts()" class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
                <h1 class="text-3xl font-extrabold tracking-tight" x-text="'Selamat Datang, ' + '{{ Auth::user()->name }}'"></h1>
                <p class="mt-2 text-blue-100">Ringkasan informasi dan layanan untuk Anda.</p>
            </div>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <!-- Surat Siap Download Card -->
                <div class="bg-white rounded-2xl shadow-md p-6 transition-transform hover:scale-105 hover:shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Surat Siap Download</p>
                            <p class="text-3xl font-extrabold text-blue-600">{{ $infoUser['surat_siap_download'] }}</p>
                        </div>
                        <a href="{{ route('suratMasuk.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Lihat Surat
                        </a>
                    </div>
                </div>

                <!-- Pengaduan Terakhir Card -->
                <div class="bg-white rounded-2xl shadow-md p-6 transition-transform hover:scale-105 hover:shadow-lg border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Status Pengaduan Terakhir</p>
                    <div class="flex items-center justify-between mt-2">
                        @if($infoUser['pengaduan_terakhir'])
                            <p class="text-lg font-semibold text-gray-900">{{ Str::limit($infoUser['pengaduan_terakhir']->judul, 25) }}</p>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($infoUser['pengaduan_terakhir']->status == 'baru') bg-yellow-100 text-yellow-800
                                @elseif($infoUser['pengaduan_terakhir']->status == 'diproses') bg-orange-100 text-orange-800
                                @elseif($infoUser['pengaduan_terakhir']->status == 'selesai') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($infoUser['pengaduan_terakhir']->status) }}
                            </span>
                        @else
                            <p class="text-gray-500 italic">Belum ada pengaduan.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kependudukan Section -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kependudukan Desa</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Populasi Penduduk Chart -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Populasi Penduduk per Wilayah</h3>
                        <div class="relative w-full" style="height: 400px;">
                            <canvas x-ref="chartPenduduk" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Jumlah Keluarga & Gender -->
                <div class="space-y-8">
                    <!-- Jumlah Keluarga Card -->
                    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Jumlah Keluarga</h3>
                        <p class="text-4xl font-extrabold text-gray-900">{{ number_format($jumlahKeluarga) }}</p>
                        <p class="text-gray-500 text-sm mt-2">Total Kepala Keluarga</p>
                    </div>

                    <!-- Komposisi Gender Chart -->
                    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Komposisi Gender</h3>
                        <div class="relative w-full" style="height: 300px;">
                            <canvas x-ref="chartGender" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function userDashboard() {
            return {
                initCharts() {
                    // Data dari Controller
                    const dataPenduduk = @json($dataPenduduk);
                    const dataGender = @json($dataGender);

                    // Inisialisasi Chart Penduduk
                    new Chart(this.$refs.chartPenduduk, {
                        type: 'bar',
                        data: {
                            labels: dataPenduduk.map(d => d.nama_wilayah),
                            datasets: [{
                                label: 'Jumlah Penduduk',
                                data: dataPenduduk.map(d => d.jumlah_penduduk),
                                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                                borderColor: 'rgba(59, 130, 246, 1)',
                                borderWidth: 1,
                                borderRadius: 8,
                                barThickness: 20
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                    ticks: { color: '#4B5563' }
                                },
                                x: { ticks: { color: '#4B5563' } }
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#1F2937',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    padding: 12,
                                    cornerRadius: 8
                                }
                            },
                            animation: {
                                duration: 1000,
                                easing: 'easeOutQuart'
                            }
                        }
                    });

                    // Inisialisasi Chart Gender
                    new Chart(this.$refs.chartGender, {
                        type: 'pie',
                        data: {
                            labels: dataGender.labels,
                            datasets: [{
                                label: 'Jumlah',
                                data: dataGender.data,
                                backgroundColor: ['rgba(59, 130, 246, 0.7)', 'rgba(236, 72, 153, 0.7)'],
                                borderColor: ['rgba(59, 130, 246, 1)', 'rgba(236, 72, 153, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        color: '#4B5563',
                                        font: { size: 14, weight: '500' }
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
                                            return label + value + ' (' + percentage + ')';
                                        }
                                    },
                                    backgroundColor: '#1F2937',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    padding: 12,
                                    cornerRadius: 8
                                }
                            },
                            animation: {
                                duration: 1000,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                }
            }
        }
    </script>
</x-layout>