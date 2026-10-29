@extends('layouts.mobile', ['showBottomNav' => true, 'activeTab' => 'profil'])

@section('content')
<div class="flex-1 w-full max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8 space-y-5 pb-24 md:pb-12">

    <!-- Top Profile Header Card -->
    <div class="bg-gradient-to-r from-[#076342] to-[#0A5C36] rounded-3xl p-6 sm:p-8 text-white relative shadow-md overflow-hidden flex flex-col sm:flex-row items-center sm:space-x-6 text-center sm:text-left space-y-4 sm:space-y-0">
        
        <!-- Subtle Background Glow -->
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Avatar Circle -->
        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-white/10 p-1 shadow-lg shrink-0 flex items-center justify-center border-2 border-white/20">
            <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-[#076342] font-black text-2xl sm:text-3xl shadow-inner">
                {{ substr($user->name, 0, 1) }}
            </div>
        </div>

        <!-- Info -->
        <div class="space-y-1.5 flex-1 relative z-10">
            <div class="inline-flex items-center space-x-1.5 px-3 py-0.5 rounded-full bg-white/15 text-emerald-200 text-[11px] font-bold border border-white/20">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                <span>Pelaku Kuliner Terdaftar</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">
                {{ $user->name }}
            </h1>
            <p class="text-xs sm:text-sm text-emerald-100/90 font-medium">
                {{ $warung->business_name ?? 'Rumah Makan Padang Payakumbuh' }} &bull; +62 {{ ltrim($user->phone_number, '0') }}
            </p>
        </div>

        <!-- QR Sticker Shortcut -->
        <a href="{{ route('mobile.certificate.view') }}" 
           class="px-4 py-2.5 bg-amber-400 hover:bg-amber-300 text-slate-900 rounded-2xl text-xs font-extrabold shadow-sm active:scale-[0.98] transition-all shrink-0 flex items-center space-x-2 relative z-10">
            <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
            </svg>
            <span>Stiker QR</span>
        </a>
    </div>

    <!-- Menu Items List -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-4 sm:p-6 space-y-2.5">
        <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 px-1 pb-1">
            Pengaturan Akun & Layanan
        </h2>
        
        <!-- 1. Data Usaha & Pemilik -->
        <button onclick="alert('Nama Usaha: {{ $warung->business_name }}\nPemilik: {{ $warung->owner_name }}\nKecamatan: {{ $warung->subdistrict->name ?? 'Jelutung' }}')" 
                class="w-full bg-slate-50/70 p-3.5 rounded-2xl border border-slate-100 hover:border-[#076342]/50 hover:bg-white transition-all flex items-center justify-between text-left group">
            <div class="flex items-center space-x-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-900 block">Data Usaha & Pemilik</span>
                    <span class="text-[11px] text-slate-500">Informasi nama warung dan izin usaha</span>
                </div>
            </div>
            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- 2. Titik Lokasi & Alamat Jemput -->
        <a href="{{ route('mobile.profile.location') }}" 
           class="w-full bg-slate-50/70 p-3.5 rounded-2xl border border-slate-100 hover:border-[#076342]/50 hover:bg-white transition-all flex items-center justify-between group">
            <div class="flex items-center space-x-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-900 block">Titik Lokasi & Alamat Jemput</span>
                    <span class="text-[11px] text-slate-500">Koordinat penjemputan armada kurir</span>
                </div>
            </div>
            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <!-- 3. Sertifikat & Stiker QR Warung -->
        <a href="{{ route('mobile.certificate.view') }}" 
           class="w-full bg-slate-50/70 p-3.5 rounded-2xl border border-slate-100 hover:border-[#076342]/50 hover:bg-white transition-all flex items-center justify-between group">
            <div class="flex items-center space-x-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-900 block">Sertifikat & Stiker QR Warung</span>
                    <span class="text-[11px] text-slate-500">Status verifikasi sanitasi Dinkes Kota Jambi</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Aktif</span>
                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- 4. Rekening Bank Saya -->
        <button onclick="alert('Rekening Bank Terdaftar:\nBank: BRI\nNo. Rek: 5432-01-002938-50-1\nAtas Nama: Wisnu Nugroho')" 
                class="w-full bg-slate-50/70 p-3.5 rounded-2xl border border-slate-100 hover:border-[#076342]/50 hover:bg-white transition-all flex items-center justify-between text-left group">
            <div class="flex items-center space-x-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-900 block">Rekening Bank Saya</span>
                    <span class="text-[11px] text-slate-500">Pencairan saldo hasil setoran jelantah</span>
                </div>
            </div>
            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- 5. Poin Reward & Hadiah -->
        <a href="{{ route('mobile.rewards') }}" 
           class="w-full bg-slate-50/70 p-3.5 rounded-2xl border border-slate-100 hover:border-[#076342]/50 hover:bg-white transition-all flex items-center justify-between group">
            <div class="flex items-center space-x-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-900 block">Poin Reward & Hadiah</span>
                    <span class="text-[11px] text-slate-500">Tukar poin dengan sembako / minyak goreng</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold text-amber-600 bg-amber-50 border border-amber-200/80 px-2 py-0.5 rounded-full">{{ $rewardPoint->total_points ?? 380 }} Poin</span>
                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- 6. Pusat Bantuan & Pelayanan -->
        <a href="https://wa.me/6281234567890?text=Halo%20Pusat%20Pelayanan%20SiklusJambi" 
           target="_blank" 
           class="w-full bg-slate-50/70 p-3.5 rounded-2xl border border-slate-100 hover:border-[#076342]/50 hover:bg-white transition-all flex items-center justify-between group">
            <div class="flex items-center space-x-3.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-900 block">Pusat Bantuan & Pelayanan</span>
                    <span class="text-[11px] text-slate-500">Hubungi tim operasional via WhatsApp</span>
                </div>
            </div>
            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

    </div>

    <!-- Red Logout Button (Clean & Modern) -->
    <div class="pt-2">
        <form action="{{ route('mobile.logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="w-full py-3.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs rounded-2xl border border-rose-200 active:scale-[0.99] transition-all flex items-center justify-center space-x-2">
                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Keluar dari Akun</span>
            </button>
        </form>
    </div>

</div>
@endsection
