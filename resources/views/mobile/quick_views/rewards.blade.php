@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-4xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-6 pb-12">
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('mobile.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-base md:text-lg font-extrabold text-[#076342]">Tukar Poin Reward</h2>
        <div class="w-8"></div>
    </div>

    <!-- Poin Card -->
    <div class="bg-gradient-to-r from-[#D88909] to-[#E67E22] rounded-3xl p-6 text-white shadow-lg flex items-center justify-between">
        <div>
            <span class="text-xs text-amber-100 block font-semibold">Poin Anda Saat Ini</span>
            <span class="text-3xl font-black mt-1 block">{{ $rewardPoint->total_points }} Poin</span>
            <p class="text-[11px] text-amber-200 mt-1">1 Liter Minyak Jelantah = 1 Poin Reward</p>
        </div>
        <div class="text-4xl bg-white/10 p-4 rounded-2xl">🎁</div>
    </div>

    <!-- Catalog List (Responsive 2-column on desktop) -->
    <div class="space-y-3">
        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Katalog Hadiah UMKM</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($catalogs as $item)
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="pr-3">
                    <h4 class="text-xs sm:text-sm font-bold text-slate-900">{{ $item->title }}</h4>
                    <p class="text-[11px] text-slate-500 mb-2 leading-relaxed">{{ $item->description }}</p>
                    <span class="text-xs font-black text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200/50">
                        {{ $item->points_required }} Poin
                    </span>
                </div>
                <button onclick="alert('Permintaan penukaran hadiah {{ $item->title }} berhasil dicatat! Kurir akan mengantarkan hadiah saat penjemputan berikutnya.')" class="px-4 py-2.5 bg-[#076342] text-white font-bold text-xs rounded-xl hover:bg-[#065035] shadow-sm shrink-0">
                    Tukar
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
