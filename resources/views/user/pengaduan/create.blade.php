<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-8" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
                <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Buat Pengaduan Baru</h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Sampaikan aspirasi dan keluhan Anda. Kami akan menindaklanjuti setiap pengaduan dengan serius dan transparan.
                    </p>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden" x-data="formHandler()">
                <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Form Pengaduan
                    </h2>
                </div>

                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8" @submit="handleSubmit">
                    @csrf

                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-blue-600">Progress Pengisian</span>
                            <span class="text-sm font-medium text-blue-600" x-text="Math.round(progress) + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-500 ease-out" :style="`width: ${progress}%`"></div>
                        </div>
                    </div>

                    <!-- Judul Pengaduan -->
                    <div x-data="{ focused: false }">
                        <label for="judul" class="block text-sm font-semibold text-gray-900 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                                Judul Pengaduan
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul') }}"
                                   x-model="formData.judul"
                                   @focus="focused = true" 
                                   @blur="focused = false"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('judul') border-red-500 @enderror"
                                   placeholder="Contoh: telat respon..."
                                   maxlength="255">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <div :class="{ 'text-green-500': formData.judul.length >= 5, 'text-gray-400': formData.judul.length < 5 }" class="text-xs">
                                    <span x-text="formData.judul.length"></span>/255
                                </div>
                            </div>
                        </div>
                        @error('judul')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                        <div x-show="focused" x-transition class="mt-2 text-xs text-gray-500">
                            💡 Berikan judul yang jelas dan deskriptif minimal 5 karakter
                        </div>
                    </div>

                    <!-- Jenis Layanan (Category) -->
                    @php
                        // Definisikan variabel di sini untuk memastikan variabel selalu ada
                        $mainCategories = ['pelayanan administrasi', 'pelayanan umum'];
                    @endphp
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                Jenis Layanan
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($mainCategories as $cat)
                            <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-400 transition-all duration-200"
                                   :class="{ 'bg-blue-100 border-blue-500 ring-2 ring-blue-300': formData.category === '{{ $cat }}' }">
                                <input type="radio" name="category" value="{{ $cat }}" x-model="formData.category" class="hidden">
                                <div class="ml-2 text-sm font-medium text-gray-800">{{ ucwords($cat) }}</div>
                            </label>
                            @endforeach
                        </div>
                        @error('category')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div x-data="{ focused: false }">
                        <label for="kategori" class="block text-sm font-semibold text-gray-900 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Kategori Pengaduan
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <select id="kategori" 
                                name="kategori" 
                                x-model="formData.kategori"
                                @focus="focused = true" 
                                @blur="focused = false"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('kategori') border-red-500 @enderror">
                            <option value="">Pilih kategori pengaduan...</option>
                            @foreach($categories as $key => $description)
                            <option value="{{ $key }}" {{ old('kategori') == $key ? 'selected' : '' }}>
                                {{ $key }} - {{ $description }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                        <div x-show="focused && formData.kategori" x-transition class="mt-2 text-xs text-green-600">
                            ✓ Kategori dipilih
                        </div>
                    </div>

                    <!-- Isi Pengaduan -->
                    <div x-data="{ focused: false, wordCount: 0 }" x-init="wordCount = formData.isi_pengaduan.length">
                        <label for="isi_pengaduan" class="block text-sm font-semibold text-gray-900 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                                Isi Pengaduan
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div class="relative">
                            <textarea id="isi_pengaduan" 
                                      name="isi_pengaduan" 
                                      rows="6"
                                      x-model="formData.isi_pengaduan"
                                      @input="wordCount = $event.target.value.length"
                                      @focus="focused = true" 
                                      @blur="focused = false"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none @error('isi_pengaduan') border-red-500 @enderror"
                                      placeholder="Jelaskan detail pengaduan Anda dengan lengkap dan jelas...">{{ old('isi_pengaduan') }}</textarea>
                            <div class="absolute bottom-3 right-3">
                                <div :class="{ 'text-green-500': wordCount >= 20, 'text-red-400': wordCount < 20 && wordCount > 0, 'text-gray-400': wordCount == 0 }" class="text-xs">
                                    <span x-text="wordCount"></span> karakter
                                </div>
                            </div>
                        </div>
                        @error('isi_pengaduan')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                        <div x-show="focused" x-transition class="mt-2 text-xs text-gray-500">
                            💡 Jelaskan secara detail: apa yang terjadi, dimana lokasinya, kapan kejadian, dan dampak yang dirasakan (minimal 20 karakter)
                        </div>
                    </div>

                    <!-- Upload Lampiran -->
                    <div x-data="{ 
                            dragover: false, 
                            fileName: '', 
                            fileSize: '',
                            handleDrop(e) {
                                this.dragover = false;
                                const files = e.dataTransfer.files;
                                if (files.length > 0) {
                                    this.handleFileSelect(files[0]);
                                }
                            },
                            handleFileSelect(file) {
                                if (file) {
                                    this.fileName = file.name;
                                    this.fileSize = this.formatFileSize(file.size);
                                }
                            },
                            formatFileSize(bytes) {
                                if (bytes === 0) return '0 Bytes';
                                const k = 1024;
                                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                                const i = Math.floor(Math.log(bytes) / Math.log(k));
                                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                            }
                        }">
                        <label class="block text-sm font-semibold text-gray-900 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 00-5.656-5.656l-6.586 6.586a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                Lampiran (Opsional)
                            </span>
                        </label>
                        
                        <div class="relative">
                            <div @drop.prevent="handleDrop"
                                 @dragover.prevent="dragover = true"
                                 @dragleave.prevent="dragover = false"
                                 :class="{ 'border-blue-400 bg-blue-50': dragover }"
                                 class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-200">
                                
                                <input type="file" 
                                       id="lampiran" 
                                       name="lampiran" 
                                       accept=".jpeg,.jpg,.png,.pdf,.doc,.docx"
                                       class="hidden"
                                       @change="handleFileSelect($event.target.files[0])">
                                
                                <div x-show="!fileName">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <div class="mt-4">
                                        <label for="lampiran" class="cursor-pointer">
                                            <span class="mt-2 block text-sm font-medium text-gray-900">
                                                Drop files here or 
                                                <span class="text-blue-600 hover:text-blue-700">browse</span>
                                            </span>
                                        </label>
                                        <p class="mt-2 text-xs text-gray-500">
                                            PNG, JPG, PDF, DOC, DOCX up to 2MB
                                        </p>
                                    </div>
                                </div>
                                
                                <div x-show="fileName" class="flex items-center justify-center">
                                    <div class="flex items-center bg-white rounded-lg p-3 shadow-sm border">
                                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate" x-text="fileName"></p>
                                            <p class="text-xs text-gray-500" x-text="fileSize"></p>
                                        </div>
                                        <button type="button" @click="fileName = ''; fileSize = ''; document.getElementById('lampiran').value = ''" class="ml-3 text-red-500 hover:text-red-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @error('lampiran')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                        <button type="submit" 
                                :disabled="!isFormValid"
                                :class="{ 'opacity-50 cursor-not-allowed': !isFormValid }"
                                class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:hover:scale-100 disabled:hover:shadow-lg">
                            <svg x-show="!submitting" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <svg x-show="submitting" class="w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="submitting ? 'Mengirim...' : 'Kirim Pengaduan'"></span>
                        </button>
                        
                        <a href="{{ route('pengaduan.index') }}" 
                           class="flex-1 sm:flex-none inline-flex justify-center items-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function formHandler() {
            return {
                submitting: false,
                formData: {
                    judul: '{{ old("judul") }}',
                    category: '{{ old("category") }}',
                    kategori: '{{ old("kategori") }}',
                    isi_pengaduan: `{!! old("isi_pengaduan") !!}`
                },
                
                get progress() {
                    let completed = 0;
                    let total = 4; // judul, category, kategori, isi_pengaduan
                    
                    if (this.formData.judul.length >= 5) completed++;
                    if (this.formData.category) completed++;
                    if (this.formData.kategori) completed++;
                    if (this.formData.isi_pengaduan.length >= 20) completed++;
                    
                    return (completed / total) * 100;
                },
                
                get isFormValid() {
                    return this.formData.judul.length >= 5 && 
                           this.formData.category && 
                           this.formData.kategori && 
                           this.formData.isi_pengaduan.length >= 20;
                },
                
                handleSubmit(e) {
                    if (!this.isFormValid) {
                        e.preventDefault();
                        return;
                    }
                    this.submitting = true;
                }
            }
        }
    </script>
</x-layout>

