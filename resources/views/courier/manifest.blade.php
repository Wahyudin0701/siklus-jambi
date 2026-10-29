@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-5 pb-12">

    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('courier.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-base font-extrabold text-[#076342]">Manifest Harian ISCC</h2>
        <div class="w-8"></div>
    </div>

    @if($manifest)
    <!-- Manifest Card -->
    <div class="bg-gradient-to-b from-slate-900 to-slate-800 text-white rounded-3xl p-6 shadow-xl space-y-4 text-center border-2 border-purple-500/50">
        <div class="inline-flex items-center space-x-1 px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-[10px] font-bold tracking-wider uppercase border border-purple-400/30">
            <span>🛡️ Sertifikasi ISCC - Rantai Pasok Hilir</span>
        </div>

        <div>
            <h3 class="text-xl font-black tracking-tight text-white">
                Depot Bioavtur Pertamina
            </h3>
            <p class="text-xs text-slate-400 font-mono">
                KODE: {{ $manifest->manifest_code }}
            </p>
        </div>

        <!-- Simulated QR Manifest -->
        <div class="w-40 h-40 bg-white rounded-2xl mx-auto p-3 flex items-center justify-center shadow-inner">
            <svg class="w-full h-full text-slate-900" viewBox="0 0 100 100" fill="currentColor">
                <rect x="5" y="5" width="26" height="26" rx="4" fill="#6B21A8"/>
                <rect x="9" y="9" width="18" height="18" rx="2" fill="white"/>
                <rect x="13" y="13" width="10" height="10" rx="1" fill="#6B21A8"/>
                <rect x="69" y="5" width="26" height="26" rx="4" fill="#6B21A8"/>
                <rect x="73" y="9" width="18" height="18" rx="2" fill="white"/>
                <rect x="77" y="13" width="10" height="10" rx="1" fill="#6B21A8"/>
                <rect x="5" y="69" width="26" height="26" rx="4" fill="#6B21A8"/>
                <rect x="9" y="73" width="18" height="18" rx="2" fill="white"/>
                <rect x="13" y="77" width="10" height="10" rx="1" fill="#6B21A8"/>
                <rect x="36" y="15" width="8" height="8"/>
                <rect x="50" y="25" width="8" height="8"/>
                <rect x="25" y="45" width="8" height="8"/>
                <rect x="45" y="45" width="12" height="12"/>
                <rect x="65" y="45" width="8" height="8"/>
                <rect x="35" y="65" width="8" height="8"/>
                <rect x="55" y="75" width="8" height="8"/>
            </svg>
        </div>

        <div class="bg-slate-800/80 rounded-2xl p-3 text-left text-xs space-y-1.5 border border-slate-700">
            <div class="flex justify-between">
                <span class="text-slate-400">Total Muatan Tangki:</span>
                <strong class="text-amber-400">{{ $manifest->total_volume_liters }} Liter</strong>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Jumlah Warung Asal:</span>
                <strong class="text-white">{{ $manifest->total_warung_count }} Warung (Kec. Jelutung)</strong>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Hash Audit ISCC:</span>
                <span class="font-mono text-[10px] text-purple-300">{{ substr($manifest->iscc_traceability_hash, 0, 16) }}...</span>
            </div>
        </div>

        <div class="text-[10px] text-emerald-400 font-semibold">
            ✓ Tunjukkan QR ini ke Petugas Lab Depot Pertamina saat serah terima
        </div>
    </div>
    @else
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center space-y-4">
        <div class="w-16 h-16 bg-purple-50 text-purple-700 rounded-full flex items-center justify-center mx-auto text-2xl">
            📋
        </div>
        <h3 class="text-sm font-bold text-slate-900">Belum Ada Manifest Hari Ini</h3>
        <p class="text-xs text-slate-500">Kumpulkan hasil penjemputan dari seluruh warung sebelum menerbitkan manifest konsolidasi.</p>
        <form action="{{ route('courier.manifest.generate') }}" method="POST">
            @csrf
            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-purple-700 to-indigo-700 text-white font-bold text-xs rounded-2xl shadow-md">
                Terbitkan Manifest Harian (215.5 Liter)
            </button>
        </form>
    </div>
    @endif

</div>
@endsection
