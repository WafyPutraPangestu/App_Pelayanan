<x-layout>
    <div x-data="beritaEditForm()" x-init="init()">
        <!-- Toast Notification -->
        <div x-show="showToast" 
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg x-show="toastType === 'success'" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="toastType === 'error'" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900" x-text="toastMessage"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="showToast = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Berita</h1>
                    <p class="mt-2 text-sm text-gray-600">Perbarui informasi berita yang akan dipublikasikan</p>
                </div>
                <a href="{{ route('berita.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="max-w-4xl">
            <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data" @submit="onSubmit">
                @csrf
                @method('PUT')
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Berita</h3>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita *</label>
                            <input 
                                type="text" 
                                name="judul" 
                                id="judul" 
                                x-model="form.judul"
                                @input="generateSlug"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('judul') border-red-300 ring-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="Masukkan judul berita..."
                                value="{{ old('judul', $berita->judul) }}"
                                required>
                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Slug: <span x-text="form.slug" class="font-mono text-indigo-600"></span></p>
                        </div>

                        <!-- Ringkasan -->
                        <div>
                            <label for="ringkasan" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan *</label>
                            <textarea 
                                name="ringkasan" 
                                id="ringkasan" 
                                rows="3"
                                x-model="form.ringkasan"
                                @input="updateCharCount"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('ringkasan') border-red-300 ring-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="Tuliskan ringkasan singkat berita..."
                                maxlength="500"
                                required>{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                            @error('ringkasan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                <span x-text="form.ringkasan.length"></span>/500 karakter
                            </p>
                        </div>

                        <!-- Konten -->
                        <div>
                            <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita *</label>
                            <textarea 
                                name="konten" 
                                id="konten" 
                                rows="10"
                                x-model="form.konten"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('konten') border-red-300 ring-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="Tuliskan konten lengkap berita..."
                                required>{{ old('konten', $berita->konten) }}</textarea>
                            @error('konten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Gambar -->
                        <div>
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar Berita</label>
                            
                            <!-- Gambar Saat Ini -->
                            @if($berita->gambar)
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg border">
                                <p class="text-sm text-gray-700 mb-2">Gambar saat ini:</p>
                                <div class="flex items-start space-x-4">
                                    <img src="{{ Storage::url($berita->gambar) }}" alt="Current Image" class="w-32 h-24 object-cover rounded-lg">
                                    <div>
                                        <p class="text-sm text-gray-600">{{ basename($berita->gambar) }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Upload gambar baru untuk mengganti yang lama</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors duration-200" 
                                 x-data="imageUpload()"
                                 @drop.prevent="handleDrop"
                                 @dragover.prevent
                                 @dragenter.prevent>
                                <div class="space-y-1 text-center">
                                    <div x-show="!preview">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload file baru</span>
                                                <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" @change="handleFileSelect">
                                            </label>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                        @if(!$berita->gambar)
                                            <p class="text-xs text-gray-500">Tidak ada gambar saat ini</p>
                                        @endif
                                    </div>
                                    
                                    <div x-show="preview" class="relative">
                                        <img :src="preview" class="mx-auto h-32 w-auto rounded-lg object-cover">
                                        <button type="button" @click="removeImage" class="absolute -top-2 -right-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-full p-1 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                        <p class="text-sm text-gray-600 mt-2" x-text="fileName"></p>
                                    </div>
                                </div>
                            </div>
                            @error('gambar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status dan Tanggal Publikasi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="dipublikasikan" class="block text-sm font-medium text-gray-700 mb-2">Status Publikasi *</label>
                                <select 
                                    name="dipublikasikan" 
                                    id="dipublikasikan"
                                    x-model="form.dipublikasikan"
                                    @change="togglePublishDate"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('dipublikasikan') border-red-300 ring-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
                                    <option value="0" {{ old('dipublikasikan', $berita->dipublikasikan) == '0' ? 'selected' : '' }}>Draft</option>
                                    <option value="1" {{ old('dipublikasikan', $berita->dipublikasikan) == '1' ? 'selected' : '' }}>Publikasikan</option>
                                </select>
                                @error('dipublikasikan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div x-show="form.dipublikasikan == '1'" x-transition>
                                <label for="tanggal_publikasi" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                                <input 
                                    type="datetime-local" 
                                    name="tanggal_publikasi" 
                                    id="tanggal_publikasi"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('tanggal_publikasi') border-red-300 ring-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                    value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('Y-m-d\TH:i') : '') }}">
                                @error('tanggal_publikasi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Kosongkan untuk menggunakan waktu saat ini</p>
                            </div>
                        </div>

                        <!-- Info Terakhir Diupdate -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Informasi Update</h3>
                                    <div class="mt-1 text-sm text-blue-700">
                                        <p>Dibuat: {{ $berita->created_at->format('d M Y, H:i') }} oleh {{ $berita->user->name ?? 'Admin' }}</p>
                                        @if($berita->updated_at != $berita->created_at)
                                        <p>Terakhir diupdate: {{ $berita->updated_at->format('d M Y, H:i') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button type="button" 
                                    @click="previewContent" 
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Preview
                            </button>

                            @if($berita->slug)
                            <a href="{{ route('berita.show', $berita) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Lihat Detail
                            </a>
                            @endif
                        </div>

                        <div class="flex items-center space-x-3">
                            <a href="{{ route('berita.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    :disabled="isSubmitting"
                                    :class="isSubmitting ? 'opacity-50 cursor-not-allowed' : ''"
                                    class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-text="isSubmitting ? 'Menyimpan...' : 'Update Berita'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Preview Modal -->
        <div x-show="showPreview" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Preview Berita</h3>
                            <button @click="showPreview = false" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <div class="prose max-w-none">
                                <h1 x-text="form.judul || 'Judul Berita'"></h1>
                                <p class="text-gray-600 italic" x-text="form.ringkasan || 'Ringkasan berita'"></p>
                                <div class="whitespace-pre-wrap" x-text="form.konten || 'Konten berita'"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="showPreview = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function imageUpload() {
            return {
                preview: null,
                fileName: '',

                handleFileSelect(event) {
                    this.processFile(event.target.files[0]);
                },

                handleDrop(event) {
                    const file = event.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        this.processFile(file);
                        // Update the file input
                        const fileInput = document.getElementById('gambar');
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                    }
                },

                processFile(file) {
                    if (!file) return;
                    
                    this.fileName = file.name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.preview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                removeImage() {
                    this.preview = null;
                    this.fileName = '';
                    document.getElementById('gambar').value = '';
                }
            }
        }

        function beritaEditForm() {
            return {
                showToast: false,
                toastMessage: '',
                toastType: 'success',
                isSubmitting: false,
                showPreview: false,
                form: {
                    judul: '{{ old("judul", $berita->judul) }}',
                    slug: '{{ old("slug", $berita->slug) }}',
                    ringkasan: '{{ old("ringkasan", $berita->ringkasan) }}',
                    konten: '{{ old("konten", $berita->konten) }}',
                    dipublikasikan: '{{ old("dipublikasikan", $berita->dipublikasikan) }}'
                },

                init() {
                    // Check for validation errors
                    @if($errors->any())
                        this.showToastMessage('Terdapat kesalahan dalam form. Silakan periksa kembali.', 'error');
                    @endif

                    // Initialize form data
                    this.form.judul = document.getElementById('judul').value;
                    this.form.ringkasan = document.getElementById('ringkasan').value;
                    this.form.konten = document.getElementById('konten').value;
                },

                generateSlug() {
                    this.form.slug = this.form.judul
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim('-');
                },

                updateCharCount() {
                    // Character count is automatically handled by x-model
                },

                togglePublishDate() {
                    // Auto-handled by Alpine's reactivity
                },

                previewContent() {
                    if (!this.form.judul.trim()) {
                        this.showToastMessage('Judul harus diisi untuk preview.', 'error');
                        return;
                    }
                    this.showPreview = true;
                },

                onSubmit() {
                    this.isSubmitting = true;
                },

                showToastMessage(message, type = 'success') {
                    this.toastMessage = message;
                    this.toastType = type;
                    this.showToast = true;
                    setTimeout(() => {
                        this.showToast = false;
                    }, 5000);
                }
            }
        }
    </script>
</x-layout>