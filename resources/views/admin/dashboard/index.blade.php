<x-layout>
    <div x-data="adminDashboard()" x-init="initCharts()" class="p-6 bg-gradient-to-br from-indigo-50 to-blue-100 min-h-screen">
        <div class="mb-10">
            <h1 class="text-4xl font-extrabold text-indigo-900 tracking-tight">Dashboard Admin</h1>
            <p class="mt-3 text-lg text-indigo-700 font-medium">Selamat datang kembali, {{ Auth::user()->name }}! Lihat ringkasan aktivitas sistem dengan tampilan baru.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-indigo-100 transform hover:scale-105 transition-transform duration-300">
                <p class="text-sm font-semibold text-indigo-600">Jumlah Pengguna</p>
                <p class="text-3xl font-bold text-indigo-900 mt-2">{{ number_format($statistik['jumlah_pengguna']) }}</p>
                <p class="text-xs text-indigo-500 mt-1">Total akun terdaftar</p>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-teal-100 transform hover:scale-105 transition-transform duration-300">
                <p class="text-sm font-semibold text-teal-600">Total Surat Diarsipkan</p>
                <p class="text-3xl font-bold text-teal-900 mt-2">{{ number_format($statistik['jumlah_surat_masuk']) }}</p>
                <p class="text-xs text-teal-500 mt-1">Surat masuk terarsip</p>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-purple-100 transform hover:scale-105 transition-transform duration-300">
                <p class="text-sm font-semibold text-purple-600">Total Pengaduan</p>
                <p class="text-3xl font-bold text-purple-900 mt-2">{{ number_format($statistik['jumlah_pengaduan']) }}</p>
                <p class="text-xs text-purple-500 mt-1">Semua pengaduan</p>
            </div>
            <div class="bg-gradient-to-r from-yellow-400 to-orange-400 p-6 rounded-3xl shadow-lg border border-yellow-300 transform hover:scale-105 transition-transform duration-300">
                <p class="text-sm font-semibold text-white">Pengaduan Baru</p>
                <p class="text-3xl font-bold text-white mt-2">{{ number_format($statistik['pengaduan_baru']) }}</p>
                <p class="text-xs text-yellow-100 mt-1">Menunggu tindakan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-semibold text-indigo-900 mb-6">Populasi Penduduk per Wilayah</h3>
                <div class="relative">
                    <canvas x-ref="chartPenduduk" class="w-full"></canvas>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-semibold text-indigo-900 mb-6">Tren Pengajuan Surat (7 Hari Terakhir)</h3>
                <div class="relative">
                    <canvas x-ref="chartTrenSurat" class="w-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function adminDashboard() {
            return {
                initCharts() {
                    // Data dari Controller
                    const dataPenduduk = @json($dataPenduduk);
                    const trenSurat = @json($trenSurat);

                    // Inisialisasi Chart Penduduk
                    new Chart(this.$refs.chartPenduduk, {
                        type: 'bar',
                        data: {
                            labels: dataPenduduk.map(d => d.nama_wilayah),
                            datasets: [{
                                label: 'Jumlah Penduduk',
                                data: dataPenduduk.map(d => d.jumlah_penduduk),
                                backgroundColor: 'rgba(79, 70, 229, 0.6)', // Indigo
                                borderColor: 'rgba(79, 70, 229, 1)',
                                borderWidth: 1,
                                hoverBackgroundColor: 'rgba(79, 70, 229, 0.8)'
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                                x: { grid: { display: false } }
                            },
                            plugins: {
                                legend: { labels: { font: { size: 14, family: 'Inter' } } }
                            }
                        }
                    });

                    // Inisialisasi Chart Tren Surat
                    new Chart(this.$refs.chartTrenSurat, {
                        type: 'line',
                        data: {
                            labels: trenSurat.labels,
                            datasets: [{
                                label: 'Jumlah Pengajuan Surat',
                                data: trenSurat.data,
                                fill: true,
                                backgroundColor: 'rgba(16, 185, 129, 0.3)', // Emerald
                                borderColor: 'rgba(16, 185, 129, 1)',
                                tension: 0.4,
                                pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                                pointHoverRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                                x: { grid: { display: false } }
                            },
                            plugins: {
                                legend: { labels: { font: { size: 14, family: 'Inter' } } }
                            }
                        }
                    });
                }
            }
        }
    </script>
</x-layout>