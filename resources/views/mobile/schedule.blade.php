@extends('layouts.mobile', ['showBottomNav' => true, 'activeTab' => 'jadwal'])

@section('content')
<div class="flex-1 w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-5 md:py-8 space-y-5 pb-24 md:pb-12">

    <!-- Header Title & Filter -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-xs">
        <div>
            <h1 class="text-base sm:text-xl font-black text-slate-900 tracking-tight">
                Riwayat & Jadwal Penjemputan
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Pantau status armada logistik dan riwayat transaksi jelantah warung Anda
            </p>
        </div>

        <!-- Filter Toggle Tabs -->
        <div class="flex items-center space-x-1.5 bg-slate-100/90 p-1.5 rounded-2xl self-start sm:self-auto text-xs font-bold">
            <button id="tab-in-progress" 
                    onclick="filterOrders('in_progress')" 
                    class="px-3.5 py-2 rounded-xl transition-all bg-white text-[#076342] shadow-2xs">
                Dalam Proses
            </button>
            <button id="tab-completed" 
                    onclick="filterOrders('completed')" 
                    class="px-3.5 py-2 rounded-xl transition-all text-slate-600 hover:text-slate-900">
                Selesai
            </button>
            <button id="tab-all" 
                    onclick="filterOrders('all')" 
                    class="px-3.5 py-2 rounded-xl transition-all text-slate-600 hover:text-slate-900">
                Semua
            </button>
        </div>
    </div>

    <!-- Orders List Container -->
    <div class="space-y-3.5">
        @forelse($orders as $index => $order)
        <div class="order-card order-{{ in_array($order->status, ['pending', 'assigned', 'in_progress']) ? 'in_progress' : 'completed' }} bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col sm:flex-row hover:border-[#076342]/40 hover:shadow-sm transition-all">
            
            <!-- Left Strip / Index Indicator -->
            <div class="sm:w-16 bg-[#076342] text-white p-3 sm:p-0 flex items-center justify-between sm:justify-center font-extrabold text-xs sm:text-base shrink-0">
                <span class="sm:hidden text-xs uppercase tracking-wider font-bold text-emerald-200">#{{ $index + 1 }} &bull; {{ $order->order_number }}</span>
                <span class="hidden sm:inline font-mono font-black text-emerald-100">#{{ $index + 1 }}</span>
                
                <!-- Status Badge on Small Screen Inside Header -->
                <div class="sm:hidden">
                    @if(in_array($order->status, ['pending', 'assigned', 'in_progress']))
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-400 text-amber-950">
                            Proses Jemput
                        </span>
                    @elseif($order->status === 'completed')
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-400 text-emerald-950">
                            Selesai Cair
                        </span>
                    @else
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-500 text-white">
                            Ditolak
                        </span>
                    @endif
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 p-4 sm:p-5 space-y-3 relative">
                
                <!-- Desktop Status Header Top Right -->
                <div class="hidden sm:flex justify-between items-center pb-2 border-b border-slate-100">
                    <span class="font-mono text-xs font-bold text-slate-500">{{ $order->order_number }}</span>
                    @if(in_array($order->status, ['pending', 'assigned', 'in_progress']))
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200/80 flex items-center space-x-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                            <span>Dalam Antrean Kurir</span>
                        </span>
                    @elseif($order->status === 'completed')
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200/80 flex items-center space-x-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>Selesai & Saldo Masuk</span>
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-800 border border-rose-200 flex items-center space-x-1.5">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <span>Tidak Lolos QC</span>
                        </span>
                    @endif
                </div>

                <!-- Info Grid (Clean typography, no emojis) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs text-slate-700">
                    <div class="bg-slate-50/80 p-2.5 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Waktu Pengajuan</span>
                        <strong class="text-slate-900 block mt-0.5">{{ $order->created_at->format('H.i') }} WIB</strong>
                        <span class="text-[10px] text-slate-500">{{ $order->created_at->translatedFormat('d M Y') }}</span>
                    </div>

                    <div class="bg-slate-50/80 p-2.5 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Jenis Limbah</span>
                        <strong class="text-slate-900 block mt-0.5 truncate">{{ $order->waste_type }}</strong>
                        <span class="text-[10px] text-emerald-700 font-semibold">Standar SAF</span>
                    </div>

                    <div class="bg-slate-50/80 p-2.5 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Volume</span>
                        <strong class="text-slate-900 block mt-0.5 text-sm font-black">{{ $order->actual_volume ?? $order->estimated_volume }} Liter</strong>
                        <span class="text-[10px] text-slate-500">{{ $order->actual_volume ? 'Ukur digital' : 'Estimasi awal' }}</span>
                    </div>

                    <div class="bg-slate-50/80 p-2.5 rounded-xl">
                        <span class="text-[10px] text-slate-400 block font-medium">Nilai Saldo</span>
                        <strong class="text-[#076342] block mt-0.5 text-sm font-black">Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        <span class="text-[10px] text-amber-600 font-semibold">+{{ $order->points_earned }} Poin</span>
                    </div>
                </div>

                @if($order->notes)
                <div class="text-[11px] text-slate-600 bg-slate-50 px-3 py-2 rounded-xl flex items-start space-x-2">
                    <span class="font-semibold text-slate-800 shrink-0">Catatan:</span>
                    <span>{{ $order->notes }}</span>
                </div>
                @endif

            </div>
        </div>
        @empty
        <div class="text-center py-16 bg-white rounded-3xl border border-slate-200/80 p-6 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#076342] flex items-center justify-center mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h3 class="text-sm font-bold text-slate-800">Belum Ada Riwayat Penjemputan</h3>
            <p class="text-xs text-slate-500 max-w-sm mx-auto">
                Minyak jelantah yang Anda kumpulkan bernilai tunai Rp7.500 per liter. Ajukan penjemputan pertama Anda sekarang!
            </p>
            <div class="pt-2">
                <a href="{{ route('mobile.pickup.create') }}" class="inline-flex items-center px-4 py-2.5 bg-[#076342] hover:bg-[#065035] text-white font-bold text-xs rounded-xl shadow-sm transition-colors">
                    + Ajukan Penjemputan
                </a>
            </div>
        </div>
        @endforelse
    </div>

</div>

<script>
    function filterOrders(status) {
        const btnInProg = document.getElementById('tab-in-progress');
        const btnComp = document.getElementById('tab-completed');
        const btnAll = document.getElementById('tab-all');
        const cards = document.querySelectorAll('.order-card');

        const activeClass = 'px-3.5 py-2 rounded-xl transition-all bg-white text-[#076342] shadow-2xs';
        const inactiveClass = 'px-3.5 py-2 rounded-xl transition-all text-slate-600 hover:text-slate-900';

        btnInProg.className = inactiveClass;
        btnComp.className = inactiveClass;
        btnAll.className = inactiveClass;

        if (status === 'in_progress') {
            btnInProg.className = activeClass;
            cards.forEach(card => {
                card.style.display = card.classList.contains('order-in_progress') ? 'flex' : 'none';
            });
        } else if (status === 'completed') {
            btnComp.className = activeClass;
            cards.forEach(card => {
                card.style.display = card.classList.contains('order-completed') ? 'flex' : 'none';
            });
        } else {
            btnAll.className = activeClass;
            cards.forEach(card => {
                card.style.display = 'flex';
            });
        }
    }
</script>
@endsection
