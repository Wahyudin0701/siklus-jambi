@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-2xl mx-auto flex-1 flex flex-col p-4 sm:p-6 md:p-8 space-y-5 pb-12">
    <div class="flex items-center justify-between pt-1">
        <a href="{{ route('mobile.dashboard') }}" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-base md:text-lg font-extrabold text-[#076342]">Titik Lokasi Warung</h2>
        <div class="w-8"></div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4">
        <div class="flex items-center space-x-3">
            <span class="text-2xl">📍</span>
            <div>
                <h3 class="text-sm font-bold text-slate-900">{{ $warung->business_name }}</h3>
                <p class="text-xs text-slate-500">{{ $warung->address }}</p>
            </div>
        </div>

        <div id="map-view" class="w-full h-72 md:h-80 rounded-2xl border border-slate-200 overflow-hidden shadow-inner"></div>

        <div class="text-xs text-slate-600 space-y-1.5 pt-1 bg-slate-50 p-4 rounded-xl border border-slate-100">
            <p><strong>Kecamatan:</strong> {{ $warung->subdistrict->name }}</p>
            <p><strong>Koordinat GPS:</strong> {{ $warung->latitude }}, {{ $warung->longitude }}</p>
            <p class="text-emerald-700 font-semibold pt-1">✓ Titik penjemputan resmi terdaftar untuk kurir armada SiklusJambi</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lat = {{ $warung->latitude }};
        const lng = {{ $warung->longitude }};
        const map = L.map('map-view').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
        L.marker([lat, lng]).addTo(map).bindPopup("<b>{{ $warung->business_name }}</b><br>Titik Jemput Jelantah").openPopup();
    });
</script>
@endpush
@endsection
