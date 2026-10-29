@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-5 pb-16">

    <!-- Header with Back Button -->
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('mobile.profile') }}" 
           class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-2xs hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-base sm:text-lg font-black text-[#076342] tracking-tight">
            Stiker QR Warung Sehat
        </h1>
        <div class="w-9"></div>
    </div>

    <!-- Official Badge Card (Can be printed / saved) -->
    <div id="sticker-card" class="w-full bg-gradient-to-b from-[#076342] via-[#065035] to-[#0A5C36] rounded-3xl p-6 sm:p-8 text-white text-center shadow-xl border-4 border-amber-400 relative overflow-hidden">
        
        <!-- Header Emblem with Official Logo -->
        <div class="flex items-center justify-center space-x-2.5 mb-3">
            <img src="{{ asset('images/logo-official.jpg') }}" alt="Logo SiklusJambi" class="w-9 h-9 object-contain rounded-xl bg-white p-0.5 shadow-md border border-amber-300">
            <span class="text-[11px] sm:text-xs uppercase tracking-widest font-black text-amber-300">
                Pemerintah Kota Jambi &bull; Dinkes
            </span>
        </div>

        <h2 class="text-xl sm:text-2xl font-black uppercase tracking-tight text-white mb-0.5">
            Warung Sehat Kota Jambi
        </h2>
        <p class="text-[11px] text-emerald-100/90 font-medium mb-5">
            Terverifikasi Bebas Minyak Jelantah Berulang
        </p>

        <!-- QR Code Box (Crisp vector SVG) -->
        <div class="w-52 h-52 bg-white rounded-2xl mx-auto p-3 shadow-lg flex flex-col items-center justify-center border-2 border-emerald-100 mb-5 relative group">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" shape-rendering="crispEdges">
                <path fill="#ffffff" d="M0 0h35v35H0z"/>
                <path stroke="#076342" d="M1 1.5h7m1 0h3m1 0h1m2 0h1m5 0h1m4 0h7M1 2.5h1m5 0h1m1 0h4m2 0h2m1 0h1m2 0h1m1 0h1m3 0h1m5 0h1M1 3.5h1m1 0h3m1 0h1m2 0h1m1 0h1m1 0h3m2 0h1m1 0h1m1 0h3m1 0h1m1 0h3m1 0h1M1 4.5h1m1 0h3m1 0h1m1 0h1m1 0h2m3 0h1m2 0h1m2 0h1m1 0h2m1 0h1m1 0h3m1 0h1M1 5.5h1m1 0h3m1 0h1m3 0h1m5 0h3m4 0h1m2 0h1m1 0h3m1 0h1M1 6.5h1m5 0h1m7 0h5m2 0h1m4 0h1m5 0h1M1 7.5h7m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h1m1 0h7M9 8.5h1m1 0h1m1 0h1m1 0h6m1 0h2M1 9.5h1m1 0h2m1 0h3m3 0h1m1 0h1m1 0h1m1 0h1m2 0h2m4 0h1m2 0h1m1 0h2M1 10.5h5m3 0h1m4 0h8m1 0h5m1 0h5M2 11.5h1m1 0h2m1 0h2m1 0h2m1 0h2m4 0h1m2 0h3m2 0h4m1 0h1M5 12.5h1m2 0h1m4 0h1m2 0h1m1 0h1m2 0h6m1 0h3m1 0h1M4 13.5h4m1 0h4m2 0h3m3 0h3m1 0h2m1 0h1m1 0h1m2 0h1M2 14.5h3m1 0h1m1 0h1m2 0h1m1 0h3m2 0h1m2 0h1m2 0h1m1 0h7M1 15.5h1m1 0h1m2 0h6m1 0h3m2 0h4m1 0h1m2 0h1m2 0h1m1 0h1M2 16.5h3m4 0h1m1 0h1m1 0h2m1 0h1m5 0h2m3 0h2m1 0h1M7 17.5h2m2 0h3m1 0h1m1 0h3m1 0h1m2 0h2m1 0h1m1 0h1m1 0h1M2 18.5h2m1 0h2m2 0h1m1 0h2m1 0h4m1 0h3m1 0h4m1 0h1m1 0h1m1 0h1M3 19.5h2m1 0h3m1 0h1m1 0h1m3 0h2m1 0h2m1 0h1m4 0h1m1 0h1m1 0h1M2 20.5h3m3 0h1m2 0h4m1 0h4m1 0h1m1 0h2m3 0h1M1 21.5h3m1 0h3m3 0h5m1 0h1m2 0h1m2 0h1m1 0h2m1 0h5M1 22.5h2m2 0h2m3 0h1m3 0h1m1 0h2m3 0h3m9 0h1M3 23.5h1m1 0h1m1 0h4m1 0h1m1 0h3m2 0h3m5 0h7M2 24.5h3m5 0h1m1 0h2m2 0h1m1 0h1m2 0h1m1 0h1m1 0h1m6 0h1M1 25.5h1m1 0h2m1 0h2m1 0h2m4 0h1m1 0h2m1 0h1m1 0h1m1 0h6m2 0h1M9 26.5h1m1 0h1m1 0h3m1 0h1m4 0h1m2 0h1m3 0h2m2 0h1M1 27.5h7m1 0h2m2 0h2m1 0h7m1 0h2m1 0h1m1 0h1M1 28.5h1m5 0h1m1 0h1m1 0h1m1 0h1m1 0h1m2 0h3m4 0h1m3 0h1m1 0h3M1 29.5h1m1 0h3m1 0h1m2 0h3m4 0h4m2 0h1m1 0h9M1 30.5h1m1 0h3m1 0h1m1 0h6m2 0h1m2 0h1m2 0h7m1 0h2M1 31.5h1m1 0h3m1 0h1m1 0h1m1 0h2m3 0h3m2 0h2m1 0h2m2 0h2M1 32.5h1m5 0h1m2 0h2m3 0h1m2 0h1m2 0h1m4 0h1m4 0h1m1 0h1M1 33.5h7m1 0h1m3 0h3m2 0h3m1 0h2m2 0h1m2 0h2"/>
            </svg>
        </div>

        <p class="text-sm font-extrabold text-white mb-0.5">
            {{ $warung->business_name }}
        </p>
        <p class="text-[11px] text-amber-300 font-mono font-bold tracking-wider mb-3">
            NO: {{ $certificate->certificate_code }}
        </p>

        <!-- Compliance 30-Day Badge -->
        <div class="inline-flex items-center space-x-2 px-3.5 py-1 bg-white/15 rounded-full text-xs text-emerald-100 border border-white/20">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            <span>Masa Aktif: <strong class="text-white">{{ $certificate->days_remaining }} Hari Lagi</strong></span>
        </div>

    </div>

    <!-- Actions: Print & Public Link -->
    <div class="space-y-2.5 pt-1">
        <button onclick="window.print()" 
                class="w-full py-3.5 bg-white border border-slate-200 text-slate-800 font-extrabold text-xs rounded-2xl shadow-xs hover:bg-slate-50 transition-all flex items-center justify-center space-x-2">
            <svg class="w-4 h-4 text-[#076342]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            <span>Cetak Stiker untuk Etalase Warung</span>
        </button>

        <a href="{{ route('public.qr', $certificate->qr_hash) }}" 
           target="_blank" 
           class="w-full py-3.5 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] hover:to-[#084a2c] text-white font-extrabold text-xs rounded-2xl shadow-sm transition-all flex items-center justify-center space-x-2">
            <svg class="w-4 h-4 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            <span>Buka Halaman Verifikasi Publik Konsumen</span>
        </a>
    </div>

</div>
@endsection
