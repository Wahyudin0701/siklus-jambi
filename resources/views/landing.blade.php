<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiklusJambi — Ekonomi Sirkular Limbah Kuliner Kota Jambi</title>
    
    <meta name="description" content="Platform ekonomi sirkular Kota Jambi. Jual minyak jelantah warung, terima saldo tunai langsung, dan raih sertifikasi Warung Sehat dari Dinkes.">
    <meta name="theme-color" content="#076342">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-official.jpg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        
        /* Custom dynamic range styling */
        input[type="range"] {
            -webkit-appearance: none;
            appearance: none;
            height: 7px;
            border-radius: 999px;
            background: #e2e8f0;
            outline: none;
            transition: background 0.15s ease;
        }
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #076342;
            cursor: pointer;
            border: 3.5px solid white;
            box-shadow: 0 2px 6px rgba(7, 99, 66, 0.35);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.15);
            box-shadow: 0 3px 10px rgba(7, 99, 66, 0.45);
        }
        input[type="range"]::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #076342;
            cursor: pointer;
            border: 3.5px solid white;
            box-shadow: 0 2px 6px rgba(7, 99, 66, 0.35);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        input[type="range"]::-moz-range-thumb:hover {
            transform: scale(1.15);
            box-shadow: 0 3px 10px rgba(7, 99, 66, 0.45);
        }

        /* Architectural micro-grid background */
        .bg-grid-subtle {
            background-image: 
                linear-gradient(to right, rgba(15, 23, 42, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
            background-size: 36px 36px;
            mask-image: radial-gradient(ellipse 70% 60% at 50% 20%, #000 35%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 20%, #000 35%, transparent 100%);
        }

        /* Subtle organic floating animation */
        @keyframes float-subtle {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-7px); }
        }
        .animate-float {
            animation: float-subtle 5.5s ease-in-out infinite;
        }

        /* Ambient scanline for QR preview */
        @keyframes scanline {
            0% { transform: translateY(-100%); opacity: 0; }
            50% { opacity: 0.6; }
            100% { transform: translateY(100%); opacity: 0; }
        }
        .animate-scanline {
            animation: scanline 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Scroll-driven reveal system */
        .reveal {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.65s cubic-bezier(0.16, 1, 0.3, 1), transform 0.65s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-75  { transition-delay: 75ms; }
        .delay-150 { transition-delay: 150ms; }
        .delay-225 { transition-delay: 225ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-375 { transition-delay: 375ms; }

        /* Tactile pulse indicator */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.4); opacity: 0; }
            100% { transform: scale(0.95); opacity: 0; }
        }
        .pulse-ring {
            animation: pulse-ring 2.2s cubic-bezier(0.24, 0, 0.38, 1) infinite;
        }

        /* Number update pop */
        .num-pop {
            animation: numPop 0.25s ease-out;
        }
        @keyframes numPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.08); color: #076342; }
            100% { transform: scale(1); }
        }

        /* Fluid stream dash animation for pipeline */
        @keyframes streamFlow {
            from { stroke-dashoffset: 24; }
            to { stroke-dashoffset: 0; }
        }
        .animate-stream-flow {
            stroke-dasharray: 6 6;
            animation: streamFlow 2s linear infinite;
        }

        /* Subtle ripple breathing animation */
        @keyframes rippleBreathing {
            0%, 100% { transform: scale(1); opacity: 0.35; }
            50% { transform: scale(1.05); opacity: 0.55; }
        }
        .animate-ripple {
            animation: rippleBreathing 9s ease-in-out infinite;
        }

        /* 3D Oil WebGL Canvas */
        #oil-3d-canvas {
            display: none;
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .oil-3d-active #oil-3d-canvas {
            display: block !important;
            opacity: 1;
        }
        .oil-3d-active .oil-static-watermark {
            display: none !important;
        }

        /* Accessibility: respect user prefers-reduced-motion */
        @media (prefers-reduced-motion: reduce) {
            .reveal {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
            .animate-float, .animate-scanline, .pulse-ring, .num-pop {
                animation: none !important;
            }
            #scroll-progress {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-[#076342]/20 selection:text-[#076342]">

    {{-- ─── SCROLL PROGRESS BAR ─── --}}
    <div id="scroll-progress" class="fixed top-0 left-0 h-[2.5px] bg-[#076342] z-[60] transition-all duration-75 w-0 pointer-events-none"></div>

    {{-- ─── NAVBAR ─── --}}
    <header id="site-header" class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-100 transition-all duration-200 relative">
        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center space-x-2.5 group">
                <img src="{{ asset('images/logo-official.jpg') }}" alt="SiklusJambi" class="w-9 h-9 rounded-xl object-contain shadow-xs group-hover:scale-105 transition-transform duration-200">
                <span class="text-lg font-bold tracking-tight">
                    <span class="text-[#076342] group-hover:text-[#065035] transition-colors">Siklus</span><span class="text-[#D88909]">Jambi</span>
                </span>
            </a>

            <nav class="hidden lg:flex items-center space-x-7 text-[13px] font-medium text-slate-500">
                <a href="#cara-kerja" class="hover:text-slate-900 transition-colors py-1">Cara Kerja</a>
                <a href="#warung-sehat" class="hover:text-slate-900 transition-colors py-1">Warung Sehat</a>
                <a href="#tentang" class="hover:text-slate-900 transition-colors py-1">Tentang</a>
            </nav>

            <div class="hidden sm:flex items-center space-x-2">
                <a href="{{ route('mobile.login') }}" class="px-4 py-2 text-[13px] font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition-all duration-150">
                    Masuk
                </a>
                <a href="{{ route('mobile.register.step1') }}" class="px-4 py-2 bg-[#076342] hover:bg-[#065035] active:scale-[0.98] text-white text-[13px] font-semibold rounded-lg shadow-xs hover:shadow transition-all duration-150">
                    Daftar Warung
                </a>
            </div>

            <button id="mobile-menu-btn" type="button" aria-label="Menu navigasi" aria-expanded="false" class="lg:hidden p-2 -mr-2 text-slate-500 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">
                <svg id="menu-icon-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg id="menu-icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile Menu Overlay (Absolute to eliminate layout shift) --}}
        <div id="mobile-menu" class="hidden lg:hidden absolute top-full left-0 right-0 bg-white border-b border-slate-200 shadow-2xl px-5 py-4 space-y-1 z-50 transition-all">
            <a href="#cara-kerja" class="block py-2.5 text-sm font-medium text-slate-700 hover:text-[#076342] hover:bg-emerald-50/60 rounded-lg px-3 transition-colors">Cara Kerja</a>
            <a href="#warung-sehat" class="block py-2.5 text-sm font-medium text-slate-700 hover:text-[#076342] hover:bg-emerald-50/60 rounded-lg px-3 transition-colors">Sertifikasi Warung Sehat</a>
            <a href="#tentang" class="block py-2.5 text-sm font-medium text-slate-700 hover:text-[#076342] hover:bg-emerald-50/60 rounded-lg px-3 transition-colors">Tentang SiklusJambi</a>
            <div class="pt-3 mt-2 border-t border-slate-100 flex flex-col space-y-2">
                <a href="{{ route('mobile.login') }}" class="w-full py-2.5 text-center text-sm font-semibold text-slate-700 border border-slate-200 hover:bg-slate-50 rounded-lg transition-colors">Masuk Akun</a>
                <a href="{{ route('mobile.register.step1') }}" class="w-full py-2.5 text-center text-sm font-semibold text-white bg-[#076342] hover:bg-[#065035] rounded-lg shadow-xs transition-colors">Daftar Warung</a>
            </div>
        </div>
    </header>

    {{-- Mobile Menu Backdrop Blur Overlay --}}
    <div id="mobile-menu-backdrop" class="fixed inset-0 top-16 bg-slate-900/35 backdrop-blur-md z-40 hidden lg:hidden transition-all duration-300" aria-hidden="true"></div>


    {{-- ─── HERO WITH AMBIENT GOLDEN OIL & ECOLOGY DEPTH ─── --}}
    <section id="hero-section" class="relative pt-5 sm:pt-6 lg:pt-8 pb-10 lg:pb-14 overflow-hidden">
        {{-- 3D WebGL2 Golden Oil Canvas (desktop only, hidden on mobile/tablet) --}}
        <canvas id="oil-3d-canvas" class="hidden lg:block" aria-hidden="true"></canvas>

        {{-- Ambient background lighting & architectural micro-grid with Golden Oil Tone --}}
        <div class="absolute inset-0 pointer-events-none -z-10 overflow-hidden">
            {{-- Warm Golden Amber Oil Glow & Emerald Ecology Blend --}}
            <div class="absolute -top-40 left-1/3 -translate-x-1/2 w-[68rem] h-[36rem] bg-gradient-to-br from-amber-300/35 via-emerald-100/25 to-amber-200/40 blur-3xl opacity-85 rounded-full"></div>
            <div class="absolute top-20 right-0 w-[32rem] h-[32rem] bg-gradient-to-b from-amber-400/20 via-amber-200/10 to-transparent blur-3xl rounded-full"></div>
            
            {{-- Golden Oil Droplet Circular Ripple Watermark in background --}}
            <div class="oil-static-watermark absolute right-6 top-10 w-[480px] h-[480px] pointer-events-none opacity-[0.25] hidden lg:block transition-opacity duration-800">
                <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-amber-500">
                    <circle cx="100" cy="100" r="92" stroke="currentColor" stroke-width="1" stroke-dasharray="4 6" opacity="0.4"/>
                    <circle cx="100" cy="100" r="70" stroke="currentColor" stroke-width="1.2" opacity="0.5"/>
                    <circle cx="100" cy="100" r="48" stroke="currentColor" stroke-width="1.5" opacity="0.7"/>
                    <path d="M100 60C100 60 80 86 80 102C80 113.046 88.9543 122 100 122C111.046 122 120 113.046 120 102C120 86 100 60 100 60Z" fill="url(#goldOilDropGlow)" opacity="0.9"/>
                    <defs>
                        <linearGradient id="goldOilDropGlow" x1="100" y1="60" x2="100" y2="122" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F59E0B"/>
                            <stop offset="1" stop-color="#D88909"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <div class="absolute inset-0 bg-grid-subtle pointer-events-none"></div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-12 items-center">
                
                {{-- Left --}}
                <div class="space-y-6 max-w-xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50/80 border border-amber-200/80 rounded-full text-[12px] font-semibold text-slate-700">
                        <span class="relative flex h-2 w-2">
                            <span class="pulse-ring absolute inline-flex h-full w-full rounded-full bg-amber-400"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#D88909]"></span>
                        </span>
                        <span class="text-[#076342] font-bold">Ekonomi Sirkular Kuliner Kota Jambi</span>
                    </div>

                    <h1 class="text-[2.5rem] sm:text-5xl font-extrabold text-slate-900 leading-[1.1] tracking-tight">
                        Jelantah warung Anda bernilai <span class="text-[#D88909] relative inline-block font-black">Rp{{ number_format($currentPrice, 0, ',', '.') }}<span class="absolute bottom-1 left-0 right-0 h-2.5 bg-amber-200/50 -z-10 rounded"></span></span> per liter.
                    </h1>

                    <p class="text-base text-slate-500 leading-relaxed">
                        SiklusJambi mengumpulkan minyak jelantah dari warung kuliner di seluruh Kota Jambi. Anda cukup kumpulkan, kami jemput &mdash; saldo tunai langsung masuk, poin reward terkumpul, dan warung Anda berhak mendapat sertifikasi Warung Sehat dari Dinkes.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <a href="{{ route('mobile.register.step1') }}" class="px-6 py-3.5 bg-[#076342] hover:bg-[#065035] active:scale-[0.98] text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all text-center flex items-center justify-center">
                            <span>Daftarkan Warung Anda</span>
                        </a>
                        <a href="#cara-kerja" class="px-6 py-3.5 bg-slate-100 hover:bg-slate-200/80 active:scale-[0.98] text-slate-700 text-sm font-semibold rounded-lg transition-all text-center">
                            Pelajari Cara Kerja
                        </a>
                    </div>
                </div>

                {{-- Right: compact dashboard preview with subtle float animation --}}
                <div class="relative lg:pl-4">
                    <div class="animate-float relative z-10">
                        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            
                            {{-- Mini header --}}
                            <div class="bg-[#076342] px-5 py-4 text-white relative overflow-hidden">
                                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>
                                <div class="flex items-center justify-between relative z-10">
                                    <div class="flex items-center space-x-2.5">
                                        <img src="{{ asset('images/logo-official.jpg') }}" alt="Logo" class="w-7 h-7 rounded-lg bg-white p-0.5 shadow-xs">
                                        <span class="text-sm font-semibold tracking-tight">Dashboard Warung</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 bg-emerald-700/60 px-2 py-0.5 rounded-full border border-emerald-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                                        <span class="text-[10px] text-emerald-100 font-medium">Terverifikasi</span>
                                    </div>
                                </div>
                                <div class="mt-3 flex justify-between items-end relative z-10">
                                    <div>
                                        <p class="text-[11px] text-emerald-200/80">Saldo Siap Tarik</p>
                                        <p class="text-xl font-bold tracking-tight">Rp1.376.000</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center gap-1 bg-amber-400/20 text-amber-300 text-[11px] font-semibold px-2 py-0.5 rounded-md border border-amber-300/30">
                                            380 Poin
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Mini body --}}
                            <div class="p-4 space-y-3 bg-slate-50/70">
                                <div class="bg-white p-3 rounded-xl border border-slate-100 flex items-center justify-between shadow-xs hover:border-slate-200 transition-colors">
                                    <div>
                                        <p class="text-xs font-semibold text-slate-800">RM Padang Payakumbuh</p>
                                        <p class="text-[11px] text-slate-400">Kec. Jelutung · 184L diselamatkan</p>
                                    </div>
                                    <span class="text-[10px] font-semibold text-[#076342] bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Warung Sehat
                                    </span>
                                </div>

                                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-xs">
                                    <div class="flex justify-between text-[11px] mb-2">
                                        <span class="font-medium text-slate-700 flex items-center gap-2">
                                            <span class="relative flex h-2 w-2">
                                                <span class="pulse-ring absolute inline-flex h-full w-full rounded-full bg-emerald-400"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            Penjemputan aktif
                                        </span>
                                        <span class="text-slate-400 font-mono text-[10px]">#ORD-2026-081</span>
                                    </div>
                                    <div class="space-y-1.5 text-[11px] text-slate-500">
                                        <div class="flex justify-between"><span>Volume terestimasi</span><span class="text-slate-800 font-medium">25 Liter</span></div>
                                        <div class="flex justify-between"><span>Estimasi saldo tunai</span><span class="text-[#076342] font-semibold">Rp187.500</span></div>
                                    </div>
                                </div>

                                <a href="{{ route('mobile.login') }}" class="group block w-full py-2.5 bg-[#076342] text-white text-center text-xs font-semibold rounded-lg hover:bg-[#065035] active:scale-[0.99] transition-all shadow-xs">
                                    <span class="inline-flex items-center gap-1">
                                        <span>Coba Antarmuka Demo</span>
                                        <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                                    </span>
                                </a>
                            </div>
                        </div>

                        {{-- Floating Golden Oil Emblem Badge --}}
                        <div class="absolute -bottom-5 -left-4 sm:-bottom-6 sm:-left-6 bg-white/95 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-amber-200/90 shadow-lg shadow-amber-950/5 flex items-center gap-3 z-20 hover:scale-105 transition-transform duration-200">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 via-amber-500 to-[#D88909] text-white flex items-center justify-center shadow-md shadow-amber-500/25 shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.5C12 2.5 6 9.5 6 14.5C6 17.8137 8.68629 20.5 12 20.5C15.3137 20.5 18 17.8137 18 14.5C18 9.5 12 2.5 12 2.5ZM12 18.5C9.79086 18.5 8 16.7091 8 14.5C8 11.8 11 7.2 12 5.8C13 7.2 16 11.8 16 14.5C16 16.7091 14.2091 18.5 12 18.5Z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    <p class="text-[10px] font-bold text-amber-800 uppercase tracking-wider">Emas Sirkular</p>
                                </div>
                                <p class="text-xs font-bold text-slate-800">1 Liter = 1 Poin Emas</p>
                            </div>
                        </div>
                    </div>

                    {{-- Warm Golden Oil ambient glow behind card --}}
                    <div class="absolute -top-6 -right-6 w-72 h-72 bg-gradient-to-br from-amber-200/40 via-amber-300/20 to-transparent rounded-full blur-3xl -z-10 pointer-events-none"></div>
                </div>

            </div>
        </div>
    </section>


    {{-- ─── STATS FLOATING ISLAND CARD ─── --}}
    <section id="stats-section" class="pb-16 lg:pb-20 relative z-20">
        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="reveal bg-white/95 backdrop-blur-md rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:divide-x lg:divide-slate-200/70">
                    
                    {{-- Stat 1: Air Bersih --}}
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-none">
                            <span class="stat-counter" 
                                  data-target="{{ ($impact->clean_water_saved_liters ?? 18450000) / 1000000 }}" 
                                  data-decimals="1">{{ number_format(($impact->clean_water_saved_liters ?? 18450000) / 1000000, 1, ',', '.') }}</span>
                            <span class="text-sm font-bold text-[#076342] ml-1">Juta L</span>
                        </p>
                        <p class="text-xs font-medium text-slate-500 mt-2 leading-snug">Air bersih terlindungi</p>
                    </div>

                    {{-- Stat 2: Emisi Karbon --}}
                    <div class="lg:pl-8">
                        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-none">
                            <span class="stat-counter" 
                                  data-target="{{ ($impact->co2e_reduced_kg ?? 39800) / 1000 }}" 
                                  data-decimals="1">{{ number_format(($impact->co2e_reduced_kg ?? 39800) / 1000, 1, ',', '.') }}</span>
                            <span class="text-sm font-bold text-[#076342] ml-1">Ton</span>
                        </p>
                        <p class="text-xs font-medium text-slate-500 mt-2 leading-snug">Emisi CO₂e tereduksi</p>
                    </div>

                    {{-- Stat 3: Warung Terdaftar --}}
                    <div class="lg:pl-8">
                        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-none">
                            <span class="stat-counter" 
                                  data-target="{{ $totalWarung }}" 
                                  data-decimals="0">{{ number_format($totalWarung, 0, ',', '.') }}</span><span class="text-lg font-bold text-[#D88909] ml-0.5">+</span>
                        </p>
                        <p class="text-xs font-medium text-slate-500 mt-2 leading-snug">Warung terdaftar</p>
                    </div>

                    {{-- Stat 4: Bioavtur SAF --}}
                    <div class="lg:pl-8">
                        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-none">
                            <span class="stat-counter" 
                                  data-target="{{ $impact->saf_produced_liters ?? 14760 }}" 
                                  data-decimals="0">{{ number_format($impact->saf_produced_liters ?? 14760, 0, ',', '.') }}</span>
                            <span class="text-sm font-bold text-[#076342] ml-1">L</span>
                        </p>
                        <p class="text-xs font-medium text-slate-500 mt-2 leading-snug">Bahan baku Bioavtur SAF</p>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- ─── CARA KERJA (FLOWING PIPELINE & AMBIENT CANVAS) ─── --}}
    <section id="cara-kerja" class="py-24 lg:py-28 bg-gradient-to-b from-[#f7faf7] via-[#fcfbf7] to-[#f3f7f4] border-t border-slate-200/80 relative overflow-hidden">
        
        {{-- Ambient decorative background lights --}}
        <div class="absolute -top-32 -left-32 w-[34rem] h-[34rem] bg-emerald-200/35 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute top-1/2 -right-32 w-[38rem] h-[38rem] bg-amber-200/35 rounded-full blur-[110px] pointer-events-none"></div>
        
        {{-- River contour flow curves SVG watermark --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden opacity-35">
            <svg class="w-full h-full" viewBox="0 0 1440 600" fill="none" preserveAspectRatio="none">
                <path d="M-100 200 C 300 120, 600 350, 1000 180 C 1200 90, 1400 250, 1600 180" stroke="url(#riverStroke1)" stroke-width="1.5" fill="none"/>
                <path d="M-100 260 C 320 180, 620 410, 1020 240 C 1220 150, 1420 310, 1620 240" stroke="url(#riverStroke2)" stroke-width="1" stroke-dasharray="4 8" fill="none"/>
                <path d="M-100 320 C 340 240, 640 470, 1040 300 C 1240 210, 1440 370, 1640 300" stroke="url(#riverStroke1)" stroke-width="1.5" fill="none"/>
                <defs>
                    <linearGradient id="riverStroke1" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#076342" stop-opacity="0.06"/>
                        <stop offset="50%" stop-color="#D88909" stop-opacity="0.12"/>
                        <stop offset="100%" stop-color="#076342" stop-opacity="0.06"/>
                    </linearGradient>
                    <linearGradient id="riverStroke2" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#076342" stop-opacity="0.1"/>
                        <stop offset="70%" stop-color="#D88909" stop-opacity="0.14"/>
                        <stop offset="100%" stop-color="#076342" stop-opacity="0.08"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8 relative z-10">

            <div class="max-w-2xl mb-14 reveal">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-500/10 border border-amber-500/25 rounded-full text-[11px] font-bold text-[#D88909] tracking-wider uppercase mb-3 shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#D88909]"></span>
                    <span>Alur Transparan 4 Langkah</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Empat langkah, dari jerigen ke saldo tunai
                </h2>
                <p class="text-sm text-slate-600 mt-2.5 leading-relaxed">
                    Dirancang seringkas mungkin agar warung kuliner bisa tetap fokus masak tanpa terbebani administrasi limbah.
                </p>
            </div>

            <div class="relative">
                {{-- Desktop Connecting Pipeline Line --}}
                <div class="hidden lg:block absolute top-[72px] left-[10%] right-[10%] h-8 pointer-events-none z-0">
                    <svg class="w-full h-full" viewBox="0 0 1000 30" fill="none" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="pipelineGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#076342" stop-opacity="0.3"/>
                                <stop offset="45%" stop-color="#076342" stop-opacity="0.5"/>
                                <stop offset="75%" stop-color="#D88909" stop-opacity="0.6"/>
                                <stop offset="100%" stop-color="#D88909" stop-opacity="0.85"/>
                            </linearGradient>
                        </defs>
                        {{-- Base track --}}
                        <line x1="50" y1="15" x2="950" y2="15" stroke="url(#pipelineGrad)" stroke-width="2.5" stroke-dasharray="6 6"/>
                        {{-- Flowing stream dash --}}
                        <line x1="50" y1="15" x2="950" y2="15" stroke="url(#pipelineGrad)" stroke-width="2" class="animate-stream-flow"/>
                        {{-- Node rings --}}
                        <circle cx="50" cy="15" r="5" fill="#076342" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="350" cy="15" r="5" fill="#076342" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="650" cy="15" r="5" fill="#076342" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="950" cy="15" r="6" fill="#D88909" stroke="#ffffff" stroke-width="2"/>
                    </svg>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-5 relative z-10">
                    
                    {{-- Step 1 --}}
                    <div class="reveal delay-75 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.05)] hover:border-[#076342]/50 hover:shadow-xl hover:shadow-emerald-950/10 hover:-translate-y-2 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                        <span class="absolute -right-1 -bottom-2 sm:-bottom-3 text-4xl sm:text-6xl font-black text-slate-100 group-hover:text-emerald-50/70 select-none pointer-events-none transition-colors">01</span>
                        <div>
                            <div class="flex items-center justify-between mb-2.5 sm:mb-5">
                                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-emerald-50 text-[#076342] border border-emerald-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-[#076342] group-hover:text-white transition-all duration-200 shadow-2xs shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <span class="text-[9px] sm:text-[11px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-1.5 sm:px-2.5 py-0.5 rounded-full border border-emerald-100/80">Langkah 01</span>
                            </div>
                            <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-[#076342] transition-colors leading-snug">Kumpulkan</h3>
                            <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2.5">
                                Tampung sisa minyak goreng bekas di jerigen tertutup. Penjemputan gratis mulai 10 liter.
                            </p>
                        </div>
                        <div class="mt-3.5 sm:mt-5 pt-2 sm:pt-3 border-t border-slate-100 text-[9px] sm:text-[11px] font-medium text-slate-500 flex items-center gap-1 sm:gap-1.5 relative z-10">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                            <span class="truncate sm:whitespace-normal">Mulai 1 jerigen</span>
                        </div>
                    </div>

                    {{-- Step 2 --}}
                    <div class="reveal delay-150 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.05)] hover:border-[#076342]/50 hover:shadow-xl hover:shadow-emerald-950/10 hover:-translate-y-2 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 to-emerald-500"></div>
                        <span class="absolute -right-1 -bottom-2 sm:-bottom-3 text-4xl sm:text-6xl font-black text-slate-100 group-hover:text-emerald-50/70 select-none pointer-events-none transition-colors">02</span>
                        <div>
                            <div class="flex items-center justify-between mb-2.5 sm:mb-5">
                                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-emerald-50 text-[#076342] border border-emerald-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-[#076342] group-hover:text-white transition-all duration-200 shadow-2xs shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                </div>
                                <span class="text-[9px] sm:text-[11px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-1.5 sm:px-2.5 py-0.5 rounded-full border border-emerald-100/80">Langkah 02</span>
                            </div>
                            <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-[#076342] transition-colors leading-snug">Ajukan jemput</h3>
                            <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2.5">
                                Buka portal, klik &ldquo;Jemput Limbah&rdquo;, kurir terdekat ditugaskan otomatis via GPS.
                            </p>
                        </div>
                        <div class="mt-3.5 sm:mt-5 pt-2 sm:pt-3 border-t border-slate-100 text-[9px] sm:text-[11px] font-medium text-slate-500 flex items-center gap-1 sm:gap-1.5 relative z-10">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                            <span class="truncate sm:whitespace-normal">Dijemput ke warung</span>
                        </div>
                    </div>

                    {{-- Step 3 --}}
                    <div class="reveal delay-225 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.05)] hover:border-[#076342]/50 hover:shadow-xl hover:shadow-emerald-950/10 hover:-translate-y-2 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 to-amber-500"></div>
                        <span class="absolute -right-1 -bottom-2 sm:-bottom-3 text-4xl sm:text-6xl font-black text-slate-100 group-hover:text-emerald-50/70 select-none pointer-events-none transition-colors">03</span>
                        <div>
                            <div class="flex items-center justify-between mb-2.5 sm:mb-5">
                                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-emerald-50 text-[#076342] border border-emerald-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-[#076342] group-hover:text-white transition-all duration-200 shadow-2xs shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <span class="text-[9px] sm:text-[11px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-1.5 sm:px-2.5 py-0.5 rounded-full border border-emerald-100/80">Langkah 03</span>
                            </div>
                            <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-[#076342] transition-colors leading-snug">Timbang & uji</h3>
                            <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2.5">
                                Petugas datang membawa timbangan digital & cek 3 parameter mutu SAF Pertamina.
                            </p>
                        </div>
                        <div class="mt-3.5 sm:mt-5 pt-2 sm:pt-3 border-t border-slate-100 text-[9px] sm:text-[11px] font-medium text-slate-500 flex items-center gap-1 sm:gap-1.5 relative z-10">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                            <span class="truncate sm:whitespace-normal">Standar ISCC SAF</span>
                        </div>
                    </div>

                    {{-- Step 4 --}}
                    <div class="reveal delay-300 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.05)] hover:border-[#D88909]/70 hover:shadow-xl hover:shadow-amber-950/10 hover:-translate-y-2 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-amber-400 to-[#D88909]"></div>
                        <span class="absolute -right-1 -bottom-2 sm:-bottom-3 text-4xl sm:text-6xl font-black text-slate-100 group-hover:text-amber-50/80 select-none pointer-events-none transition-colors">04</span>
                        <div>
                            <div class="flex items-center justify-between mb-2.5 sm:mb-5">
                                <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-amber-50 text-[#D88909] border border-amber-100 flex items-center justify-center group-hover:scale-105 group-hover:bg-[#D88909] group-hover:text-white transition-all duration-200 shadow-2xs shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <span class="text-[9px] sm:text-[11px] font-bold uppercase tracking-wider text-amber-800 bg-amber-50 px-1.5 sm:px-2.5 py-0.5 rounded-full border border-amber-100/80">Langkah 04</span>
                            </div>
                            <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-[#D88909] transition-colors leading-snug">Terima saldo</h3>
                            <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2.5">
                                Saldo tunai langsung masuk detik itu juga, reward terkumpul, dan sertifikasi aktif.
                            </p>
                        </div>
                        <div class="mt-3.5 sm:mt-5 pt-2 sm:pt-3 border-t border-slate-100 text-[9px] sm:text-[11px] font-medium text-slate-500 flex items-center gap-1 sm:gap-1.5 relative z-10">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
                            <span class="truncate sm:whitespace-normal">Cair tanpa potongan</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- ─── WARUNG SEHAT (AUTHENTIC CERTIFICATION & PREVIEW) ─── --}}
    <section id="warung-sehat" class="py-24 lg:py-28 bg-gradient-to-b from-[#edf5f0] via-[#f7fbf8] to-[#f4f7f4] border-t border-slate-200/80 relative overflow-hidden">
        
        {{-- Ambient decorative glow --}}
        <div class="absolute -top-12 -left-20 w-[32rem] h-[32rem] bg-emerald-200/35 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute top-1/2 -right-12 w-[32rem] h-[32rem] bg-amber-200/30 rounded-full blur-[100px] pointer-events-none"></div>
        
        {{-- Subtle health shield watermark SVG --}}
        <div class="absolute -right-12 top-10 pointer-events-none opacity-5">
            <svg class="w-96 h-96 text-[#076342]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-14 items-center">
                
                <div class="lg:col-span-7 space-y-5 reveal">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-[12px] font-semibold text-[#076342]">
                        <svg class="w-3.5 h-3.5 text-[#076342]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Sertifikasi Dinkes Kota Jambi</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-snug">
                        Konsumen bisa scan QR di etalase warung Anda untuk membuktikan bahwa makanan di sini bebas minyak daur ulang.
                    </h2>

                    <p class="text-sm text-slate-600 leading-relaxed">
                        Kolaborasi SiklusJambi dengan Dinas Kesehatan Kota Jambi. Warung yang rutin menyetor jelantah mendapat stiker resmi dengan kode QR unik yang bisa dipindai siapa pun &mdash; langsung terbuka di browser HP tanpa perlu instal aplikasi apapun.
                    </p>

                    <div class="space-y-3 pt-2">
                        <div class="flex items-start gap-3 bg-white/80 backdrop-blur-xs p-3.5 rounded-xl border border-emerald-900/5 shadow-2xs">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-[#076342] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">✓</span>
                            <span class="text-sm text-slate-700"><strong class="text-slate-900">Stiker QR dinamis 30 hari</strong> &mdash; masa berlaku diperpanjang setiap kali warung menyetor jelantah.</span>
                        </div>
                        <div class="flex items-start gap-3 bg-white/80 backdrop-blur-xs p-3.5 rounded-xl border border-emerald-900/5 shadow-2xs">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-[#076342] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">✓</span>
                            <span class="text-sm text-slate-700"><strong class="text-slate-900">Verifikasi publik instan</strong> &mdash; pembeli melihat sertifikat sanitasi, histori setoran, dan status kebersihan minyak.</span>
                        </div>
                        <div class="flex items-start gap-3 bg-white/80 backdrop-blur-xs p-3.5 rounded-xl border border-emerald-900/5 shadow-2xs">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-[#076342] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">✓</span>
                            <span class="text-sm text-slate-700"><strong class="text-slate-900">Kedaluwarsa otomatis transparan</strong> &mdash; jika 30 hari tidak ada setoran, status stiker berubah agar standar higienitas selalu terjaga.</span>
                        </div>
                    </div>

                    @if($sampleCertificate)
                    <div class="pt-3">
                        <a href="{{ route('public.qr', $sampleCertificate->qr_hash) }}" target="_blank" 
                           class="inline-flex items-center gap-2 text-sm font-semibold text-[#076342] hover:text-[#065035] group transition-colors">
                            <span>Buka simulasi verifikasi stiker publik</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Interactive Sticker Preview Card with Golden Ambient Glow --}}
                <div class="lg:col-span-5 flex justify-center reveal delay-150">
                    <div class="w-full max-w-xs bg-[#076342] rounded-2xl p-6 text-white text-center border-2 border-[#D88909]/70 shadow-[0_20px_50px_rgba(7,99,66,0.3)] ring-1 ring-amber-400/40 hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] relative overflow-hidden group">
                        
                        {{-- Subtle light beam reflection --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/5 to-transparent pointer-events-none"></div>

                        <div class="flex items-center justify-center gap-2 mb-3">
                            <img src="{{ asset('images/logo-official.jpg') }}" alt="Logo" class="w-7 h-7 rounded-lg bg-white p-0.5 shadow-xs">
                            <span class="text-[11px] uppercase tracking-widest font-bold text-emerald-200">SiklusJambi</span>
                        </div>

                        <h3 class="text-base font-bold uppercase tracking-wide mb-0.5">Warung Sehat Kota Jambi</h3>
                        <p class="text-[10px] text-emerald-200/90 mb-4">Terverifikasi bebas minyak jelantah berulang</p>

                        {{-- QR Code Box with dynamic scan animation --}}
                        <a href="{{ route('public.qr', $sampleCertificate?->qr_hash ?? 'ws-demo-jmb-0042') }}" target="_blank" title="Klik untuk verifikasi sertifikat" class="block group/qr focus:outline-hidden">
                            <div class="w-36 h-36 sm:w-40 sm:h-40 bg-white rounded-2xl mx-auto p-2.5 sm:p-3 mb-2 relative overflow-hidden shadow-2xl border-2 border-white/90 group-hover/qr:scale-105 transition-all duration-300">
                                <div class="absolute inset-x-0 h-1 bg-gradient-to-r from-emerald-400 via-[#076342] to-emerald-400 shadow-[0_0_8px_rgba(16,185,129,0.8)] animate-scanline pointer-events-none z-10"></div>
                                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" shape-rendering="crispEdges">
                                    <path fill="#ffffff" d="M0 0h35v35H0z"/>
                                    <path stroke="#0f172a" d="M1 1.5h7m1 0h3m1 0h1m2 0h1m5 0h1m4 0h7M1 2.5h1m5 0h1m1 0h4m2 0h2m1 0h1m2 0h1m1 0h1m3 0h1m5 0h1M1 3.5h1m1 0h3m1 0h1m2 0h1m1 0h1m1 0h3m2 0h1m1 0h1m1 0h3m1 0h1m1 0h3m1 0h1M1 4.5h1m1 0h3m1 0h1m1 0h1m1 0h2m3 0h1m2 0h1m2 0h1m1 0h2m1 0h1m1 0h3m1 0h1M1 5.5h1m1 0h3m1 0h1m3 0h1m5 0h3m4 0h1m2 0h1m1 0h3m1 0h1M1 6.5h1m5 0h1m7 0h5m2 0h1m4 0h1m5 0h1M1 7.5h7m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h7M9 8.5h1m1 0h1m1 0h1m1 0h6m1 0h2M1 9.5h1m1 0h2m1 0h3m3 0h1m1 0h1m1 0h1m1 0h1m2 0h2m4 0h1m2 0h1m1 0h2M1 10.5h5m3 0h1m4 0h8m1 0h5m1 0h5M2 11.5h1m1 0h2m1 0h2m1 0h2m1 0h2m4 0h1m2 0h3m2 0h4m1 0h1M5 12.5h1m2 0h1m4 0h1m2 0h1m1 0h1m2 0h6m1 0h3m1 0h1M4 13.5h4m1 0h4m2 0h3m3 0h3m1 0h2m1 0h1m1 0h1m2 0h1M2 14.5h3m1 0h1m1 0h1m2 0h1m1 0h3m2 0h1m2 0h1m2 0h1m1 0h7M1 15.5h1m1 0h1m2 0h6m1 0h3m2 0h4m1 0h1m2 0h1m2 0h1m1 0h1M2 16.5h3m4 0h1m1 0h1m1 0h2m1 0h1m5 0h2m3 0h2m1 0h1M7 17.5h2m2 0h3m1 0h1m1 0h3m1 0h1m2 0h2m1 0h1m1 0h1m1 0h1M2 18.5h2m1 0h2m2 0h1m1 0h2m1 0h4m1 0h3m1 0h4m1 0h1m1 0h1m1 0h1M3 19.5h2m1 0h3m1 0h1m1 0h1m3 0h2m1 0h2m1 0h1m4 0h1m1 0h1m1 0h1M2 20.5h3m3 0h1m2 0h4m1 0h4m1 0h1m1 0h2m3 0h1M1 21.5h3m1 0h3m3 0h5m1 0h1m2 0h1m2 0h1m1 0h2m1 0h5M1 22.5h2m2 0h2m3 0h1m3 0h1m1 0h2m3 0h3m9 0h1M3 23.5h1m1 0h1m1 0h4m1 0h1m1 0h3m2 0h3m5 0h7M2 24.5h3m5 0h1m1 0h2m2 0h1m1 0h1m2 0h1m1 0h1m1 0h1m6 0h1M1 25.5h1m1 0h2m1 0h2m1 0h2m4 0h1m1 0h2m1 0h1m1 0h1m1 0h6m2 0h1M9 26.5h1m1 0h1m1 0h3m1 0h1m4 0h1m2 0h1m3 0h2m2 0h1M1 27.5h7m1 0h2m2 0h2m1 0h7m1 0h2m1 0h1m1 0h1M1 28.5h1m5 0h1m1 0h1m1 0h1m1 0h1m1 0h1m2 0h3m4 0h1m3 0h1m1 0h3M1 29.5h1m1 0h3m1 0h1m2 0h3m4 0h4m2 0h1m1 0h9M1 30.5h1m1 0h3m1 0h1m1 0h6m2 0h1m2 0h1m2 0h7m1 0h2M1 31.5h1m1 0h3m1 0h1m1 0h1m1 0h2m3 0h3m2 0h2m1 0h2m2 0h2M1 32.5h1m5 0h1m2 0h2m3 0h1m2 0h1m2 0h1m4 0h1m4 0h1m1 0h1M1 33.5h7m1 0h1m3 0h3m2 0h3m1 0h2m2 0h1m2 0h2"/>
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1 text-[11px] text-emerald-200 group-hover/qr:text-white transition-colors mb-3">
                                <span>Pindai QR / Klik verifikasi</span>
                                <svg class="w-3 h-3 group-hover/qr:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </span>
                        </a>

                        <p class="text-xs font-semibold">{{ $sampleCertificate?->warungProfile->business_name ?? 'RM Padang Payakumbuh' }}</p>
                        <p class="text-[10px] text-emerald-200/80 font-mono mt-0.5">{{ $sampleCertificate?->certificate_code ?? 'WS-JMB-2026-0042' }}</p>

                        <div class="mt-3 pt-3 border-t border-emerald-700/80 flex items-center justify-center gap-1.5 text-[10px] text-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span>Status: Aktif 30 Hari</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ─── TENTANG / EKOSISTEM BERKELANJUTAN ─── --}}
    <section id="tentang" class="py-24 lg:py-28 bg-gradient-to-b from-[#f4f7f4] via-[#fafbfc] to-[#f0f6f2] border-t border-slate-200/80 relative overflow-hidden">
        
        {{-- Ambient soft glow --}}
        <div class="absolute top-1/3 -left-20 w-[32rem] h-[32rem] bg-emerald-200/25 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-[32rem] h-[32rem] bg-amber-200/25 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8 relative z-10">

            <div class="max-w-2xl mb-14 reveal">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-500/10 border border-amber-500/25 rounded-full text-[11px] font-bold text-[#D88909] tracking-wider uppercase mb-3 shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#D88909]"></span>
                    <span>Ekosistem Berkelanjutan</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Satu platform, empat kepentingan terintegrasi
                </h2>
                <p class="text-sm text-slate-600 mt-2.5 leading-relaxed">
                    Sinergi lintas sektor dari UMKM kuliner batangan hingga bahan bakar penerbangan global.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 gap-2.5 sm:gap-6">
                
                {{-- Card 01: Pemilik Warung --}}
                <div class="reveal delay-75 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/80 shadow-xs hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1.5 transition-all duration-300 space-y-2 sm:space-y-3 relative overflow-hidden group flex flex-col justify-between">
                    <div>
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                        <div class="w-7 h-7 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-emerald-100 text-[#076342] flex items-center justify-center font-extrabold text-xs sm:text-sm shadow-2xs mb-2 sm:mb-3">01</div>
                        <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-[#076342] transition-colors leading-snug">Pemilik warung kuliner</h3>
                        <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2">
                            Penghasilan tunai dari limbah jelantah, poin reward sembako, dan stiker Warung Sehat Dinkes.
                        </p>
                    </div>
                </div>

                {{-- Card 02: Konsumen --}}
                <div class="reveal delay-150 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/80 shadow-xs hover:border-[#D88909]/50 hover:shadow-xl hover:shadow-amber-950/5 hover:-translate-y-1.5 transition-all duration-300 space-y-2 sm:space-y-3 relative overflow-hidden group flex flex-col justify-between">
                    <div>
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#D88909] to-amber-400"></div>
                        <div class="w-7 h-7 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-amber-100 text-[#D88909] flex items-center justify-center font-extrabold text-xs sm:text-sm shadow-2xs mb-2 sm:mb-3">02</div>
                        <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-[#D88909] transition-colors leading-snug">Konsumen & masyarakat</h3>
                        <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2">
                            Verifikasi kebersihan minyak warung langganan cukup scan QR, aman dari minyak oplosan/daur ulang.
                        </p>
                    </div>
                </div>

                {{-- Card 03: Pemkot, DLH, Dinkes --}}
                <div class="reveal delay-225 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/80 shadow-xs hover:border-teal-500/50 hover:shadow-xl hover:shadow-teal-950/5 hover:-translate-y-1.5 transition-all duration-300 space-y-2 sm:space-y-3 relative overflow-hidden group flex flex-col justify-between">
                    <div>
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 to-cyan-500"></div>
                        <div class="w-7 h-7 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center font-extrabold text-xs sm:text-sm shadow-2xs mb-2 sm:mb-3">03</div>
                        <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-teal-700 transition-colors leading-snug">Pemkot, DLH & Dinkes</h3>
                        <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2">
                            Cegah fatberg pipa drainase kota, lindungi air Sungai Batanghari, pantau sanitasi 11 kecamatan.
                        </p>
                    </div>
                </div>

                {{-- Card 04: Pertamina SAF --}}
                <div class="reveal delay-300 bg-white/90 backdrop-blur-md p-3.5 sm:p-6 lg:p-7 rounded-xl sm:rounded-2xl border border-slate-200/80 shadow-xs hover:border-sky-500/50 hover:shadow-xl hover:shadow-sky-950/5 hover:-translate-y-1.5 transition-all duration-300 space-y-2 sm:space-y-3 relative overflow-hidden group flex flex-col justify-between">
                    <div>
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-sky-500 to-blue-500"></div>
                        <div class="w-7 h-7 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-extrabold text-xs sm:text-sm shadow-2xs mb-2 sm:mb-3">04</div>
                        <h3 class="text-xs sm:text-base font-bold text-slate-900 group-hover:text-sky-700 transition-colors leading-snug">PT Pertamina SAF</h3>
                        <p class="text-[11px] sm:text-[13px] text-slate-600 leading-snug sm:leading-relaxed mt-1 sm:mt-2">
                            Pasokan bahan baku bioavtur standar ISCC untuk penerbangan rendah emisi nasional & global.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ─── WILAYAH LAYANAN ─── --}}
    <section class="py-16 bg-gradient-to-b from-[#f4f7f4] via-[#fafbf9] to-white border-t border-slate-200/80 relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8 text-center relative z-10 reveal">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-[11px] font-bold text-[#076342] tracking-wider uppercase mb-3 shadow-2xs">
                <span class="w-1.5 h-1.5 rounded-full bg-[#076342]"></span>
                <span>Cakupan Armada Penjemputan</span>
            </div>
            <p class="text-base font-bold text-slate-800 mb-6">Menjangkau seluruh <strong class="text-[#076342]">11 kecamatan</strong> di Kota Jambi</p>
            <div class="flex flex-wrap items-center justify-center gap-2.5 max-w-3xl mx-auto">
                @foreach($subdistricts as $sub)
                <span class="px-4 py-2 bg-white hover:bg-[#076342] hover:text-white hover:border-[#076342] hover:shadow-md text-slate-700 rounded-xl text-xs font-semibold border border-slate-200 shadow-2xs transition-all duration-200 cursor-default flex items-center gap-1.5 group">
                    <svg class="w-3.5 h-3.5 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>{{ $sub->name }}</span>
                </span>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ─── PORTAL AKSES ─── --}}
    <section id="ekosistem" class="py-20 bg-slate-50/70 border-t border-slate-200/80 relative">
        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 reveal">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-[11px] font-bold text-[#076342] tracking-wider uppercase mb-2 shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#076342]"></span>
                        <span>Portal Sistem</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Akses berdasarkan peran</h3>
                </div>
                <p class="text-sm text-slate-600 max-w-md leading-relaxed">
                    Selain portal warung, tersedia antarmuka terintegrasi untuk petugas kurir lapangan dan command center GIS multi-stakeholder.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="reveal delay-75 bg-white p-6 sm:p-7 rounded-2xl border border-slate-200/90 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between gap-6 group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-base font-bold text-slate-900 group-hover:text-[#076342] transition-colors">Kurir Lapangan</h4>
                            <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-mono border border-slate-200/80">Mobile Ops</span>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">Antrean order jemput, navigasi peta GPS, formulir uji 3 mutu SAF, dan cetak manifest harian.</p>
                    </div>
                    <a href="{{ route('courier.dashboard') }}" class="text-xs font-bold text-[#076342] hover:text-[#065035] inline-flex items-center gap-1.5 group/link transition-colors pt-2 border-t border-slate-100">
                        <span>Buka portal kurir</span>
                        <span class="group-hover/link:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>

                <div class="reveal delay-150 bg-white p-6 sm:p-7 rounded-2xl border border-slate-200/90 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between gap-6 group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-base font-bold text-slate-900 group-hover:text-[#076342] transition-colors">Command Center</h4>
                            <span class="text-[10px] bg-emerald-50 text-[#076342] px-2 py-0.5 rounded-md font-mono border border-emerald-200/60 font-semibold">GIS Live</span>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">Dashboard monitoring 11 kecamatan untuk Pemkot, DLH, Dinkes, KLH, dan manajemen Pertamina.</p>
                    </div>
                    <a href="{{ route('stakeholder.dashboard', ['role' => 'pemkot']) }}" class="text-xs font-bold text-[#076342] hover:text-[#065035] inline-flex items-center gap-1.5 group/link transition-colors pt-2 border-t border-slate-100">
                        <span>Buka command center</span>
                        <span class="group-hover/link:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>

                <div class="reveal delay-225 bg-white p-6 sm:p-7 rounded-2xl border border-slate-200/90 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between gap-6 group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-base font-bold text-slate-900 group-hover:text-[#076342] transition-colors">Dashboard Warung</h4>
                            <span class="text-[10px] bg-amber-50 text-amber-800 px-2 py-0.5 rounded-md font-mono border border-amber-200/60 font-semibold">Mitra UMKM</span>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">Ajukan jemput limbah, pantau saldo kas, cek status stiker kepatuhan, dan tukar poin reward.</p>
                    </div>
                    <a href="{{ route('mobile.login') }}" class="text-xs font-bold text-[#076342] hover:text-[#065035] inline-flex items-center gap-1.5 group/link transition-colors pt-2 border-t border-slate-100">
                        <span>Masuk akun warung</span>
                        <span class="group-hover/link:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>


    {{-- ─── CTA PENUTUP (FLOATING CARD DESIGN) ─── --}}
    <section class="py-14 sm:py-20 bg-slate-50/70 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="reveal relative bg-gradient-to-br from-[#076342] via-[#065035] to-[#043d28] text-white rounded-3xl p-8 sm:p-12 lg:p-14 text-center shadow-2xl border-2 border-emerald-500/20 overflow-hidden">
                {{-- Subtle ambient inner glow --}}
                <div class="absolute -top-24 -left-24 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute top-0 right-1/4 w-60 h-60 bg-emerald-300/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 backdrop-blur-xs border border-white/20 rounded-full text-[11px] font-bold text-emerald-200 tracking-wider uppercase mb-4 shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                        <span>Gerakan Ekonomi Sirkular</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-snug">
                        Siap menjadi bagian dari gerakan Kota Jambi bersih dan berdaya?
                    </h2>
                    <p class="text-sm sm:text-base text-emerald-100/90 mt-3.5 leading-relaxed">
                        Daftarkan warung Anda hari ini. Petugas kami jemput di lokasi, Anda terima saldo tunai langsung, dan warung Anda mendapat sertifikat bebas jelantah berbahaya.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3.5 justify-center mt-8">
                        <a href="{{ route('mobile.register.step1') }}" class="px-7 py-3.5 bg-white text-[#076342] font-bold text-sm rounded-xl hover:bg-slate-50 active:scale-[0.98] shadow-lg hover:shadow-xl transition-all duration-200">
                            Daftar warung gratis &rarr;
                        </a>
                        <a href="{{ route('mobile.login') }}" class="px-7 py-3.5 bg-white/10 backdrop-blur-xs text-white font-semibold text-sm rounded-xl border border-white/25 hover:bg-white/20 active:scale-[0.98] transition-all duration-200">
                            Sudah punya akun? Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ─── FOOTER ─── --}}
    <footer class="bg-slate-950 text-slate-400 py-10 text-[12px]">
        <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pb-8 border-b border-slate-800">
                <div class="col-span-2 md:col-span-1 space-y-3">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/logo-official.jpg') }}" alt="Logo" class="w-7 h-7 rounded-lg bg-white p-0.5">
                        <span class="text-sm font-bold text-white"><span class="text-emerald-400">Siklus</span><span class="text-amber-400">Jambi</span></span>
                    </div>
                    <p class="text-slate-500 leading-relaxed max-w-xs">
                        Platform ekonomi sirkular limbah kuliner Kota Jambi & rantai pasok Bioavtur SAF PT Pertamina Patra Niaga.
                    </p>
                </div>

                <div class="space-y-2">
                    <h5 class="text-white font-semibold text-[11px] uppercase tracking-wide">Navigasi</h5>
                    <a href="#cara-kerja" class="block hover:text-white transition-colors">Cara Kerja</a>
                    <a href="#warung-sehat" class="block hover:text-white transition-colors">Warung Sehat</a>
                    <a href="#tentang" class="block hover:text-white transition-colors">Tentang</a>
                </div>

                <div class="space-y-2">
                    <h5 class="text-white font-semibold text-[11px] uppercase tracking-wide">Akses</h5>
                    <a href="{{ route('mobile.login') }}" class="block hover:text-white transition-colors">Masuk Akun</a>
                    <a href="{{ route('mobile.register.step1') }}" class="block hover:text-white transition-colors">Daftar Baru</a>
                    <a href="{{ route('courier.dashboard') }}" class="block hover:text-white transition-colors">Portal Kurir</a>
                    <a href="{{ route('stakeholder.dashboard') }}" class="block hover:text-white transition-colors">Command Center</a>
                </div>

                <div class="space-y-2">
                    <h5 class="text-white font-semibold text-[11px] uppercase tracking-wide">Mitra Terkait</h5>
                    <p class="text-slate-500 leading-relaxed">Pemerintah Kota Jambi · Dinas Kesehatan · Dinas Lingkungan Hidup · Kementerian LH · PT Pertamina Patra Niaga</p>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-500">
                <p>&copy; {{ date('Y') }} SiklusJambi</p>
                <p>Akselerasi Ekonomi Sirkular Berbasis Komunitas</p>
            </div>
        </div>
    </footer>


    {{-- ─── CLIENT-SIDE SCRIPTS & ANIMATION ENGINE ─── --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Mobile Menu Toggle with Backdrop Blur
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileBackdrop = document.getElementById('mobile-menu-backdrop');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            function toggleMobileMenu(show) {
                if (!mobileMenu) return;
                const isHidden = typeof show === 'boolean' ? !show : !mobileMenu.classList.contains('hidden');
                mobileMenu.classList.toggle('hidden', isHidden);
                if (mobileBackdrop) {
                    mobileBackdrop.classList.toggle('hidden', isHidden);
                }
                if (menuBtn) menuBtn.setAttribute('aria-expanded', (!isHidden).toString());
                if (iconOpen && iconClose) {
                    iconOpen.classList.toggle('hidden', !isHidden);
                    iconClose.classList.toggle('hidden', isHidden);
                }
                // Lock background scroll when menu is active on mobile
                if (!isHidden) {
                    document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
                } else {
                    document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
                }
            }

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleMobileMenu();
                });

                if (mobileBackdrop) {
                    mobileBackdrop.addEventListener('click', () => toggleMobileMenu(false));
                }

                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => toggleMobileMenu(false));
                });

                document.addEventListener('click', (e) => {
                    if (!mobileMenu.classList.contains('hidden') && !mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
                        toggleMobileMenu(false);
                    }
                });

                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) {
                        toggleMobileMenu(false);
                    }
                }, { passive: true });
            }

            // 2. Reading Scroll Progress Bar & Header Shadow
            const progressBar = document.getElementById('scroll-progress');
            const header = document.getElementById('site-header');
            window.addEventListener('scroll', () => {
                const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                if (progressBar) progressBar.style.width = scrolled + '%';

                if (header) {
                    if (winScroll > 20) {
                        header.classList.add('shadow-sm');
                    } else {
                        header.classList.remove('shadow-sm');
                    }
                }
            }, { passive: true });

            // 3. Scroll Reveal System using IntersectionObserver
            const revealElements = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window) {
                const revealObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.12,
                    rootMargin: '0px 0px -40px 0px'
                });

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('revealed'));
            }

            // 4. Number Counters with Smooth Count-Up Animation
            const counters = document.querySelectorAll('.stat-counter');
            let countersAnimated = false;
            const statsSection = document.getElementById('stats-section');

            function animateCounters() {
                if (countersAnimated) return;
                countersAnimated = true;

                counters.forEach(counter => {
                    const target = parseFloat(counter.getAttribute('data-target'));
                    const decimals = parseInt(counter.getAttribute('data-decimals') || '0');
                    const duration = 1400; // ms
                    const startTime = performance.now();

                    function updateNumber(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        // Ease out cubic
                        const easeOut = 1 - Math.pow(1 - progress, 3);
                        const currentVal = target * easeOut;

                        if (decimals > 0) {
                            counter.textContent = currentVal.toLocaleString('id-ID', {
                                minimumFractionDigits: decimals,
                                maximumFractionDigits: decimals
                            });
                        } else {
                            counter.textContent = Math.round(currentVal).toLocaleString('id-ID');
                        }

                        if (progress < 1) {
                            requestAnimationFrame(updateNumber);
                        } else {
                            // Ensure final value matches exactly
                            if (decimals > 0) {
                                counter.textContent = target.toLocaleString('id-ID', {
                                    minimumFractionDigits: decimals,
                                    maximumFractionDigits: decimals
                                });
                            } else {
                                counter.textContent = Math.round(target).toLocaleString('id-ID');
                            }
                        }
                    }

                    requestAnimationFrame(updateNumber);
                });
            }

            if (statsSection && 'IntersectionObserver' in window) {
                const statsObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounters();
                            statsObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.25 });
                statsObserver.observe(statsSection);
            } else {
                animateCounters();
            }
        });
    </script>

            {{-- ─── 3D WEBGL2 GOLDEN OIL BACKGROUND ─── --}}
    <script>
    (function() {
        'use strict';

        const RENDER_SCALE = 0.75;
        const PREFRS_REDUCED = window.matchMedia('(prefers-reduced-motion: reduce)');

        let gl = null;
        let program = null;
        let vao = null;
        let vbo = null;
        let animFrame = null;
        let canvas = null;
        let heroSection = null;
        let startTime = 0;
        let isRunning = false;
        let resizeTimeout = null;

        // Uniform locations
        let uTime, uResolution, uMouse;

        // Mouse interaction state (smooth lerp)
        let mouseX = 0, mouseY = 0;
        let targetMouseX = 0, targetMouseY = 0;

        // ─── SHADERS ───

        const VERT_SRC = `#version 300 es
            precision highp float;
            in vec2 aPos;
            void main() {
                gl_Position = vec4(aPos, 0.0, 1.0);
            }
        `;

        const FRAG_SRC = `#version 300 es
            precision highp float;
            out vec4 fragColor;

            uniform float uTime;
            uniform vec2 uResolution;
            uniform vec2 uMouse;

            // ─── SDF Primitives ───
            float sdSphere(vec3 p, float r) {
                return length(p) - r;
            }

            // Smooth minimum for organic liquid metaball merging
            float smin(float a, float b, float k) {
                float h = clamp(0.5 + 0.5 * (b - a) / k, 0.0, 1.0);
                return mix(b, a, h) - k * h * (1.0 - h);
            }

            // ─── Golden Oil Scene (Placed in Right Empty Zone beside card) ───
            float sceneSDF(vec3 p) {
                float t = uTime * 0.42;

                // Main buoyant oil droplet (in open right quadrant, pulsing organically)
                vec3 c1 = vec3(3.1 + sin(t * 0.5) * 0.3, 0.1 + cos(t * 0.42) * 0.35, sin(t * 0.3) * 0.25);
                // Upper flowing globule
                vec3 c2 = vec3(3.5 + cos(t * 0.6) * 0.25, 1.0 + sin(t * 0.5) * 0.3, cos(t * 0.4) * 0.2);
                // Lower merging globule
                vec3 c3 = vec3(2.7 + sin(t * 0.42) * 0.3, -0.8 + cos(t * 0.55) * 0.3, sin(t * 0.5) * 0.2);
                // Side floating droplet on right
                vec3 c4 = vec3(4.2 + cos(t * 0.32) * 0.3, -0.1 + sin(t * 0.65) * 0.25, cos(t * 0.6) * 0.18);
                // Small droplet floating near card shoulder
                vec3 c5 = vec3(1.9 + sin(t * 0.65) * 0.2, 0.6 + cos(t * 0.5) * 0.2, sin(t * 0.45) * 0.15);
                // Floating droplet below
                vec3 c6 = vec3(3.6 + sin(t * 0.35) * 0.25, -0.9 + cos(t * 0.45) * 0.25, cos(t * 0.55) * 0.15);

                float d = sdSphere(p - c1, 1.25 + sin(t * 0.65) * 0.1);
                d = smin(d, sdSphere(p - c2, 0.82 + cos(t * 0.55) * 0.08), 0.85);
                d = smin(d, sdSphere(p - c3, 0.88 + sin(t * 0.48) * 0.08), 0.85);
                d = smin(d, sdSphere(p - c4, 0.65 + cos(t * 0.7) * 0.06), 0.75);
                d = smin(d, sdSphere(p - c5, 0.58 + sin(t * 0.6) * 0.05), 0.7);
                d = smin(d, sdSphere(p - c6, 0.60 + cos(t * 0.4) * 0.06), 0.75);

                return d;
            }

            // ─── Normal via gradient ───
            vec3 calcNormal(vec3 p) {
                const float h = 0.001;
                return normalize(vec3(
                    sceneSDF(p + vec3(h, 0.0, 0.0)) - sceneSDF(p - vec3(h, 0.0, 0.0)),
                    sceneSDF(p + vec3(0.0, h, 0.0)) - sceneSDF(p - vec3(0.0, h, 0.0)),
                    sceneSDF(p + vec3(0.0, 0.0, h)) - sceneSDF(p - vec3(0.0, 0.0, h))
                ));
            }

            void main() {
                vec2 uv = (gl_FragCoord.xy * 2.0 - uResolution) / min(uResolution.x, uResolution.y);

                // Subtle parallax camera shift from mouse
                vec3 ro = vec3(uMouse.x * 0.25, uMouse.y * 0.2, 5.5);
                vec3 rd = normalize(vec3(uv - uMouse * 0.04, -1.8));

                // ─── Ray Marching ───
                float totalDist = 0.0;
                float minDist = 100.0;
                bool hit = false;
                vec3 hitPos;

                for (int i = 0; i < 64; i++) {
                    vec3 p = ro + rd * totalDist;
                    float d = sceneSDF(p);
                    minDist = min(minDist, d);

                    if (d < 0.0015) {
                        hit = true;
                        hitPos = p;
                        break;
                    }
                    totalDist += d;
                    if (totalDist > 14.0) break;
                }

                if (!hit) {
                    // Warm golden ambient glow halo around liquid boundary
                    float glow = exp(-minDist * 1.6) * 0.28;
                    vec3 glowColor = vec3(0.96, 0.68, 0.12) * glow;
                    fragColor = vec4(glowColor, glow * 0.75);
                    return;
                }

                // ─── Shading & Lighting ───
                vec3 normal = calcNormal(hitPos);
                vec3 lightDir1 = normalize(vec3(0.7 + uMouse.x * 0.3, 1.2 + uMouse.y * 0.3, 0.8));
                vec3 lightDir2 = normalize(vec3(-0.6, 0.4, 0.6));
                vec3 viewDir = normalize(ro - hitPos);

                // Rich Golden Oil Palette (Minyak Jelantah Keemasan)
                vec3 deepAmber   = vec3(0.70, 0.35, 0.02); // Deep viscous amber base
                vec3 goldenOil   = vec3(0.96, 0.64, 0.06); // Pure luminous liquid gold (#F59E0B)
                vec3 honeyGlow   = vec3(1.00, 0.85, 0.32); // Honey crest illumination
                vec3 specWhite   = vec3(1.00, 0.98, 0.92); // Glossy highlight shine

                // Fresnel rim glow (glassy oil reflection at edges)
                float NdotV = clamp(dot(normal, viewDir), 0.0, 1.0);
                float fresnel = pow(1.0 - NdotV, 3.0);

                // Two-light diffuse model
                float diff1 = max(dot(normal, lightDir1), 0.0);
                float diff2 = max(dot(normal, lightDir2), 0.0) * 0.35;

                // Blinn-Phong dual specular sheen for thick liquid shine
                vec3 halfDir1 = normalize(lightDir1 + viewDir);
                float spec1 = pow(clamp(dot(normal, halfDir1), 0.0, 1.0), 64.0);

                vec3 halfDir2 = normalize(lightDir2 + viewDir);
                float spec2 = pow(clamp(dot(normal, halfDir2), 0.0, 1.0), 32.0) * 0.45;

                // Subsurface Scattering (SSS) warmth
                float sss = pow(max(dot(viewDir, -lightDir1), 0.0), 2.0) * 0.35;

                // Compose final 3D liquid color
                vec3 color = mix(deepAmber, goldenOil, diff1 * 0.75 + 0.25);
                color = mix(color, honeyGlow, sss);
                color += specWhite * (spec1 + spec2) * 0.85;
                color += vec3(1.0, 0.88, 0.45) * fresnel * 0.65;
                color += goldenOil * 0.15; // Ambient radiance

                // ─── Alpha: rich liquid volume with soft edge falloff ───
                float alpha = mix(0.65, 0.88, diff1);
                alpha += fresnel * 0.25;
                alpha = clamp(alpha, 0.0, 0.95);

                fragColor = vec4(color, alpha);
            }
        `;

        // ─── Shader compilation ───
        function createShader(type, src) {
            const shader = gl.createShader(type);
            gl.shaderSource(shader, src);
            gl.compileShader(shader);
            if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                console.error('Oil shader error:', gl.getShaderInfoLog(shader));
                gl.deleteShader(shader);
                return null;
            }
            return shader;
        }

        function createProgram(vSrc, fSrc) {
            const vs = createShader(gl.VERTEX_SHADER, vSrc);
            const fs = createShader(gl.FRAGMENT_SHADER, fSrc);
            if (!vs || !fs) return null;

            const prog = gl.createProgram();
            gl.attachShader(prog, vs);
            gl.attachShader(prog, fs);
            gl.linkProgram(prog);

            gl.deleteShader(vs);
            gl.deleteShader(fs);

            if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) {
                console.error('Oil program error:', gl.getProgramInfoLog(prog));
                gl.deleteProgram(prog);
                return null;
            }
            return prog;
        }

        // ─── Mouse interaction handlers ───
        function onMouseMove(e) {
            if (!heroSection) return;
            const rect = heroSection.getBoundingClientRect();
            if (rect.width > 0 && rect.height > 0) {
                const x = ((e.clientX - rect.left) / rect.width) * 2.0 - 1.0;
                const y = -(((e.clientY - rect.top) / rect.height) * 2.0 - 1.0);
                targetMouseX = Math.max(-1.0, Math.min(1.0, x));
                targetMouseY = Math.max(-1.0, Math.min(1.0, y));
            }
        }

        function onMouseLeave() {
            targetMouseX = 0;
            targetMouseY = 0;
        }

        // ─── Init WebGL ───
        function init() {
            if (!shouldRun()) return;
            try {
                canvas = document.getElementById('oil-3d-canvas');
                if (!canvas) return;

                heroSection = document.getElementById('hero-section');
                if (!heroSection) return;

                gl = canvas.getContext('webgl2', {
                    alpha: true,
                    premultipliedAlpha: false,
                    antialias: false,
                    powerPreference: 'default',
                    preserveDrawingBuffer: false
                });

                if (!gl) {
                    console.warn('[SiklusJambi] WebGL2 not supported on this browser');
                    canvas.style.display = 'none';
                    heroSection.classList.remove('oil-3d-active');
                    return;
                }

                program = createProgram(VERT_SRC, FRAG_SRC);
                if (!program) {
                    cleanup();
                    canvas.style.display = 'none';
                    return;
                }

                gl.useProgram(program);

                uTime = gl.getUniformLocation(program, 'uTime');
                uResolution = gl.getUniformLocation(program, 'uResolution');
                uMouse = gl.getUniformLocation(program, 'uMouse');

                const quadVerts = new Float32Array([
                    -1, -1,  1, -1,  -1, 1,
                    -1,  1,  1, -1,   1, 1
                ]);

                vao = gl.createVertexArray();
                gl.bindVertexArray(vao);

                vbo = gl.createBuffer();
                gl.bindBuffer(gl.ARRAY_BUFFER, vbo);
                gl.bufferData(gl.ARRAY_BUFFER, quadVerts, gl.STATIC_DRAW);

                const aPos = gl.getAttribLocation(program, 'aPos');
                gl.enableVertexAttribArray(aPos);
                gl.vertexAttribPointer(aPos, 2, gl.FLOAT, false, 0, 0);

                gl.enable(gl.BLEND);
                gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);

                heroSection.addEventListener('mousemove', onMouseMove, { passive: true });
                heroSection.addEventListener('mouseleave', onMouseLeave, { passive: true });

                resizeCanvas();
                startTime = performance.now() / 1000;
                isRunning = true;
                canvas.style.display = 'block';
                heroSection.classList.add('oil-3d-active');
                console.log('[SiklusJambi] 3D Golden Oil WebGL2 initialized successfully');
                render();
            } catch (err) {
                console.error('[SiklusJambi 3D Oil Error]', err);
                if (canvas) canvas.style.display = 'none';
                if (heroSection) heroSection.classList.remove('oil-3d-active');
            }
        }

        function resizeCanvas() {
            if (!canvas || !gl || !heroSection) return;
            const rect = heroSection.getBoundingClientRect();
            const w = Math.floor((rect.width || heroSection.offsetWidth || window.innerWidth) * RENDER_SCALE);
            const h = Math.floor((rect.height || heroSection.offsetHeight || 600) * RENDER_SCALE);

            if (w <= 0 || h <= 0) return;

            if (canvas.width !== w || canvas.height !== h) {
                canvas.width = w;
                canvas.height = h;
            }
            gl.viewport(0, 0, w, h);
        }

        function render() {
            if (!isRunning || !gl || !program) return;

            // Accessibility: If user prefers reduced motion, render a frozen beautiful frame
            let t = 1.25;
            if (!PREFRS_REDUCED.matches) {
                t = performance.now() / 1000 - startTime;
            }

            gl.uniform1f(uTime, t);
            gl.uniform2f(uResolution, canvas.width, canvas.height);

            // Smooth mouse interpolation
            mouseX += (targetMouseX - mouseX) * 0.04;
            mouseY += (targetMouseY - mouseY) * 0.04;
            gl.uniform2f(uMouse, mouseX, mouseY);

            gl.clearColor(0, 0, 0, 0);
            gl.clear(gl.COLOR_BUFFER_BIT);

            gl.bindVertexArray(vao);
            gl.drawArrays(gl.TRIANGLES, 0, 6);

            animFrame = requestAnimationFrame(render);
        }

        // ─── Cleanup: free GPU resources ───
        function cleanup() {
            isRunning = false;

            if (animFrame) {
                cancelAnimationFrame(animFrame);
                animFrame = null;
            }

            if (heroSection) {
                heroSection.removeEventListener('mousemove', onMouseMove);
                heroSection.removeEventListener('mouseleave', onMouseLeave);
                heroSection.classList.remove('oil-3d-active');
            }

            if (canvas) {
                canvas.style.display = 'none';
            }

            if (gl) {
                if (program) { gl.deleteProgram(program); program = null; }
                if (vbo) { gl.deleteBuffer(vbo); vbo = null; }
                if (vao) { gl.deleteVertexArray(vao); vao = null; }
                gl = null;
            }
        }

        // ─── Responsive guard (run on desktop >= 1024px only) ───
        function shouldRun() {
            return window.innerWidth >= 1024;
        }

        // ─── Responsive resize handler ───
        function handleResize() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                if (shouldRun()) {
                    if (!isRunning) {
                        init();
                    } else {
                        resizeCanvas();
                    }
                } else {
                    if (isRunning) {
                        cleanup();
                    }
                }
            }, 200);
        }

        // ─── Bootstrap ───
        function bootstrap() {
            if (shouldRun()) {
                init();
            }
            window.addEventListener('resize', handleResize, { passive: true });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', bootstrap);
        } else {
            bootstrap();
        }

        // Secondary fallback on window load
        window.addEventListener('load', function() {
            if (shouldRun() && !isRunning) {
                init();
            }
        });
    })();
    </script>

</body>
</html>
