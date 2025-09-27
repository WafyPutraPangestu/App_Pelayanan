<aside 
    x-data="{ 
        isOpen: false, 
        activeMenu: window.location.pathname,
        userDropdown: false,
        notifications: false,
        init() {
            // Auto adjust main content margin
            this.adjustMainContent();
            window.addEventListener('resize', () => this.adjustMainContent());
        },
        adjustMainContent() {
            const main = document.querySelector('main');
            if (main) {
                if (window.innerWidth >= 1024) {
                    main.style.marginLeft = '20rem'; // 80 in Tailwind = 20rem
                    main.style.transition = 'margin-left 300ms ease-in-out';
                } else {
                    main.style.marginLeft = '0';
                }
            }
        }
    }" 
    class="fixed left-0 top-0 z-50 h-full"
>
    <!-- Overlay for mobile -->
    <div 
        x-show="isOpen" 
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="isOpen = false"
        class="fixed inset-0 bg-gray-900/80 lg:hidden"
    ></div>

    <!-- Sidebar -->
    <div 
        x-show="isOpen || window.innerWidth >= 1024"
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="flex h-full w-80 flex-col bg-white/95 backdrop-blur-xl border-r border-gray-200/50 shadow-xl lg:translate-x-0"
    >
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200/50">
            <div class="flex items-center space-x-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Portal Surat</h2>
                    <p class="text-xs text-gray-500">Sistem Administrasi</p>
                </div>
            </div>
            <button 
                @click="isOpen = false"
                class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
            >
                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- User Profile Section (Auth Users) -->
        @auth
        <div class="p-6 border-b border-gray-200/50">
            <div class="relative" x-data="{ open: false }">
                <button 
                    @click="open = !open"
                    class="flex w-full items-center space-x-3 rounded-xl p-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-200"
                >
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold shadow-lg">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex-1 text-left">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="text-xs text-gray-500">
                            @can('admin')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    User
                                </span>
                            @endcan
                        </p>
                    </div>
                    <svg class="h-4 w-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div 
                    x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    @click.away="open = false"
                    class="absolute right-0 top-full mt-2 w-48 rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-10"
                >
                    <div class="p-2">
                        <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>
                        <hr class="my-2 border-gray-200">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-3 py-2 text-sm text-red-700 rounded-lg hover:bg-red-50 transition-colors">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endauth

        <!-- Navigation Menu -->
        <nav class="flex-1 p-6 space-y-2">
            <!-- Dashboard/Home -->
            <a 
                href="/"
                class="flex items-center space-x-3 rounded-xl px-4 py-3 text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 hover:text-blue-700 group"
                :class="activeMenu === '/' ? 'bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 shadow-sm' : ''"
            >
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-sm group-hover:shadow-md transition-shadow">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                </div>
                <span class="font-medium">Home</span>
            </a>

            <!-- Surat Menu (Auth Users Only) -->
            @can('user')
            <a 
                href="{{ route('surat.index') }}"
                class="flex items-center space-x-3 rounded-xl px-4 py-3 text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 group"
                :class="activeMenu.includes('surat') ? 'bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 shadow-sm' : ''"
            >
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-sm group-hover:shadow-md transition-shadow">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                    </svg>
                </div>
                <span class="font-medium">Layanan Surat</span>
            </a>
            <a 
                href="{{ route('surat.tracking') }}"
                class="flex items-center space-x-3 rounded-xl px-4 py-3 text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-orange-50 hover:text-yellow-700 group"
                :class="activeMenu.includes('tracking') ? 'bg-gradient-to-r from-yellow-50 to-orange-50 text-yellow-700 shadow-sm' : ''"
            >
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-yellow-500 to-orange-600 text-white shadow-sm group-hover:shadow-md transition-shadow">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,6H13V13H11V6M11,16H13V18H11V16Z"/>
                    </svg>
                </div>
                <span class="font-medium">Surat Masuk</span>
            </a>
           
            @endcan

            <!-- Admin Only Menus -->
            @can('admin')
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Admin Panel</p>
                
                <a 
                    href="{{ route('dataDashboard.index') }}"
                    class="flex items-center space-x-3 rounded-xl px-4 py-3 text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 hover:text-purple-700 group"
                >
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-purple-500 to-pink-600 text-white shadow-sm group-hover:shadow-md transition-shadow">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M12 7C13.66 7 15 8.34 15 10C15 11.66 13.66 13 12 13C10.34 13 9 11.66 9 10C9 8.34 10.34 7 12 7M18 20.5C16.25 18.94 14.24 18 12 18S7.75 18.94 6 20.5V22H18V20.5Z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Data Dashboard</span>
                </a>
                
                <a 
                    href="{{ route('berita.index') }}"
                    class="flex items-center space-x-3 rounded-xl px-4 py-3 text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-orange-50 hover:to-red-50 hover:text-orange-700 group"
                >
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-orange-500 to-red-600 text-white shadow-sm group-hover:shadow-md transition-shadow">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3,3V21H21V3H3M18,18H6V6H18V18Z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Berita</span>
                </a>
            </div>
            @endcan

            <!-- Guest Menu -->
            @guest
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Akun</p>
                
                <a 
                    href="{{ route('auth.login') }}"
                    class="flex items-center space-x-3 rounded-xl px-4 py-3 text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 group"
                >
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-sm group-hover:shadow-md transition-shadow">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="font-medium">Login</span>
                </a>
                
                <a 
                    href="{{ route('auth.register') }}"
                    class="flex items-center space-x-3 rounded-xl px-4 py-3 text-gray-700 transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-teal-50 hover:text-green-700 group"
                >
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-green-500 to-teal-600 text-white shadow-sm group-hover:shadow-md transition-shadow">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Daftar</span>
                </a>
            </div>
            @endguest
        </nav>

        <!-- Footer -->
        <div class="border-t border-gray-200/50 p-6">
            <div class="rounded-xl bg-gradient-to-r from-blue-50 to-purple-50 p-4">
                <div class="flex items-center space-x-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                       <a href="{{ route('pengaduan.index') }}">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A1.5,1.5 0 0,1 10.5,15.5A1.5,1.5 0 0,1 12,14A1.5,1.5 0 0,1 13.5,15.5A1.5,1.5 0 0,1 12,17M14.5,10.5C14.5,9 13.5,8 12,8C10.5,8 9.5,9 9.5,10.5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Butuh Bantuan?</p>
                        <p class="text-xs text-gray-600">Hubungi admin untuk dukungan</p>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <button 
        @click="isOpen = true"
        class="fixed bottom-6 left-6 z-50 lg:hidden rounded-full bg-gradient-to-r from-blue-600 to-purple-600 p-4 text-white shadow-lg hover:shadow-xl transition-all duration-200"
    >
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</aside>