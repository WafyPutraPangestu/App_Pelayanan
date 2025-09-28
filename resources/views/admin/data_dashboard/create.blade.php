{{-- 
    Ini adalah file Blade Laravel yang menggunakan Alpine.js untuk interaktivitas front-end.
    Layout ini menggunakan Tailwind CSS untuk styling.
--}}
<x-layout>
    {{-- 
        x-data mendefinisikan semua state (variabel) yang akan digunakan oleh Alpine.js
        di dalam komponen ini.
    --}}
    <div x-data="{
            {{-- 
                formData diinisialisasi dengan nilai 'old()' dari Laravel.
                Ini memastikan jika validasi gagal dan halaman di-refresh,
                input pengguna tidak akan hilang.
            --}}
            formData: {
                nama_wilayah: '{{ old('nama_wilayah', '') }}',
                jumlah_keluarga: '{{ old('jumlah_keluarga', '') }}',
                jumlah_penduduk: '{{ old('jumlah_penduduk', '') }}',
                jumlah_laki_laki: '{{ old('jumlah_laki_laki', '') }}',
                jumlah_perempuan: '{{ old('jumlah_perempuan', '') }}',
                anggaran_apbdes: '{{ old('anggaran_apbdes', '') }}',
                keterangan: '{{ old('keterangan', '') }}'
            },
            errors: {},
            isSubmitting: false,
            showToast: false,
            toastMessage: '',
            toastType: 'error',
            fileName: '',
            
            // Fungsi untuk validasi real-time di sisi client (front-end)
            validateField(field) {
                this.errors[field] = '';
                
                switch(field) {
                    case 'nama_wilayah':
                        if (!this.formData.nama_wilayah.trim()) {
                            this.errors.nama_wilayah = 'Nama wilayah harus diisi';
                        }
                        break;
                    case 'jumlah_keluarga':
                        if (!this.formData.jumlah_keluarga || this.formData.jumlah_keluarga < 0) {
                            this.errors.jumlah_keluarga = 'Jumlah keluarga harus diisi dan tidak boleh negatif';
                        }
                        break;
                    case 'jumlah_laki_laki':
                    case 'jumlah_perempuan':
                        // Validasi ini dijalankan jika kedua field sudah diisi
                        if (this.formData.jumlah_laki_laki === '' || this.formData.jumlah_perempuan === '') return;
                        
                        const totalGender = parseInt(this.formData.jumlah_laki_laki || 0) + parseInt(this.formData.jumlah_perempuan || 0);
                        const jumlahPenduduk = parseInt(this.formData.jumlah_penduduk || 0);

                        if (totalGender !== jumlahPenduduk) {
                            this.errors.jumlah_laki_laki = 'Total laki-laki + perempuan harus sama dengan jumlah penduduk';
                            this.errors.jumlah_perempuan = 'Total laki-laki + perempuan harus sama dengan jumlah penduduk';
                        } else {
                            this.errors.jumlah_laki_laki = '';
                            this.errors.jumlah_perempuan = '';
                        }
                        break;
                }
            },
            
            // Fungsi untuk menghitung otomatis jumlah penduduk
            updateTotalPenduduk() {
                if (this.formData.jumlah_laki_laki && this.formData.jumlah_perempuan) {
                    const total = parseInt(this.formData.jumlah_laki_laki) + parseInt(this.formData.jumlah_perempuan);
                    this.formData.jumlah_penduduk = total.toString();
                } else if (this.formData.jumlah_laki_laki) {
                    this.formData.jumlah_penduduk = this.formData.jumlah_laki_laki;
                } else if (this.formData.jumlah_perempuan) {
                    this.formData.jumlah_penduduk = this.formData.jumlah_perempuan;
                } else {
                    this.formData.jumlah_penduduk = '';
                }
            },

            // Fungsi untuk menangani upload file
            handleFileUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.fileName = file.name;
                    
                    // Validasi ukuran file (maks 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        this.errors.file_apbdes = 'Ukuran file maksimal 2MB';
                        event.target.value = '';
                        this.fileName = '';
                        return;
                    }
                    
                    // Validasi tipe file
                    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    if (!allowedTypes.includes(file.type)) {
                        this.errors.file_apbdes = 'Hanya file PDF, DOC, dan DOCX yang diizinkan';
                        event.target.value = '';
                        this.fileName = '';
                        return;
                    }
                    
                    this.errors.file_apbdes = '';
                }
            },

            // Fungsi untuk menghapus file yang dipilih
            clearFile() {
                const fileInput = document.getElementById('file_apbdes');
                fileInput.value = '';
                this.fileName = '';
                this.errors.file_apbdes = '';
            }
        }"
        {{-- 
            x-init dijalankan sekali saat komponen pertama kali dimuat.
            Ini digunakan untuk menampilkan Toast Notification jika ada error dari server.
        --}}
        x-init="
            @if($errors->any())
                showToast = true;
                toastMessage = 'Terdapat kesalahan dalam form, silakan periksa kembali';
                toastType = 'error';
                // PENYEBAB TOAST HILANG: setTimeout akan mengubah showToast menjadi false setelah 5 detik.
                // Ini adalah perilaku yang benar dan disengaja.
                setTimeout(() => showToast = false, 5000);
            @endif
        ">

        <div x-show="showToast" 
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-4 right-4 z-50 max-w-sm w-full">
            <div :class="{
                    'bg-white border-l-4 border-red-400': toastType === 'error',
                    'bg-white border-l-4 border-green-400': toastType === 'success'
                 }" 
                 class="rounded-lg shadow-lg p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg x-show="toastType === 'error'" class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <svg x-show="toastType === 'success'" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900" x-text="toastMessage"></p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button @click="showToast = false" class="inline-flex bg-white rounded-md p-1.5 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-6">
                <a href="{{ route('dataDashboard.index') }}" 
                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Data Wilayah</h1>
                <p class="text-gray-600">Tambahkan data wilayah baru untuk dashboard desa</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Wilayah</h3>
                    <p class="text-sm text-gray-600 mt-1">Masukkan data lengkap untuk wilayah baru</p>
                </div>

                <form action="{{ route('dataDashboard.store') }}" method="POST" enctype="multipart/form-data" @submit="isSubmitting = true" class="p-6 space-y-6">
                    @csrf
                    
                    <div class="space-y-2">
                        <label for="nama_wilayah" class="block text-sm font-medium text-gray-700">
                            Nama Wilayah <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="nama_wilayah" 
                                   name="nama_wilayah"
                                   x-model="formData.nama_wilayah"
                                   @blur="validateField('nama_wilayah')"
                                   placeholder="Contoh: RT 01/RW 02, Dusun Mawar"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama_wilayah') border-red-500 @enderror">
                            {{-- Icon tidak membutuhkan value --}}
                        </div>
                        {{-- Pesan error dari Laravel (untuk fallback jika JS mati) --}}
                        @error('nama_wilayah')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        {{-- Pesan error dari Alpine.js (untuk validasi real-time) --}}
                        <p x-show="errors.nama_wilayah" x-text="errors.nama_wilayah" class="text-sm text-red-600"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="jumlah_keluarga" class="block text-sm font-medium text-gray-700">
                                Jumlah Keluarga <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="jumlah_keluarga" 
                                   name="jumlah_keluarga"
                                   x-model="formData.jumlah_keluarga"
                                   @blur="validateField('jumlah_keluarga')"
                                   min="0"
                                   placeholder="0"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_keluarga') border-red-500 @enderror">
                            @error('jumlah_keluarga')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p x-show="errors.jumlah_keluarga" x-text="errors.jumlah_keluarga" class="text-sm text-red-600"></p>
                        </div>

                        <div class="space-y-2">
                            <label for="jumlah_penduduk" class="block text-sm font-medium text-gray-700">
                                Jumlah Penduduk
                            </label>
                            <input type="number" 
                                   id="jumlah_penduduk" 
                                   name="jumlah_penduduk"
                                   x-model="formData.jumlah_penduduk"
                                   readonly
                                   placeholder="Otomatis terisi"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_penduduk') border-red-500 @enderror">
                            @error('jumlah_penduduk')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500">Otomatis terisi dari jumlah laki-laki + perempuan</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="jumlah_laki_laki" class="block text-sm font-medium text-gray-700">
                                Jumlah Laki-laki <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="jumlah_laki_laki" 
                                   name="jumlah_laki_laki"
                                   x-model="formData.jumlah_laki_laki"
                                   @input="updateTotalPenduduk(); validateField('jumlah_laki_laki')"
                                   min="0"
                                   placeholder="0"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_laki_laki') border-red-500 @enderror">
                            @error('jumlah_laki_laki')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p x-show="errors.jumlah_laki_laki" x-text="errors.jumlah_laki_laki" class="text-sm text-red-600"></p>
                        </div>

                        <div class="space-y-2">
                            <label for="jumlah_perempuan" class="block text-sm font-medium text-gray-700">
                                Jumlah Perempuan <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="jumlah_perempuan" 
                                   name="jumlah_perempuan"
                                   x-model="formData.jumlah_perempuan"
                                   @input="updateTotalPenduduk(); validateField('jumlah_perempuan')"
                                   min="0"
                                   placeholder="0"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_perempuan') border-red-500 @enderror">
                            @error('jumlah_perempuan')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                             <p x-show="errors.jumlah_perempuan" x-text="errors.jumlah_perempuan" class="text-sm text-red-600"></p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="anggaran_apbdes" class="block text-sm font-medium text-gray-700">
                            Anggaran APBDes (Opsional)
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                            <input type="number" 
                                   id="anggaran_apbdes" 
                                   name="anggaran_apbdes"
                                   x-model="formData.anggaran_apbdes"
                                   step="1000"
                                   min="0"
                                   placeholder="0"
                                   class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('anggaran_apbdes') border-red-500 @enderror">
                        </div>
                        @error('anggaran_apbdes')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bagian Upload File APBDes -->
                    <div class="space-y-2">
                        <label for="file_apbdes" class="block text-sm font-medium text-gray-700">
                            File APBDes (Opsional)
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg transition-all duration-200 hover:border-blue-400 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500"
                             :class="{ 'border-red-500': errors.file_apbdes }">
                            <div class="space-y-1 text-center" x-show="!fileName">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file_apbdes" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload file</span>
                                        <input id="file_apbdes" name="file_apbdes" type="file" class="sr-only" @change="handleFileUpload($event)" accept=".pdf,.doc,.docx">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PDF, DOC, DOCX (maks. 2MB)
                                </p>
                            </div>
                            <div class="space-y-1 text-center" x-show="fileName">
                                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900" x-text="fileName"></p>
                                <button type="button" @click="clearFile()" class="text-sm text-red-600 hover:text-red-500">
                                    Hapus file
                                </button>
                            </div>
                        </div>
                        @error('file_apbdes')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p x-show="errors.file_apbdes" x-text="errors.file_apbdes" class="text-sm text-red-600"></p>
                    </div>

                    <div class="space-y-2">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">
                            Keterangan (Opsional)
                        </label>
                        <textarea id="keterangan" 
                                  name="keterangan"
                                  x-model="formData.keterangan"
                                  rows="4"
                                  placeholder="Catatan atau keterangan tambahan tentang wilayah ini..."
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('keterangan') border-red-500 @enderror"></textarea>
                        @error('keterangan')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                                :disabled="isSubmitting" 
                                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Data'"></span>
                        </button>
                        
                        <a href="{{ route('dataDashboard.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                           Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>