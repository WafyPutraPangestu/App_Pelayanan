<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <!-- Card Register -->
            <div x-show="show" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                
                <!-- Header dengan Logo -->
                <div class="bg-gradient-to-r from-green-600 to-green-700 p-8 text-center">
                    <div class="mb-4 flex justify-center">
                        <div class="bg-white p-3 rounded-full shadow-lg">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Desa" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-white mb-1">Daftar Akun Baru</h1>
                    <p class="text-green-100 text-sm">Buat akun untuk mengakses sistem</p>
                </div>

                <!-- Form Register -->
                <div class="p-8">
                    <form action="{{ route('auth.registerStore') }}" method="POST" class="space-y-4" x-data="{ loading: false, passwordMatch: true }" @submit="loading = true">
                        @csrf
                        
                        <!-- Name Input -->
                        <div x-data="{ focused: false }">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" :class="{ 'text-green-600': focused }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       required 
                                       @focus="focused = true" 
                                       @blur="focused = false"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 bg-gray-50 focus:bg-white"
                                       placeholder="Masukkan nama lengkap" />
                            </div>
                        </div>

                        <!-- Nomor Telepon Input -->
                        <div x-data="{ focused: false }">
                            <label for="nomor_telepon" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Telepon
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" :class="{ 'text-green-600': focused }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="nomor_telepon" 
                                       id="nomor_telepon" 
                                       required 
                                       @focus="focused = true" 
                                       @blur="focused = false"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 bg-gray-50 focus:bg-white"
                                       placeholder="08xxxxxxxxxx" />
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div x-data="{ focused: false }">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" :class="{ 'text-green-600': focused }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       required 
                                       @focus="focused = true" 
                                       @blur="focused = false"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 bg-gray-50 focus:bg-white"
                                       placeholder="nama@email.com" />
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div x-data="{ focused: false, showPassword: false }">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" :class="{ 'text-green-600': focused }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input :type="showPassword ? 'text' : 'password'" 
                                       name="password" 
                                       id="password" 
                                       required 
                                       @focus="focused = true" 
                                       @blur="focused = false"
                                       class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 bg-gray-50 focus:bg-white"
                                       placeholder="Minimal 8 karakter" />
                                <button type="button" 
                                        @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div x-data="{ focused: false, showPassword: false }">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" :class="{ 'text-green-600': focused }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input :type="showPassword ? 'text' : 'password'" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       required 
                                       @focus="focused = true" 
                                       @blur="focused = false"
                                       class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 bg-gray-50 focus:bg-white"
                                       placeholder="Ulangi password" />
                                <button type="button" 
                                        @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="flex items-start">
                            <input type="checkbox" required class="w-4 h-4 mt-1 text-green-600 border-gray-300 rounded focus:ring-green-500 cursor-pointer">
                            <label class="ml-2 text-sm text-gray-600">
                                Saya setuju dengan <a href="#" class="text-green-600 hover:text-green-700 font-medium hover:underline">syarat dan ketentuan</a> yang berlaku
                            </label>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold py-3 rounded-lg hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 transition duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center"
                                :disabled="loading">
                            <span x-show="!loading">Daftar Sekarang</span>
                            <span x-show="loading" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>

                        <!-- Login Link -->
                        <div class="text-center text-sm text-gray-600">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-semibold hover:underline">Login di sini</a>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 pb-8 text-center">
                    <p class="text-xs text-gray-500">
                        &copy; 2025 Sistem Informasi Desa. All rights reserved.
                    </p>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 text-center text-sm text-gray-600">
                {{-- <p>Butuh bantuan? <a href="#" class="text-green-600 hover:text-green-700 font-medium hover:underline">Hubungi Admin</a></p> --}}
            </div>
        </div>
    </div>
</x-layout>