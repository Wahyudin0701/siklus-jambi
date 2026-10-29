@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-2xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-5 pb-12">

    <!-- Header -->
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('courier.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-base font-extrabold text-[#076342]">Uji Fisik Mutu SAF & Timbang</h2>
        <div class="w-8"></div>
    </div>

    <!-- Warung Detail Card -->
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm space-y-1">
        <span class="text-[10px] font-mono text-slate-400 font-bold block">{{ $order->order_number }}</span>
        <h3 class="text-sm font-bold text-slate-900">{{ $order->warungProfile->business_name }}</h3>
        <p class="text-xs text-slate-500">{{ $order->warungProfile->address }}</p>
        <span class="text-[11px] text-amber-700 font-semibold block pt-1">Estimasi Pengajuan: <strong>{{ $order->estimated_volume }} Liter</strong></span>
    </div>

    <form action="{{ route('courier.inspect.post', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- 3 Syarat Mutu Bioavtur SAF PT Pertamina -->
        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm space-y-3">
            <div class="flex items-center space-x-1.5 text-xs font-bold text-slate-900">
                <span class="text-purple-600">🛡️</span>
                <span>Uji Fisik Standar SAF Pertamina (3 Syarat):</span>
            </div>

            <div class="space-y-2">
                <label class="flex items-start p-2.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 has-[:checked]:border-[#076342] has-[:checked]:bg-emerald-50/50">
                    <input type="checkbox" name="is_water_free" value="1" checked required class="w-4 h-4 mt-0.5 text-[#076342] rounded focus:ring-[#076342]">
                    <span class="ml-2.5 text-xs text-slate-800 font-medium">1. Bebas kandungan air (tidak keruh / terpisah)</span>
                </label>

                <label class="flex items-start p-2.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 has-[:checked]:border-[#076342] has-[:checked]:bg-emerald-50/50">
                    <input type="checkbox" name="is_sediment_free" value="1" checked required class="w-4 h-4 mt-0.5 text-[#076342] rounded focus:ring-[#076342]">
                    <span class="ml-2.5 text-xs text-slate-800 font-medium">2. Bebas endapan padat (tepung / remahan arang)</span>
                </label>

                <label class="flex items-start p-2.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 has-[:checked]:border-[#076342] has-[:checked]:bg-emerald-50/50">
                    <input type="checkbox" name="is_pure_uco" value="1" checked required class="w-4 h-4 mt-0.5 text-[#076342] rounded focus:ring-[#076342]">
                    <span class="ml-2.5 text-xs text-slate-800 font-medium">3. Murni Used Cooking Oil (jelantah nabati)</span>
                </label>
            </div>
        </div>

        <!-- Input Timbangan Digital -->
        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm space-y-1.5">
            <label for="actual_volume" class="block text-xs font-bold text-slate-800">
                Volume Aktual Hasil Timbangan (Liter) :
            </label>
            <div class="relative">
                <input type="number" 
                       id="actual_volume" 
                       name="actual_volume" 
                       step="0.1" 
                       value="{{ $order->estimated_volume }}"
                       required
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-base font-black text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#076342]">
                <span class="absolute right-4 top-3.5 text-xs font-bold text-slate-400">Liter</span>
            </div>
        </div>

        <!-- Foto Bukti Penimbangan -->
        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm space-y-1.5">
            <label class="block text-xs font-bold text-slate-800">
                Foto Jerigen di Atas Timbangan :
            </label>
            <input type="file" 
                   name="proof_photo" 
                   accept="image/*" 
                   capture="environment"
                   class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#076342] hover:file:bg-emerald-100 border border-slate-200 rounded-xl bg-slate-50">
        </div>

        <!-- Submit Accept -->
        <button type="submit" 
                name="action" 
                value="accept"
                class="w-full py-4 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] text-white font-bold text-sm rounded-2xl shadow-lg shadow-emerald-900/20 active:scale-[0.98] transition-all">
            ✓ Lolos Standar SAF & Konfirmasi Transaksi
        </button>

        <!-- Reject & Educate Section -->
        <div class="pt-2 text-center">
            <button type="button" onclick="document.getElementById('reject-form').classList.toggle('hidden')" class="text-xs text-rose-600 font-bold hover:underline">
                ⚠️ Tidak Lolos Standar SAF? Klik di sini untuk Tolak & Edukasi
            </button>
        </div>
    </form>

    <!-- Hidden Rejection Form -->
    <div id="reject-form" class="hidden bg-rose-50 border border-rose-200 p-4 rounded-2xl space-y-3">
        <h4 class="text-xs font-bold text-rose-800">Form Penolakan & Edukasi Saring Ulang</h4>
        <form action="{{ route('courier.inspect.post', $order->id) }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="action" value="reject">
            <div>
                <label class="block text-[11px] font-semibold text-rose-800 mb-1">Alasan Penolakan :</label>
                <textarea name="rejection_reason" rows="2" required placeholder="Contoh: Mengandung endapan arang tebal, mohon disaring menggunakan kain tipis..." class="w-full px-3 py-2 text-xs border border-rose-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-rose-500"></textarea>
            </div>
            <button type="submit" class="w-full py-2.5 bg-rose-600 text-white font-bold text-xs rounded-xl shadow-sm hover:bg-rose-700">
                Kirim Notifikasi Penolakan ke UMKM
            </button>
        </form>
    </div>

</div>
@endsection
