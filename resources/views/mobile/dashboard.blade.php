@extends('layouts.mobile', ['showBottomNav' => true, 'activeTab' => 'beranda'])

@section('content')
<div class="flex-1 w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8 space-y-5 pb-24 md:pb-12">

    <!-- Top Greeting & Header Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-xs gap-3">
        <div class="space-y-1">
            <div class="flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#076342] ring-4 ring-emerald-100 shrink-0"></span>
                <h1 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">
                    {{ $warung->business_name ?? 'Rumah Makan Padang Payakumbuh' }}
                </h1>
            </div>
            <p class="text-xs text-slate-500 font-medium pl-4">
                {{ $user->name ?? 'Wisnu Nugroho' }} &bull; Kec. {{ $warung->subdistrict->name ?? 'Jelutung' }}, Kota Jambi
            </p>
        </div>
        
        <div class="flex items-center space-x-3 pl-4 sm:pl-0">
            <!-- Warung Sehat Verified Badge -->
            <a href="{{ route('mobile.certificate.view') }}" 
               class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 text-[#076342] border border-emerald-200/80 text-xs font-bold hover:bg-emerald-100 transition-colors shadow-2xs"
               title="Lihat Sertifikasi Warung Sehat Dinkes">
                <svg class="w-4 h-4 text-[#076342]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>Warung Sehat Dinkes</span>
            </a>

            <!-- Notification Bell -->
            <button class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-600 shadow-2xs relative hover:bg-slate-100 transition-colors"
                    title="Pemberitahuan">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="w-2 h-2 rounded-full bg-amber-500 ring-2 ring-white absolute top-1.5 right-1.5"></span>
            </button>
        </div>
    </div>

    <!-- Responsive Layout: Stacks naturally on mobile, 2 columns on desktop -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-6 items-start">
        
        <!-- LEFT COLUMN: Wallet Card & Certificate Widget (5 Cols on lg) -->
        <div class="lg:col-span-5 space-y-5">
            
            <!-- Wallet Card (Clean & Focused) -->
            <div class="w-full rounded-3xl bg-white shadow-sm border border-slate-200/80 overflow-hidden">
                <!-- Top Emerald Gradient Balance Section -->
                <div class="bg-gradient-to-br from-[#076342] via-[#065035] to-[#0A5C36] px-6 py-6 text-white relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/5 rounded-full blur-xl pointer-events-none"></div>
                    
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-emerald-200 uppercase tracking-wider">
                            Dompet SiklusJambi
                        </span>
                        <span class="text-[11px] font-bold bg-white/15 px-2.5 py-0.5 rounded-full text-white border border-white/20">
                            1 Liter = 1 Poin Emas
                        </span>
                    </div>

                    <div class="space-y-1">
                        <span class="text-xs text-emerald-100/90 font-medium block">Saldo Siap Tarik</span>
                        <div class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                            Rp{{ number_format($wallet->balance ?? 1376000, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="mt-4 pt-3.5 border-t border-white/15 flex items-center justify-between text-xs">
                        <span class="text-emerald-100/90 font-medium">Poin Terkumpul:</span>
                        <span class="font-extrabold text-amber-300 text-sm">
                            {{ $rewardPoint->total_points ?? 380 }} Poin
                        </span>
                    </div>
                </div>

                <!-- Bottom Actions (Transfer & Riwayat) -->
                <div class="grid grid-cols-2 divide-x divide-slate-100 py-3 bg-white text-xs font-bold text-slate-700">
                    <button onclick="alert('Fitur transfer langsung ke rekening Bank BRI/BCA Anda sedang disiapkan.')" 
                            class="flex items-center justify-center space-x-2 py-1.5 hover:text-[#076342] transition-colors">
                        <svg class="w-4 h-4 text-[#076342]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Tarik Saldo</span>
                    </button>
                    <a href="{{ route('mobile.schedule') }}" 
                       class="flex items-center justify-center space-x-2 py-1.5 hover:text-[#076342] transition-colors">
                        <svg class="w-4 h-4 text-[#076342]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        <span>Riwayat</span>
                    </a>
                </div>
            </div>

            <!-- PRIMARY CTA BANNER (Mobile-Only: placed directly under wallet for immediate one-tap access) -->
            <div class="block lg:hidden">
                <a href="{{ route('mobile.pickup.create') }}" 
                   class="block w-full bg-gradient-to-r from-[#076342] via-[#065035] to-[#0A5C36] hover:from-[#065035] text-white p-5 rounded-3xl shadow-md shadow-emerald-950/15 active:scale-[0.99] transition-all relative overflow-hidden group">
                    <div class="flex items-center justify-between relative z-10">
                        <div class="space-y-1 max-w-[240px]">
                            <div class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-white/15 text-emerald-200 text-[10px] font-bold border border-white/20">
                                <span>Harga Resmi</span>
                                <span>&bull;</span>
                                <span class="text-amber-300">Rp{{ number_format($currentPrice ?? 7500, 0, ',', '.') }}/L</span>
                            </div>
                            <h2 class="text-base font-black text-white tracking-tight">
                                Jemput Limbah Sekarang
                            </h2>
                            <p class="text-[11px] text-emerald-100/90 leading-snug">
                                Kurir terdekat siap jemput langsung ke warung.
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-2xl bg-white/15 border border-white/25 flex items-center justify-center shrink-0 text-white shadow-sm ml-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- ACTIVE PICKUP STATUS TRACKER (Mobile-Only: shown right after CTA if active) -->
            @if(isset($activeOrder) && $activeOrder)
            <div class="block lg:hidden w-full bg-white rounded-3xl p-4 sm:p-5 border border-amber-200/90 shadow-xs space-y-3 relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-amber-400 to-[#D88909]"></div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                        </span>
                        <h3 class="text-xs font-bold text-slate-900">Penjemputan Berjalan</h3>
                    </div>
                    <span class="font-mono text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">
                        #{{ $activeOrder->order_number }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="bg-slate-50 p-2 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Estimasi Volume</span>
                        <span class="font-bold text-slate-800">{{ $activeOrder->estimated_volume }} Liter</span>
                    </div>
                    <div class="bg-slate-50 p-2 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Estimasi Saldo</span>
                        <span class="font-bold text-[#076342]">Rp{{ number_format($activeOrder->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="pt-1 flex items-center justify-between text-xs">
                    <span class="text-[10px] text-amber-700 font-semibold">Kurir Dalam Antrean</span>
                    <a href="{{ route('mobile.schedule') }}" class="font-bold text-[#076342] hover:underline flex items-center space-x-1">
                        <span>Lihat Jadwal</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @endif

            <!-- Warung Sehat Certificate Card -->
            <div class="w-full bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-3.5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900">Sertifikat Warung Sehat</h3>
                            <p class="text-[11px] text-slate-500">{{ $certificate->certificate_code ?? 'WS-JMB-2026-0042' }}</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                        Aktif 30 Hari
                    </span>
                </div>

                <div class="p-3 bg-slate-50 rounded-2xl flex items-center justify-between text-xs">
                    <div>
                        <span class="text-[11px] text-slate-500 block">Jelantah Terselamatkan</span>
                        <span class="font-extrabold text-slate-900 text-sm">{{ $certificate->total_liters_saved ?? 184 }} Liter</span>
                    </div>
                    <div class="text-right">
                        <span class="text-[11px] text-slate-500 block">Inspeksi Dinkes</span>
                        <span class="font-semibold text-slate-700 text-xs">Lolos Higienis</span>
                    </div>
                </div>

                <div class="pt-1 flex items-center justify-between text-xs">
                    <span class="text-slate-500 text-[11px]">Stiker QR terpasang di etalase</span>
                    <a href="{{ route('mobile.certificate.view') }}" class="font-bold text-[#076342] hover:underline flex items-center space-x-1">
                        <span>Buka Stiker QR</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: Desktop Primary Action, Desktop Active Order & Quick Services (7 Cols on lg) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- PRIMARY CTA BANNER (Desktop-Only: at the top of the right column) -->
            <a href="{{ route('mobile.pickup.create') }}" 
               class="hidden lg:block w-full bg-gradient-to-r from-[#076342] via-[#065035] to-[#0A5C36] hover:from-[#065035] hover:to-[#084a2c] text-white p-5 sm:p-6 rounded-3xl shadow-md shadow-emerald-950/15 hover:shadow-xl transition-all relative overflow-hidden group">
                
                <div class="flex items-center justify-between relative z-10">
                    <div class="space-y-1.5 max-w-sm">
                        <div class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-white/15 text-emerald-200 text-[11px] font-bold border border-white/20">
                            <span>Harga Patokan Resmi</span>
                            <span>&bull;</span>
                            <span class="text-amber-300">Rp{{ number_format($currentPrice ?? 7500, 0, ',', '.') }}/L</span>
                        </div>
                        <h2 class="text-lg sm:text-xl font-black text-white tracking-tight">
                            Jemput Limbah Sekarang
                        </h2>
                        <p class="text-xs text-emerald-100/90 leading-relaxed font-normal">
                            Kurir armada Kota Jambi ditugaskan otomatis via GPS. Minimal 10L gratis penjemputan.
                        </p>
                    </div>

                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white/15 border border-white/25 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:bg-white group-hover:text-[#076342] transition-all duration-200 text-white shadow-sm ml-3">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- ACTIVE PICKUP STATUS TRACKER (Desktop-Only) -->
            @if(isset($activeOrder) && $activeOrder)
            <div class="hidden lg:block w-full bg-white rounded-3xl p-5 border border-amber-200/90 shadow-xs space-y-3 relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-amber-400 to-[#D88909]"></div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                        </span>
                        <h3 class="text-xs font-bold text-slate-900">Penjemputan Sedang Berjalan</h3>
                    </div>
                    <span class="font-mono text-[11px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">
                        #{{ $activeOrder->order_number }}
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-2.5 pt-1 text-xs">
                    <div class="bg-slate-50 p-2.5 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Estimasi Volume</span>
                        <span class="font-bold text-slate-800">{{ $activeOrder->estimated_volume }} Liter</span>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Estimasi Saldo</span>
                        <span class="font-bold text-[#076342]">Rp{{ number_format($activeOrder->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Status Kurir</span>
                        <span class="font-bold text-amber-700">Dalam Antrean Jemput</span>
                    </div>
                </div>

                @if($activeOrder->notes)
                <p class="text-[11px] text-slate-500 bg-amber-50/60 border border-amber-100 px-3 py-1.5 rounded-xl">
                    <span class="font-semibold text-amber-900">Catatan:</span> {{ $activeOrder->notes }}
                </p>
                @endif

                <div class="pt-1 flex items-center justify-between text-xs">
                    <span class="text-[11px] text-slate-400">Kurir membawa timbangan digital & uji QC</span>
                    <a href="{{ route('mobile.schedule') }}" class="font-bold text-[#076342] hover:underline flex items-center space-x-1">
                        <span>Pantau Jadwal</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @endif

            <!-- Quick Service Menu (Clean 6 Grid Items) -->
            <div class="space-y-3">
                <div class="flex justify-between items-center px-1">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-400">
                        Menu Layanan SiklusJambi
                    </h3>
                    <span class="text-xs font-bold text-emerald-700">11 Kecamatan</span>
                </div>

                <div class="grid grid-cols-3 gap-2.5 sm:gap-4">
                    
                    <!-- 1. Lokasi Jemput -->
                    <a href="{{ route('mobile.profile.location') }}" 
                       class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center space-y-2 hover:border-[#076342] hover:shadow-sm transition-all group">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800 text-center leading-tight">Lokasi Saya</span>
                    </a>

                    <!-- 2. Tukar Poin -->
                    <a href="{{ route('mobile.rewards') }}" 
                       class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center space-y-2 hover:border-[#076342] hover:shadow-sm transition-all group">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800 text-center leading-tight">Tukar Poin</span>
                    </a>

                    <!-- 3. Hubungi MinSik -->
                    <a href="https://wa.me/6281234567890?text=Halo%20MinSik,%20saya%20ingin%20tanya%20seputar%20penjemputan%20jelantah" 
                       target="_blank" 
                       class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center space-y-2 hover:border-[#076342] hover:shadow-sm transition-all group">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800 text-center leading-tight">Bantuan MinSik</span>
                    </a>

                    <!-- 4. Harga Limbah -->
                    <a href="{{ route('mobile.prices') }}" 
                       class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center space-y-2 hover:border-[#076342] hover:shadow-sm transition-all group">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800 text-center leading-tight">Harga Limbah</span>
                    </a>

                    <!-- 5. Dampak Kita -->
                    <a href="{{ route('mobile.impact') }}" 
                       class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center space-y-2 hover:border-[#076342] hover:shadow-sm transition-all group">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800 text-center leading-tight">Dampak Kita</span>
                    </a>

                    <!-- 6. Berita & Info -->
                    <a href="{{ route('mobile.news') }}" 
                       class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col items-center justify-center space-y-2 hover:border-[#076342] hover:shadow-sm transition-all group">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800 text-center leading-tight">Berita Kota</span>
                    </a>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection
