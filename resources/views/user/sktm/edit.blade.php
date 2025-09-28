<x-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl w-full bg-white rounded-2xl shadow-xl p-8 md:p-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center tracking-tight">Edit Surat Keterangan Tidak Mampu</h1>

            <form action="{{ route('sktm.update', $sktm->id) }}" method="POST" x-data="{ errors: {} }" @submit="errors = {}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $sktm->nama) }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out placeholder-gray-400">
                        @error('nama')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.nama = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $sktm->nik) }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out placeholder-gray-400">
                        @error('nik')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.nik = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $sktm->tempat_lahir) }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out placeholder-gray-400">
                        @error('tempat_lahir')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.tempat_lahir = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $sktm->tanggal_lahir->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out">
                        @error('tanggal_lahir')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.tanggal_lahir = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out bg-white">
                            <option value="Laki-laki" @selected(old('jenis_kelamin', $sktm->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('jenis_kelamin', $sktm->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.jenis_kelamin = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="agama" class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                        <input type="text" id="agama" name="agama" value="{{ old('agama', $sktm->agama) }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out placeholder-gray-400">
                        @error('agama')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.agama = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                        <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $sktm->pekerjaan) }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out placeholder-gray-400">
                        @error('pekerjaan')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.pekerjaan = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="4"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out placeholder-gray-400">{{ old('alamat', $sktm->alamat) }}</textarea>
                        @error('alamat')
                            <span class="text-red-500 text-xs mt-1" x-show="errors.alamat = '{{ $message }}'">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                    <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200 ease-in-out">Reset</button>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out">Update Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>