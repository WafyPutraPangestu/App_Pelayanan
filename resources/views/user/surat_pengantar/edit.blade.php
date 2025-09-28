<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center tracking-tight animate-fade-in-down">
                Edit Surat Pengantar
            </h1>

            <div class="bg-white bg-opacity-90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-gray-100 transform transition-all duration-500 hover:scale-[1.01]">
                <form action="{{ route('surat_pengantar.update', $surat_pengantar->id) }}" method="POST" x-data="{ submitting: false }">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div x-data="{ focused: false }" class="relative">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Nama Lengkap</label>
                            <input 
                                type="text" 
                                id="nama" 
                                name="nama" 
                                value="{{ old('nama', $surat_pengantar->nama) }}" 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900 placeholder-gray-400"
                                placeholder="Sesuai KTP"
                                @focus="focused = true"
                                @blur="focused = false"
                            >
                            @error('nama') 
                                <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div x-data="{ focused: false }" class="relative">
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">NIK</label>
                            <input 
                                type="text" 
                                id="nik" 
                                name="nik" 
                                value="{{ old('nik', $surat_pengantar->nik) }}" 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900 placeholder-gray-400"
                                placeholder="16 digit NIK"
                                @focus="focused = true"
                                @blur="focused = false"
                            >
                            @error('nik') 
                                <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div x-data="{ focused: false }" class="relative">
                                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Tempat Lahir</label>
                                <input 
                                    type="text" 
                                    id="tempat_lahir" 
                                    name="tempat_lahir" 
                                    value="{{ old('tempat_lahir', $surat_pengantar->tempat_lahir) }}" 
                                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900"
                                    @focus="focused = true"
                                    @blur="focused = false"
                                >
                                @error('tempat_lahir') 
                                    <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div x-data="{ focused: false }" class="relative">
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Tanggal Lahir</label>
                                <input 
                                    type="date" 
                                    id="tanggal_lahir" 
                                    name="tanggal_lahir" 
                                    value="{{ old('tanggal_lahir', $surat_pengantar->tanggal_lahir->format('Y-m-d')) }}" 
                                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900"
                                    @focus="focused = true"
                                    @blur="focused = false"
                                >
                                @error('tanggal_lahir') 
                                    <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div x-data="{ focused: false }" class="relative">
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Jenis Kelamin</label>
                                <select 
                                    id="jenis_kelamin" 
                                    name="jenis_kelamin" 
                                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900"
                                    @focus="focused = true"
                                    @blur="focused = false"
                                >
                                    <option value="Laki-laki" @selected(old('jenis_kelamin', $surat_pengantar->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                                    <option value="Perempuan" @selected(old('jenis_kelamin', $surat_pengantar->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') 
                                    <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div x-data="{ focused: false }" class="relative">
                                <label for="agama" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Agama</label>
                                <input 
                                    type="text" 
                                    id="agama" 
                                    name="agama" 
                                    value="{{ old('agama', $surat_pengantar->agama) }}" 
                                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900"
                                    @focus="focused = true"
                                    @blur="focused = false"
                                >
                                @error('agama') 
                                    <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>
                        <div x-data="{ focused: false }" class="relative">
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Pekerjaan</label>
                            <input 
                                type="text" 
                                id="pekerjaan" 
                                name="pekerjaan" 
                                value="{{ old('pekerjaan', $surat_pengantar->pekerjaan) }}" 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900"
                                @focus="focused = true"
                                @blur="focused = false"
                            >
                            @error('pekerjaan') 
                                <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="md:col-span-2" x-data="{ focused: false }">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Alamat Lengkap</label>
                            <textarea 
                                id="alamat" 
                                name="alamat" 
                                rows="3" 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900 resize-none"
                                @focus="focused = true"
                                @blur="focused = false"
                            >{{ old('alamat', $surat_pengantar->alamat) }}</textarea>
                            @error('alamat') 
                                <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="md:col-span-2" x-data="{ focused: false }">
                            <label for="maksud_dan_tujuan" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300" :class="{ 'scale-95 opacity-70': focused }">Maksud dan Tujuan</label>
                            <textarea 
                                id="maksud_dan_tujuan" 
                                name="maksud_dan_tujuan" 
                                rows="3" 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900 resize-none"
                                placeholder="Contoh: Untuk mengurus SKCK di Polsek"
                                @focus="focused = true"
                                @blur="focused = false"
                            >{{ old('maksud_dan_tujuan', $surat_pengantar->maksud_dan_tujuan) }}</textarea>
                            @error('maksud_dan_tujuan') 
                                <span class="text-red-500 text-xs mt-1 block animate-pulse">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                        <button 
                            type="submit" 
                            class="relative px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105"
                            :class="{ 'opacity-50 cursor-not-allowed': submitting }"
                            @click="submitting = true"
                            x-bind:disabled="submitting"
                        >
                            <span x-show="!submitting">Update Pengajuan</span>
                            <span x-show="submitting" class="flex items-center">
                                <svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengupdate...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.6s ease-out;
        }
    </style>
</x-layout>