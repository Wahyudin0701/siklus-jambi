<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SiklusJambi - Ekonomi Sirkular Limbah Kuliner' }}</title>
    
    <!-- PWA & Mobile Meta -->
    <meta name="theme-color" content="#076342">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/jpeg" href="/images/logo-official.jpg">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet GIS CSS (for map pickers) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 flex flex-col antialiased selection:bg-[#076342] selection:text-white">

    <!-- Desktop Navigation Bar (Visible on md screens and above when showBottomNav is true) -->
    @if(isset($showBottomNav) && $showBottomNav)
    @php
        $navUser = Auth::user() ?? \App\Models\User::where('phone_number', '081234567890')->first();
        $navWarung = $navUser ? ($navUser->warungProfile ?? \App\Models\WarungProfile::first()) : null;
        $navAvatar = $navUser && $navUser->avatar ? $navUser->avatar : '/images/avatar-user.jpg';
    @endphp
    <header class="hidden md:block bg-white border-b border-slate-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand & Official Logo -->
            <a href="{{ route('mobile.dashboard') }}" class="flex items-center space-x-3 group">
                <img src="/images/logo-official.jpg" 
                     alt="Logo Resmi SiklusJambi" 
                     class="w-10 h-10 object-contain rounded-xl shadow-xs border border-slate-100 group-hover:scale-105 transition-transform">
                <div>
                    <span class="text-lg font-black tracking-tight"><span class="text-[#076342]">Siklus</span><span class="text-[#D88909]">Jambi</span></span>
                    <span class="block text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Ekonomi Sirkular Limbah Kuliner</span>
                </div>
            </a>

            <!-- Center Nav Links -->
            <nav class="flex items-center space-x-1 lg:space-x-2 text-xs font-bold">
                <a href="{{ route('mobile.dashboard') }}" 
                   class="px-4 py-2 rounded-xl transition-all {{ ($activeTab ?? '') === 'beranda' ? 'bg-[#076342] text-white shadow-sm' : 'text-slate-600 hover:text-[#076342] hover:bg-emerald-50/60' }}">
                    Beranda
                </a>
                <a href="{{ route('mobile.schedule') }}" 
                   class="px-4 py-2 rounded-xl transition-all {{ ($activeTab ?? '') === 'jadwal' ? 'bg-[#076342] text-white shadow-sm' : 'text-slate-600 hover:text-[#076342] hover:bg-emerald-50/60' }}">
                    Jadwal Penjemputan
                </a>
                <a href="{{ route('mobile.pickup.create') }}" 
                   class="px-4 py-2 bg-gradient-to-r from-amber-500 to-[#D88909] hover:from-amber-600 hover:to-amber-700 text-white rounded-xl shadow-sm transition-all flex items-center space-x-1.5">
                    <span>+ Jemput Limbah</span>
                </a>
            </nav>

            <!-- Right Controls: Role Links + Profile Dropdown at the far right -->
            <div class="flex items-center space-x-3 text-xs font-semibold">
                <!-- Role Quick-Switch Utilities -->
                <div class="flex items-center space-x-1 border-r border-slate-200 pr-3">
                    <a href="{{ route('courier.dashboard') }}" 
                       class="px-2.5 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors flex items-center space-x-1.5" 
                       title="Buka Portal Kurir Lapangan">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                        <span class="hidden xl:inline">Kurir</span>
                    </a>
                    <a href="{{ route('stakeholder.dashboard') }}" 
                       class="px-2.5 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors flex items-center space-x-1.5" 
                       title="Buka Dashboard Command Center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span class="hidden xl:inline">Command Center</span>
                    </a>
                </div>

                <!-- Profile Dropdown (Positioned at Far Right) -->
                <div class="relative" id="navbar-profile-dropdown-container">
                    <button id="navbar-profile-btn" 
                            type="button" 
                            aria-expanded="false" 
                            aria-haspopup="true"
                            class="relative flex items-center space-x-1 p-0.5 rounded-full hover:ring-2 hover:ring-[#076342]/40 focus:outline-none focus:ring-2 focus:ring-[#076342] transition-all group cursor-pointer"
                            title="Menu Pengguna: {{ $navUser->name ?? 'Profil' }}">
                        <img src="{{ $navAvatar }}" 
                             alt="Foto Profil {{ $navUser->name ?? 'Pengguna' }}" 
                             class="w-9 h-9 sm:w-10 sm:h-10 rounded-full object-cover ring-2 ring-emerald-600/30 group-hover:ring-[#076342] shadow-xs transition-all">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-white absolute bottom-0 right-0"></span>
                    </button>

                    <!-- Dropdown Pop-up Panel -->
                    <div id="navbar-profile-menu" 
                         class="hidden absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 py-1.5 z-50 transform origin-top-right transition-all">
                        
                        <!-- User Identity Header -->
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-xs font-extrabold text-slate-900 truncate">
                                {{ $navUser->name ?? 'Wisnu Nugroho' }}
                            </p>
                            <p class="text-[11px] text-slate-500 truncate mt-0.5">
                                {{ $navWarung->business_name ?? 'Rumah Makan Padang Payakumbuh' }}
                            </p>
                            <div class="mt-2 flex items-center space-x-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200/80">
                                    Mitra Warung Sehat
                                </span>
                            </div>
                        </div>

                        <!-- Dropdown Options -->
                        <div class="py-1">
                            <!-- 1. Profile Option -->
                            <a href="{{ route('mobile.profile') }}" 
                               class="flex items-center space-x-3 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:text-[#076342] hover:bg-emerald-50/70 transition-colors group">
                                <div class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-emerald-100/70 text-slate-600 group-hover:text-[#076342] flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="block">Profile</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Kelola akun & warung Anda</span>
                                </div>
                            </a>

                            <!-- 2. Logout Option -->
                            <form action="{{ route('mobile.logout') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="w-full flex items-center space-x-3 px-4 py-2.5 text-xs font-semibold text-rose-600 hover:text-rose-700 hover:bg-rose-50 transition-colors text-left group cursor-pointer">
                                    <div class="w-7 h-7 rounded-lg bg-rose-50 group-hover:bg-rose-100 text-rose-600 flex items-center justify-center transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="block">Logout</span>
                                        <span class="text-[10px] text-rose-400 font-normal">Keluar dari sesi akun</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @endif

    <!-- Main Content Area (Fluid & Responsive) -->
    <main class="flex-1 w-full flex flex-col">
        @yield('content')
    </main>

    <!-- Mobile Bottom Navigation Bar (Visible only on mobile devices < md when showBottomNav is true) -->
    @if(isset($showBottomNav) && $showBottomNav)
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-6 py-2.5 flex items-center justify-between text-xs font-medium z-40 shadow-[0_-4px_20px_rgba(0,0,0,0.06)]">
        <!-- Beranda -->
        <a href="{{ route('mobile.dashboard') }}" class="flex flex-col items-center space-y-1 {{ ($activeTab ?? '') === 'beranda' ? 'text-[#076342] font-bold' : 'text-slate-400 hover:text-slate-600' }}">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            <span class="text-[11px]">Beranda</span>
        </a>

        <!-- Jadwal Jemputan -->
        <a href="{{ route('mobile.schedule') }}" class="flex flex-col items-center space-y-1 {{ ($activeTab ?? '') === 'jadwal' ? 'text-[#076342] font-bold' : 'text-slate-400 hover:text-slate-600' }}">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM12 10H7v5h5v-5z"/>
            </svg>
            <span class="text-[11px]">Jadwal</span>
        </a>

        <!-- Profil Saya -->
        <a href="{{ route('mobile.profile') }}" class="flex flex-col items-center space-y-1 {{ ($activeTab ?? '') === 'profil' ? 'text-[#076342] font-bold' : 'text-slate-400 hover:text-slate-600' }}">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            <span class="text-[11px]">Profil</span>
        </a>
    </nav>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileBtn = document.getElementById('navbar-profile-btn');
            const profileMenu = document.getElementById('navbar-profile-menu');
            const profileContainer = document.getElementById('navbar-profile-dropdown-container');

            if (profileBtn && profileMenu) {
                function toggleDropdown(show) {
                    const willShow = show !== undefined ? show : profileMenu.classList.contains('hidden');
                    if (willShow) {
                        profileMenu.classList.remove('hidden');
                        profileBtn.setAttribute('aria-expanded', 'true');
                    } else {
                        profileMenu.classList.add('hidden');
                        profileBtn.setAttribute('aria-expanded', 'false');
                    }
                }

                profileBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    toggleDropdown();
                });

                // Close on click outside
                document.addEventListener('click', function (e) {
                    if (profileContainer && !profileContainer.contains(e.target)) {
                        toggleDropdown(false);
                    }
                });

                // Close on Escape key
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        toggleDropdown(false);
                    }
                });

                // Close when an option link is clicked
                profileMenu.querySelectorAll('a, button').forEach(function (el) {
                    el.addEventListener('click', function () {
                        toggleDropdown(false);
                    });
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
