@extends('layouts.mobile')

@section('content')
<div class="min-h-screen w-full flex flex-col lg:flex-row bg-slate-50">

    <!-- LEFT COLUMN: Desktop Brand & Value Showcase (Visible on lg and above) -->
    <div class="hidden lg:flex lg:w-1/2 xl:w-7/12 bg-gradient-to-br from-[#064e34] via-[#076342] to-[#0A5C36] text-white p-10 xl:p-16 flex-col justify-between relative overflow-hidden shadow-2xl">
        
        <!-- Subtle Ambient Background Glows -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Top: Official Logo & Brand Badge -->
        <div class="relative z-10">
            <a href="{{ route('landing') }}" class="inline-flex items-center space-x-3.5 bg-white/95 backdrop-blur-sm px-4 py-2.5 rounded-2xl shadow-lg border border-white/20 hover:bg-white transition-colors group">
                <img src="/images/logo-official.jpg" 
                     alt="Logo Resmi SiklusJambi" 
                     class="w-11 h-11 object-contain rounded-xl">
                <div>
                    <span class="text-base font-black tracking-tight"><span class="text-[#076342]">Siklus</span><span class="text-[#D88909]">Jambi</span></span>
                    <span class="block text-[10px] text-slate-500 font-semibold tracking-wider uppercase">Ekonomi Sirkular Limbah Kuliner</span>
                </div>
            </a>
        </div>

        <!-- Center: Strategic Value Propositions -->
        <div class="relative z-10 my-auto py-8 space-y-6 max-w-xl">
            <div class="inline-flex items-center px-3.5 py-1 rounded-full bg-emerald-500/20 text-emerald-200 border border-emerald-400/30 text-xs font-bold tracking-wide">
                Inisiatif Sirkular Kota Jambi Menuju Bioavtur SAF
            </div>

            <div class="space-y-3">
                <h1 class="text-3xl xl:text-4xl font-extrabold tracking-tight text-white leading-tight">
                    Selamat Datang di SiklusJambi
                </h1>
                <p class="text-sm xl:text-base text-emerald-100/90 leading-relaxed font-normal">
                    Ubah minyak jelantah & kardus warung Anda menjadi saldo tunai instan sekaligus raih Stiker QR Warung Sehat Kota Jambi.
                </p>
            </div>

            <!-- 4 Pillar Feature Badges (Clean & Simple) -->
            <div class="grid grid-cols-2 gap-3.5 pt-2">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 space-y-1.5 hover:bg-white/15 transition-colors">
                    <h2 class="text-xs font-bold text-white tracking-wide">Saldo Tunai Instan</h2>
                    <p class="text-[11px] text-emerald-100/80 leading-relaxed">Pencairan saldo langsung ke rekening dan 1 Liter = 1 Poin Reward.</p>
                </div>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 space-y-1.5 hover:bg-white/15 transition-colors">
                    <h2 class="text-xs font-bold text-white tracking-wide">Pasokan Bioavtur SAF</h2>
                    <p class="text-[11px] text-emerald-100/80 leading-relaxed">Kemitraan hilir resmi energi terbarukan bersama PT Pertamina.</p>
                </div>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 space-y-1.5 hover:bg-white/15 transition-colors">
                    <h2 class="text-xs font-bold text-white tracking-wide">Stiker Warung Sehat</h2>
                    <p class="text-[11px] text-emerald-100/80 leading-relaxed">Terakreditasi Dinas Kesehatan Kota Jambi bebas jelantah berulang.</p>
                </div>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 space-y-1.5 hover:bg-white/15 transition-colors">
                    <h2 class="text-xs font-bold text-white tracking-wide">Mitigasi Banjir Drainase</h2>
                    <p class="text-[11px] text-emerald-100/80 leading-relaxed">Mencegah fatberg penyumbat parit di 30 RT rawan genangan.</p>
                </div>
            </div>
        </div>

        <!-- Bottom: Live Metrics & Endorsement -->
        <div class="relative z-10 pt-4 border-t border-white/15 flex items-center justify-between text-xs text-emerald-100">
            <div class="flex items-center space-x-4">
                <div>
                    <span class="font-extrabold text-white text-sm block">18.450+ Liter</span>
                    <span class="text-[10px] text-emerald-200/70">Jelantah Terserap</span>
                </div>
                <div class="h-6 w-px bg-white/20"></div>
                <div>
                    <span class="font-extrabold text-white text-sm block">840+ Warung</span>
                    <span class="text-[10px] text-emerald-200/70">11 Kecamatan Aktif</span>
                </div>
            </div>
            <span class="text-[11px] text-emerald-200/80">Pemerintah Kota Jambi &bull; DLH &bull; Dinkes</span>
        </div>

    </div>

    <!-- RIGHT COLUMN / MOBILE VIEW: Login Form Panel -->
    <div class="w-full lg:w-1/2 xl:w-5/12 min-h-screen flex flex-col justify-center px-6 sm:px-12 md:px-16 lg:px-12 xl:px-16 py-8 sm:py-12 bg-white relative">
        
        <div class="max-w-md w-full mx-auto space-y-6">

            <!-- Mobile-Only Brand Header (Hidden on lg and above) -->
            <div class="lg:hidden text-center space-y-3 pt-2 pb-2">
                <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2.5 p-2 bg-white rounded-2xl shadow-xs border border-slate-100 hover:border-slate-200 transition-colors">
                    <img src="/images/logo-official.jpg" 
                         alt="Logo Resmi SiklusJambi" 
                         class="w-10 h-10 object-contain rounded-xl">
                    <span class="text-base font-extrabold tracking-tight"><span class="text-[#076342]">Siklus</span><span class="text-[#D88909]">Jambi</span></span>
                </a>

                <div class="space-y-1">
                    <h1 class="text-xl font-extrabold tracking-tight text-slate-900">
                        Masuk Akun
                    </h1>
                    <p class="text-xs text-slate-500 max-w-xs mx-auto">
                        Kelola penjemputan limbah dan pantau saldo warung Anda.
                    </p>
                </div>
            </div>

            <!-- Desktop Form Title (Visible on lg and above) -->
            <div class="hidden lg:block space-y-1.5 pb-2">
                <span class="text-xs font-bold text-[#076342] tracking-wider uppercase block">
                    Portal Pelaku Kuliner
                </span>
                <h2 class="text-2xl xl:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Masuk Akun
                </h2>
                <p class="text-xs text-slate-500">
                    Masukkan nomor WhatsApp dan kata sandi untuk mengelola warung Anda.
                </p>
            </div>

            <!-- Flash Session Alerts -->
            @if(session('error'))
                <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl flex items-center space-x-2">
                    <svg class="w-4 h-4 shrink-0 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center space-x-2">
                    <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('mobile.login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nomor WhatsApp -->
                <div class="space-y-1.5">
                    <label for="phone_number" class="block text-xs font-bold text-slate-700">
                        Nomor WhatsApp
                    </label>
                    <input type="text" 
                           id="phone_number" 
                           name="phone_number" 
                           value="{{ old('phone_number', '081234567890') }}"
                           placeholder="Contoh: 081234567890" 
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] focus:border-transparent text-slate-900 placeholder-slate-400 bg-white hover:border-slate-300 transition-all">
                </div>

                <!-- Kata Sandi -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-bold text-slate-700">
                            Kata Sandi
                        </label>
                        <span class="text-[11px] text-slate-400 font-medium">Min. 6 Karakter</span>
                    </div>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           value="password123"
                           placeholder="Masukkan kata sandi" 
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] focus:border-transparent text-slate-900 placeholder-slate-400 bg-white hover:border-slate-300 transition-all">
                </div>

                <!-- Ingat Saya & Bantuan -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center cursor-pointer select-none">
                        <input type="checkbox" 
                               id="remember" 
                               name="remember" 
                               class="w-4 h-4 text-[#076342] border-slate-300 rounded focus:ring-[#076342] cursor-pointer accent-[#076342]">
                        <span class="ml-2 text-xs font-medium text-slate-600">
                            Ingat saya
                        </span>
                    </label>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20SiklusJambi,%20saya%20lupa%20kata%20sandi%20akun" target="_blank" class="text-xs font-semibold text-[#076342] hover:underline">
                        Bantuan Masuk?
                    </a>
                </div>

                <!-- Tombol Masuk -->
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3.5 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] hover:to-[#084a2c] text-white font-bold text-sm rounded-xl shadow-md shadow-emerald-950/15 active:scale-[0.99] transition-all flex items-center justify-center space-x-2">
                        <span>Masuk</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>

                <!-- Belum punya akun? Daftar disini -->
                <div class="text-center pt-2">
                    <p class="text-xs text-slate-500 font-medium">
                        Belum punya akun? 
                        <a href="{{ route('mobile.register.step1') }}" class="text-[#076342] font-bold hover:underline">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </form>

            <!-- Quick Demo Credentials Callout (Clean & Minimal) -->
            <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 text-[11px]">
                    <span class="font-bold text-slate-700">Akun Uji Coba:</span>
                    <div class="flex items-center space-x-3 font-mono text-slate-800">
                        <span>WA: <strong>081234567890</strong></span>
                        <span class="text-slate-300">|</span>
                        <span>Sandi: <strong>password123</strong></span>
                    </div>
                </div>
            </div>

            <!-- Strategic Partner Logos / Endorsement at Bottom (Clean text badges) -->
            <div class="pt-4 border-t border-slate-100 text-center space-y-2.5">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">
                    Didukung & Diawasi Oleh
                </span>
                <div class="flex flex-wrap items-center justify-center gap-2 text-xs font-semibold text-slate-600">
                    <span class="px-3 py-1 bg-slate-50 border border-slate-200/70 rounded-lg">Pemkot Jambi</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-200/70 rounded-lg">Dinkes Kota Jambi</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-200/70 rounded-lg">PT Pertamina SAF</span>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
