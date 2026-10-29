@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-4xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-6 pb-12">
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('mobile.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-base md:text-lg font-extrabold text-[#076342]">Kabar & Berita Sirkular</h2>
        <div class="w-8"></div>
    </div>

    <!-- Responsive News Cards (3-column on desktop) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-2 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-[10px] text-[#076342] font-black uppercase tracking-wider bg-emerald-50 px-2 py-0.5 rounded-full inline-block mb-1">Kerjasama Strategis</span>
                <h3 class="text-xs md:text-sm font-bold text-slate-900 leading-snug">Pemkot Jambi & PT Pertamina Perkuat Pasokan UCO untuk Bioavtur SAF Nasional</h3>
                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">Minyak jelantah yang dikumpulkan dari ribuan warung di 11 kecamatan resmi masuk rantai pasok energi terbarukan ramah lingkungan.</p>
            </div>
            <span class="text-[10px] text-slate-400 block pt-3 border-t border-slate-50">2 jam yang lalu • Info Kota</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-2 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-[10px] text-amber-600 font-black uppercase tracking-wider bg-amber-50 px-2 py-0.5 rounded-full inline-block mb-1">Sanitasi Pangan</span>
                <h3 class="text-xs md:text-sm font-bold text-slate-900 leading-snug">Dinkes Kota Jambi Apresiasi 840 UMKM Pemegang Stiker 'Warung Sehat'</h3>
                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">Konsumen kuliner kini dapat memindai kode QR stiker warung untuk memastikan higienitas makanan tanpa minyak daur ulang.</p>
            </div>
            <span class="text-[10px] text-slate-400 block pt-3 border-t border-slate-50">1 hari yang lalu • Dinkes Jambi</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-2 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-[10px] text-blue-600 font-black uppercase tracking-wider bg-blue-50 px-2 py-0.5 rounded-full inline-block mb-1">Mitigasi Banjir</span>
                <h3 class="text-xs md:text-sm font-bold text-slate-900 leading-snug">PUPR: Penyerapan 18.000+ Liter Jelantah Mencegah Fatberg Drainase</h3>
                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">Saluran air di 30 RT rawan genangan kini mengalir lancar berkat kesadaran pedagang kuliner menyetor limbah ke SiklusJambi.</p>
            </div>
            <span class="text-[10px] text-slate-400 block pt-3 border-t border-slate-50">3 hari yang lalu • PUPR Kota</span>
        </div>
    </div>
</div>
@endsection
