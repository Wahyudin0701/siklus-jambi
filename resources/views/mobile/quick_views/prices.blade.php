@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-2xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-5 pb-12">
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('mobile.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-base md:text-lg font-extrabold text-[#076342]">Indeks Harga Limbah</h2>
        <div class="w-8"></div>
    </div>

    <div class="space-y-3">
        @foreach($prices as $price)
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
            <div>
                <span class="text-xs sm:text-sm font-bold text-slate-900 block capitalize">{{ str_replace('_', ' ', $price->waste_type) }}</span>
                <span class="text-[10px] sm:text-xs text-slate-400">Pembaruan: {{ $price->effective_date->translatedFormat('d F Y') }}</span>
            </div>
            <div class="text-right">
                <span class="text-lg sm:text-xl font-black text-[#076342]">Rp{{ number_format($price->price_per_unit, 0, ',', '.') }}</span>
                <span class="text-[10px] sm:text-xs text-slate-500 block">per {{ $price->unit }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-emerald-50 rounded-2xl p-4 sm:p-5 border border-emerald-200 text-xs text-emerald-900 space-y-1.5">
        <strong class="text-emerald-950 font-bold block">Ketentuan Mutu Pembelian:</strong>
        <p class="text-[11px] sm:text-xs text-emerald-800 leading-relaxed">Harga di atas berlaku untuk minyak jelantah yang memenuhi 3 kriteria standar SAF Pertamina: bebas air, bebas endapan padat, dan murni nabati.</p>
    </div>
</div>
@endsection
