<x-layout>
    <div x-data="{
        formData: {
            nama_wilayah: '{{ old('nama_wilayah', $dataDashboard->nama_wilayah) }}',
            jumlah_keluarga: '{{ old('jumlah_keluarga', $dataDashboard->jumlah_keluarga) }}',
            jumlah_penduduk: '{{ old('jumlah_penduduk', $dataDashboard->jumlah_penduduk) }}',
            jumlah_laki_laki: '{{ old('jumlah_laki_laki', $dataDashboard->jumlah_laki_laki) }}',
            jumlah_perempuan: '{{ old('jumlah_perempuan', $dataDashboard->jumlah_perempuan) }}',
            anggaran_apbdes: '{{ old('anggaran_apbdes', $dataDashboard->anggaran_apbdes) }}',
            keterangan: '{{ old('keterangan', $dataDashboard->keterangan) }}'
        },
        errors: {},
        isSubmitting: false,
        showToast: false,
        toastMessage: '',
        toastType: 'error',
        fileName: '',
        filePreview: null,
        
        // Validasi real-time
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
                    if (this.formData.jumlah_laki_laki === '' || this.formData.jumlah_perempuan === '') return;
                    const totalGender = parseInt(this.formData.jumlah_laki_laki) + parseInt(this.formData.jumlah_perempuan);
                    if (this.formData.jumlah_penduduk && totalGender !== parseInt(this.formData.jumlah_penduduk)) {
                        this.errors.jumlah_laki_laki = 'Total laki-laki + perempuan harus sama dengan jumlah penduduk';
                        this.errors.jumlah_perempuan = 'Total laki-laki + perempuan harus sama dengan jumlah penduduk';
                    } else {
                        this.errors.jumlah_laki_laki = '';
                        this.errors.jumlah_perempuan = '';
                    }
                    break;
            }
        },
        
        // Auto update jumlah penduduk
        updateTotalPenduduk() {
            if (this.formData.jumlah_laki_laki && this.formData.jumlah_perempuan) {
                const total = parseInt(this.formData.jumlah_laki_laki) + parseInt(this.formData.jumlah_perempuan);
                this.formData.jumlah_penduduk = total.toString();
            }
        },
        
        // Format currency input
        formatCurrency(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        },
        
        // Handle file selection
        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.fileName = file.name;
                
                // Validasi tipe file
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                if (!allowedTypes.includes(file.type)) {
                    this.errors.file_apbdes = 'Hanya file PDF, DOC, dan DOCX yang diizinkan';
                    event.target.value = '';
                    this.fileName = '';
                    return;
                }
                
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    this.errors.file_apbdes = 'Ukuran file maksimal 2MB';
                    event.target.value = '';
                    this.fileName = '';
                    return;
                }
                
                this.errors.file_apbdes = '';
                
                // Preview untuk PDF
                if (file.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.filePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.filePreview = null;
                }
            }
        },
        
        // Clear file selection
        clearFile() {
            const fileInput = document.getElementById('file_apbdes');
            fileInput.value = '';
            this.fileName = '';
            this.filePreview = null;
            this.errors.file_apbdes = '';
        }
    }"
    x-init="
        @if($errors->any())
            showToast = true;
            toastMessage = 'Terdapat kesalahan dalam form';
            toastType = 'error';
            setTimeout(() => showToast = false, 5000);
        @endif
    ">

        <!-- Toast Notification -->
        <div x-show="showToast" 
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-4 right-4 z-50">
            <div :class="{
                'bg-white border-l-4 border-red-400': toastType === 'error',
                'bg-white border-l-4 border-green-400': toastType === 'success'
            }" 
            class="rounded-lg shadow-lg p-4 max-w-sm">
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
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="showToast = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Data Wilayah</h1>
                <p class="text-gray-600">Perbarui informasi data wilayah <strong>{{ $dataDashboard->nama_wilayah }}</strong></p>
            </div>
        </div>

        <!-- Form Container -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Wilayah</h3>
                    <p class="text-sm text-gray-600 mt-1">Ubah data yang diperlukan</p>
                </div>

                <form action="{{ route('dataDashboard.update', $dataDashboard->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Wilayah -->
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
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama_wilayah') border-red-500 @enderror"
                                   value="{{ old('nama_wilayah', $dataDashboard->nama_wilayah) }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                        </div>
                        @error('nama_wilayah')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p x-show="errors.nama_wilayah" x-text="errors.nama_wilayah" class="text-sm text-red-600"></p>
                    </div>

                    <!-- Grid untuk data numerik -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jumlah Keluarga -->
                        <div class="space-y-2">
                            <label for="jumlah_keluarga" class="block text-sm font-medium text-gray-700">
                                Jumlah Keluarga <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       id="jumlah_keluarga" 
                                       name="jumlah_keluarga"
                                       x-model="formData.jumlah_keluarga"
                                       @blur="validateField('jumlah_keluarga')"
                                       min="0"
                                       placeholder="0"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_keluarga') border-red-500 @enderror"
                                       value="{{ old('jumlah_keluarga', $dataDashboard->jumlah_keluarga) }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('jumlah_keluarga')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p x-show="errors.jumlah_keluarga" x-text="errors.jumlah_keluarga" class="text-sm text-red-600"></p>
                        </div>

                        <!-- Jumlah Penduduk -->
                        <div class="space-y-2">
                            <label for="jumlah_penduduk" class="block text-sm font-medium text-gray-700">
                                Jumlah Penduduk <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       id="jumlah_penduduk" 
                                       name="jumlah_penduduk"
                                       x-model="formData.jumlah_penduduk"
                                       min="0"
                                       readonly
                                       placeholder="0"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_penduduk') border-red-500 @enderror"
                                       value="{{ old('jumlah_penduduk', $dataDashboard->jumlah_penduduk) }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a1.5 1.5 0 01-3 0V5.5a1.5 1.5 0 013 0V8z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('jumlah_penduduk')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500">Otomatis terisi dari jumlah laki-laki + perempuan</p>
                        </div>
                    </div>

                    <!-- Grid untuk gender -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jumlah Laki-laki -->
                        <div class="space-y-2">
                            <label for="jumlah_laki_laki" class="block text-sm font-medium text-gray-700">
                                Jumlah Laki-laki <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       id="jumlah_laki_laki" 
                                       name="jumlah_laki_laki"
                                       x-model="formData.jumlah_laki_laki"
                                       @input="updateTotalPenduduk(); validateField('jumlah_laki_laki')"
                                       min="0"
                                       placeholder="0"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_laki_laki') border-red-500 @enderror"
                                       value="{{ old('jumlah_laki_laki', $dataDashboard->jumlah_laki_laki) }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-blue-500 font-semibold">♂</span>
                                </div>
                            </div>
                            @error('jumlah_laki_laki')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p x-show="errors.jumlah_laki_laki" x-text="errors.jumlah_laki_laki" class="text-sm text-red-600"></p>
                        </div>

                        <!-- Jumlah Perempuan -->
                        <div class="space-y-2">
                            <label for="jumlah_perempuan" class="block text-sm font-medium text-gray-700">
                                Jumlah Perempuan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       id="jumlah_perempuan" 
                                       name="jumlah_perempuan"
                                       x-model="formData.jumlah_perempuan"
                                       @input="updateTotalPenduduk(); validateField('jumlah_perempuan')"
                                       min="0"
                                       placeholder="0"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jumlah_perempuan') border-red-500 @enderror"
                                       value="{{ old('jumlah_perempuan', $dataDashboard->jumlah_perempuan) }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-pink-500 font-semibold">♀</span>
                                </div>
                            </div>
                            @error('jumlah_perempuan')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p x-show="errors.jumlah_perempuan" x-text="errors.jumlah_perempuan" class="text-sm text-red-600"></p>
                        </div>
                    </div>

                    <!-- Anggaran APBDes -->
                    <div class="space-y-2">
                        <label for="anggaran_apbdes" class="block text-sm font-medium text-gray-700">
                            Anggaran APBDes
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                            <input type="number" 
                                   id="anggaran_apbdes" 
                                   name="anggaran_apbdes"
                                   x-model="formData.anggaran_apbdes"
                                   step="0.01"
                                   min="0"
                                   placeholder="0"
                                   class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('anggaran_apbdes') border-red-500 @enderror"
                                   value="{{ old('anggaran_apbdes', $dataDashboard->anggaran_apbdes) }}">
                        </div>
                        @error('anggaran_apbdes')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Opsional - Dana APBDes yang dialokasikan untuk wilayah ini</p>
                    </div>

                    <!-- File APBDes -->
                    <div class="space-y-4">
                        <div>
                            <label for="file_apbdes" class="block text-sm font-medium text-gray-700">
                                File APBDes
                            </label>
                            <p class="text-xs text-gray-500 mb-3">Upload file APBDes (PDF, DOC, DOCX) maksimal 2MB</p>
                            
                            <!-- File Upload Area -->
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg transition-colors duration-200 hover:border-blue-400"
                                 :class="{ 'border-blue-400': fileName }">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    
                                    <div class="flex flex-col items-center justify-center text-sm text-gray-600">
                                        <label for="file_apbdes" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload file</span>
                                            <input id="file_apbdes" name="file_apbdes" type="file" class="sr-only" @change="handleFileSelect($event)" accept=".pdf,.doc,.docx">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    
                                    <!-- Selected File Info -->
                                    <div x-show="fileName" class="mt-4">
                                        <div class="flex items-center justify-between bg-blue-50 border border-blue-200 rounded-lg p-3">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900" x-text="fileName"></p>
                                                    <p class="text-xs text-gray-500">Klik untuk mengganti file</p>
                                                </div>
                                            </div>
                                            <button type="button" @click="clearFile()" class="text-red-500 hover:text-red-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <p class="text-xs text-gray-500" x-show="!fileName">
                                        PDF, DOC, DOCX up to 2MB
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        @error('file_apbdes')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p x-show="errors.file_apbdes" x-text="errors.file_apbdes" class="text-sm text-red-600"></p>
                        
                        <!-- Current File Info -->
                        @if($dataDashboard->file_apbdes)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-green-800">File saat ini:</p>
                                        <p class="text-sm text-green-700">{{ basename($dataDashboard->file_apbdes) }}</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::disk('public')->url($dataDashboard->file_apbdes) }}" 
                                   target="_blank" 
                                   class="inline-flex items-center px-3 py-1 border border-green-300 text-sm leading-5 font-medium rounded-full text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat
                                </a>
                            </div>
                            <p class="text-xs text-green-600 mt-2">Upload file baru akan mengganti file yang sudah ada</p>
                        </div>
                        @endif
                    </div>

                    <!-- Keterangan -->
                    <div class="space-y-2">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">
                            Keterangan
                        </label>
                        <textarea id="keterangan" 
                                  name="keterangan"
                                  x-model="formData.keterangan"
                                  rows="4"
                                  placeholder="Catatan atau keterangan tambahan tentang wilayah ini..."
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $dataDashboard->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3 text-sm">
                                <h3 class="text-blue-800 font-medium">Data Lama</h3>
                                <div class="text-blue-700 mt-2 grid grid-cols-2 gap-2">
                                    <div>
                                        <span class="font-medium">Keluarga:</span> {{ number_format($dataDashboard->jumlah_keluarga) }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Penduduk:</span> {{ number_format($dataDashboard->jumlah_penduduk) }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Laki-laki:</span> {{ number_format($dataDashboard->jumlah_laki_laki) }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Perempuan:</span> {{ number_format($dataDashboard->jumlah_perempuan) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                                :disabled="isSubmitting" 
                                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg x-show="!isSubmitting" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Perbarui Data'"></span>
                        </button>
                        
                        <a href="{{ route('dataDashboard.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>