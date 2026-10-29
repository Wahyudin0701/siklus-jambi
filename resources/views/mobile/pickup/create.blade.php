@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-5 pb-16">

    <!-- Header with Back Button -->
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('mobile.dashboard') }}" 
           class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-2xs hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-base sm:text-lg font-black text-[#076342] tracking-tight">
            Pengajuan Jemput Limbah
        </h1>
        <div class="w-9"></div>
    </div>

    <!-- Alert Box Rule Min 10L (Clean & Professional) -->
    <div class="bg-emerald-50/80 border border-emerald-200/90 rounded-2xl p-4 flex items-start space-x-3 text-xs text-emerald-900">
        <div class="w-6 h-6 rounded-lg bg-emerald-100 text-[#076342] flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="leading-relaxed">
            <strong class="font-bold text-emerald-950">Ketentuan Efisiensi Armada:</strong> Batas minimum penjemputan adalah <strong class="text-[#076342]">10 Liter</strong>. Gratis biaya armada ke seluruh 11 kecamatan Kota Jambi.
        </div>
    </div>

    @if($errors->any())
        <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl flex items-center space-x-2">
            <svg class="w-4 h-4 shrink-0 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('mobile.pickup.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Jenis Limbah -->
        <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs space-y-2.5">
            <label class="block text-xs font-bold text-slate-800">
                Pilih Jenis Limbah Kuliner
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                <label class="flex items-center justify-between p-3 rounded-2xl border border-slate-200 cursor-pointer hover:border-[#076342] hover:bg-emerald-50/30 has-[:checked]:border-[#076342] has-[:checked]:bg-emerald-50/60 has-[:checked]:ring-1 has-[:checked]:ring-[#076342] transition-all">
                    <div class="flex items-center space-x-2.5">
                        <input type="radio" name="waste_type" value="Minyak Jelantah" checked class="text-[#076342] focus:ring-[#076342] accent-[#076342]">
                        <span class="text-xs font-bold text-slate-900">Minyak Jelantah (UCO)</span>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100/80 px-2 py-0.5 rounded-md">Utama</span>
                </label>

                <label class="flex items-center justify-between p-3 rounded-2xl border border-slate-200 cursor-pointer hover:border-[#076342] hover:bg-emerald-50/30 has-[:checked]:border-[#076342] has-[:checked]:bg-emerald-50/60 has-[:checked]:ring-1 has-[:checked]:ring-[#076342] transition-all">
                    <div class="flex items-center space-x-2.5">
                        <input type="radio" name="waste_type" value="Minyak Jelantah dan Kardus" class="text-[#076342] focus:ring-[#076342] accent-[#076342]">
                        <span class="text-xs font-bold text-slate-900">Jelantah + Kardus</span>
                    </div>
                    <span class="text-[10px] font-bold text-amber-800 bg-amber-100/80 px-2 py-0.5 rounded-md">+ Bonus</span>
                </label>
            </div>
        </div>

        <!-- Estimasi Volume (Liter) & Preset Chips -->
        <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs space-y-3">
            <div class="flex items-center justify-between">
                <label for="estimated_volume" class="block text-xs font-bold text-slate-800">
                    Estimasi Volume (Liter)
                </label>
                <span class="text-[10px] text-emerald-800 font-bold bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200/80">
                    Harga: Rp{{ number_format($currentPrice, 0, ',', '.') }}/L
                </span>
            </div>

            <!-- Quick Preset Chips -->
            <div class="flex items-center space-x-2">
                <span class="text-[11px] text-slate-400 font-medium">Pilihan cepat:</span>
                <button type="button" onclick="setVolume(10)" class="preset-btn px-2.5 py-1 text-xs font-bold rounded-lg border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-[#076342] text-slate-700 transition-all">10L</button>
                <button type="button" onclick="setVolume(15)" class="preset-btn px-2.5 py-1 text-xs font-bold rounded-lg border border-[#076342] bg-emerald-50 text-[#076342] transition-all">15L</button>
                <button type="button" onclick="setVolume(25)" class="preset-btn px-2.5 py-1 text-xs font-bold rounded-lg border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-[#076342] text-slate-700 transition-all">25L</button>
                <button type="button" onclick="setVolume(50)" class="preset-btn px-2.5 py-1 text-xs font-bold rounded-lg border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-[#076342] text-slate-700 transition-all">50L</button>
            </div>

            <div class="relative">
                <input type="number" 
                       id="estimated_volume" 
                       name="estimated_volume" 
                       min="10" 
                       step="1"
                       value="{{ old('estimated_volume', '15') }}" 
                       required
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-base font-extrabold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#076342] focus:border-transparent bg-slate-50/50 hover:bg-white transition-all">
                <span class="absolute right-4 top-3.5 text-xs font-bold text-slate-400">Liter</span>
            </div>

            <!-- Calculation Output Card -->
            <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-between text-xs">
                <div>
                    <span class="text-[11px] text-slate-400 font-medium block">Estimasi Saldo Tunai:</span>
                    <strong id="est-price" class="text-sm font-black text-[#076342]">Rp112.500</strong>
                </div>
                <div class="text-right">
                    <span class="text-[11px] text-slate-400 font-medium block">Poin Reward:</span>
                    <strong id="est-point" class="text-sm font-black text-amber-600">+15 Poin</strong>
                </div>
            </div>
        </div>

        <!-- Lokasi Penjemputan -->
        <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs space-y-2">
            <div class="flex items-center justify-between">
                <label class="block text-xs font-bold text-slate-800">
                    Lokasi Penjemputan Warung
                </label>
                <a href="{{ route('mobile.profile.location') }}" class="text-[11px] font-bold text-[#076342] hover:underline">
                    Ubah Titik
                </a>
            </div>
            <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs text-slate-700 flex items-start space-x-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-[#076342] flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <strong class="text-slate-900 block text-xs">{{ $warung->business_name }}</strong>
                    <span class="text-[11px] text-slate-500 leading-relaxed block mt-0.5">
                        {{ $warung->address }} &bull; Kec. {{ $warung->subdistrict->name }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Catatan Tambahan -->
        <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-200/80 shadow-xs space-y-2">
            <label for="notes" class="block text-xs font-bold text-slate-800">
                Catatan untuk Armada Kurir (Opsional)
            </label>
            <textarea id="notes" 
                      name="notes" 
                      rows="2" 
                      placeholder="Contoh: Jerigen ada di dapur belakang, tolong jemput sebelum jam 12 siang..."
                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-[#076342] focus:border-transparent text-slate-800 bg-slate-50/50 hover:bg-white transition-all"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-4 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] hover:to-[#084a2c] text-white font-extrabold text-sm rounded-2xl shadow-md shadow-emerald-950/15 active:scale-[0.99] transition-all flex items-center justify-center space-x-2">
                <span>Kirim Permintaan Penjemputan</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>

    </form>

</div>

<script>
    const volumeInput = document.getElementById('estimated_volume');
    const estPrice = document.getElementById('est-price');
    const estPoint = document.getElementById('est-point');
    const pricePerLiter = {{ $currentPrice }};

    function updateCalculations() {
        const val = parseFloat(volumeInput.value) || 0;
        const total = val * pricePerLiter;
        estPrice.innerText = 'Rp' + total.toLocaleString('id-ID');
        estPoint.innerText = '+' + Math.floor(val) + ' Poin';
    }

    function setVolume(val) {
        volumeInput.value = val;
        updateCalculations();

        // Update button visual states
        document.querySelectorAll('.preset-btn').forEach(btn => {
            if (btn.innerText === val + 'L') {
                btn.className = 'preset-btn px-2.5 py-1 text-xs font-bold rounded-lg border border-[#076342] bg-emerald-50 text-[#076342] transition-all';
            } else {
                btn.className = 'preset-btn px-2.5 py-1 text-xs font-bold rounded-lg border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-[#076342] text-slate-700 transition-all';
            }
        });
    }

    volumeInput.addEventListener('input', updateCalculations);
</script>
@endsection
