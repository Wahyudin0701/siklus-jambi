@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-4xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-6 pb-12">

    <!-- Top Courier Header -->
    <div class="flex items-center justify-between pt-1">
        <div>
            <span class="text-[10px] font-bold text-amber-700 bg-amber-100 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                🚛 Armada Logistik Lapangan
            </span>
            <h2 class="text-lg font-extrabold text-slate-900 mt-1">
                {{ $courier->name }}
            </h2>
            <p class="text-xs text-slate-500 font-medium">
                Zona Aktif: <strong>Kecamatan Jelutung</strong>
            </p>
        </div>

        <a href="{{ route('courier.manifest') }}" class="px-4 py-2 bg-[#076342] text-white rounded-xl text-xs font-bold hover:bg-[#065035] shadow-sm">
            📋 Manifest Harian
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tank Capacity Status Card -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-2xl p-4 shadow-md space-y-2">
        <div class="flex justify-between items-center text-xs">
            <span class="text-slate-300">Muatan Tangki Konsolidasi Hari Ini:</span>
            <span class="font-bold text-amber-400">215.5 L / 250 L (86%)</span>
        </div>
        <div class="w-full bg-slate-700 rounded-full h-2.5 overflow-hidden">
            <div class="bg-amber-400 h-full rounded-full" style="width: 86%"></div>
        </div>
        <p class="text-[10px] text-slate-400">Siap dikirim ke Depot Bioavtur PT Pertamina setelah penjemputan selesai.</p>
    </div>

    <!-- Antrean Penjemputan Warung Terdekat (OSRM Routing) -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">
                Antrean Rute OSRM Terdekat
            </h3>
            <span class="text-[11px] text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded-full">
                {{ $pendingOrders->count() }} Antrean
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($pendingOrders as $order)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 space-y-3 flex flex-col justify-between">
            <div class="space-y-2">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">{{ $order->warungProfile->business_name }}</h4>
                        <p class="text-[11px] text-slate-500">{{ $order->warungProfile->address }}</p>
                        <span class="text-[10px] font-mono text-slate-400 font-bold">{{ $order->order_number }}</span>
                    </div>
                    <span class="px-2.5 py-0.5 bg-amber-100 text-amber-800 text-[10px] font-bold rounded-full">
                        Est. {{ $order->estimated_volume }} Liter
                    </span>
                </div>

                @if($order->notes)
                <div class="p-2 bg-slate-50 rounded-xl text-[10px] text-slate-600 border border-slate-100">
                    💬 <strong>Catatan:</strong> {{ $order->notes }}
                </div>
                @endif
            </div>

            <div class="pt-2 flex space-x-2">
                <a href="https://maps.google.com/?q={{ $order->warungProfile->latitude }},{{ $order->warungProfile->longitude }}" target="_blank" class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-center text-xs font-bold transition-colors">
                    🗺️ Peta
                </a>
                <a href="{{ route('courier.inspect', $order->id) }}" class="flex-1 py-2.5 bg-[#076342] hover:bg-[#065035] text-white rounded-xl text-center text-xs font-bold shadow-sm transition-colors">
                    ⚖️ Tiba & Timbang
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-8 bg-white rounded-2xl border border-slate-100 p-4">
            <p class="text-xs text-slate-500">Semua order penjemputan di wilayah ini telah selesai!</p>
        </div>
        @endforelse
        </div>
    </div>

</div>
@endsection
