@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-4xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-6 pb-12">
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('mobile.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-base md:text-lg font-extrabold text-[#076342]">Dampak Ekologis Kita</h2>
        <div class="w-8"></div>
    </div>

    <!-- Impact Cards Grid (Responsive 3-Column on Desktop) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Air Sungai Batanghari -->
        <div class="bg-gradient-to-r md:bg-gradient-to-br from-blue-600 to-cyan-600 text-white p-5 rounded-2xl shadow-md flex flex-col justify-between">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold block text-blue-100">Sungai Batanghari</span>
                <span class="text-2xl lg:text-3xl font-black mt-1 block">{{ number_format(($impact->clean_water_saved_liters ?? 18450000) / 1000000, 2, ',', '.') }} Juta L</span>
            </div>
            <p class="text-[11px] text-blue-100 mt-3">Air bersih terlindungi dari pencemaran minyak jelantah.</p>
        </div>

        <!-- Dekarbonisasi Emisi -->
        <div class="bg-gradient-to-r md:bg-gradient-to-br from-emerald-700 to-green-600 text-white p-5 rounded-2xl shadow-md flex flex-col justify-between">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold block text-emerald-100">Reduksi Emisi Karbon</span>
                <span class="text-2xl lg:text-3xl font-black mt-1 block">{{ number_format(($impact->co2e_reduced_kg ?? 39800) / 1000, 1, ',', '.') }} Ton CO₂e</span>
            </div>
            <p class="text-[11px] text-emerald-100 mt-3">Pengurangan emisi gas rumah kaca terverifikasi Kementerian Lingkungan Hidup.</p>
        </div>

        <!-- Pasokan SAF Pertamina -->
        <div class="bg-gradient-to-r md:bg-gradient-to-br from-purple-700 to-indigo-700 text-white p-5 rounded-2xl shadow-md flex flex-col justify-between">
            <div>
                <span class="text-xs uppercase tracking-wider font-semibold block text-purple-100">Bioavtur Pertamina SAF</span>
                <span class="text-2xl lg:text-3xl font-black mt-1 block">{{ number_format($impact->saf_produced_liters ?? 14760, 0, ',', '.') }} Liter</span>
            </div>
            <p class="text-[11px] text-purple-100 mt-3">Dikonversi menjadi Sustainable Aviation Fuel untuk penerbangan rendah emisi.</p>
        </div>
    </div>
</div>
@endsection
