@extends('layouts.mobile')

@section('content')
<div class="min-h-screen w-full flex flex-col justify-center items-center py-8 px-4 sm:px-6 bg-slate-50">

    <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        
        <!-- Top Green Gradient Header -->
        <div class="bg-gradient-to-r from-[#076342] to-[#0A5C36] p-6 text-white text-center relative">
            <a href="{{ route('mobile.register.step3') }}" class="absolute left-5 top-5 inline-flex items-center text-xs font-semibold text-emerald-100 hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>

            <!-- Logo -->
            <div class="inline-block p-1.5 bg-white rounded-2xl shadow-sm mb-2">
                <img src="/images/logo-official.jpg" alt="Logo Resmi SiklusJambi" class="w-12 h-12 object-contain rounded-xl">
            </div>

            <h1 class="text-xl font-bold tracking-tight">Selamat Datang di SiklusJambi</h1>
            <p class="text-xs text-emerald-100/90 leading-relaxed mt-1">Langkah 4 dari 4: Lengkapi Lokasi & Data Usaha Kuliner</p>
        </div>

        <div class="p-6 sm:p-8 space-y-5">
            <h2 class="text-xl font-bold text-slate-900 text-center">Lengkapi Data Akun</h2>

            @if($errors->any())
                <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('mobile.register.step4.post') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Nama Usaha Warung -->
                <div class="space-y-1">
                    <label for="business_name" class="block text-xs font-bold text-slate-800">
                        Nama Tempat Usaha Kuliner :
                    </label>
                    <input type="text" 
                           id="business_name" 
                           name="business_name" 
                           value="{{ old('business_name', 'Rumah Makan Padang Payakumbuh') }}"
                           placeholder="Contoh: Warung Berkah / RM Sari Minang" 
                           required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] text-slate-900 bg-slate-50/50">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Kecamatan (11 Kecamatan di Kota Jambi) -->
                    <div class="space-y-1">
                        <label for="subdistrict_id" class="block text-xs font-bold text-slate-800">
                            Kecamatan :
                        </label>
                        <select id="subdistrict_id" 
                                name="subdistrict_id" 
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] text-slate-900 bg-slate-50/50">
                            <option value="">Pilih Kecamatan...</option>
                            @foreach($subdistricts as $subdistrict)
                                <option value="{{ $subdistrict->id }}" {{ $subdistrict->name == 'Jelutung' ? 'selected' : '' }}>
                                    Kecamatan {{ $subdistrict->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Penggunaan minyak perhari -->
                    <div class="space-y-1">
                        <label for="daily_oil_usage" class="block text-xs font-bold text-slate-800">
                            Penggunaan minyak perhari :
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   step="0.5"
                                   id="daily_oil_usage" 
                                   name="daily_oil_usage" 
                                   value="{{ old('daily_oil_usage', '15') }}"
                                   placeholder="Estimasi liter..." 
                                   required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] text-slate-900 bg-slate-50/50">
                            <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 font-semibold">L/Hari</span>
                        </div>
                    </div>
                </div>

                <!-- Foto Tempat Usaha -->
                <div class="space-y-1">
                    <label for="photo" class="block text-xs font-bold text-slate-800">
                        Foto Tempat Usaha :
                    </label>
                    <input type="file" 
                           id="photo" 
                           name="photo" 
                           accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#076342] hover:file:bg-emerald-100 border border-slate-200 rounded-xl bg-slate-50/50">
                </div>

                <!-- Kirim lokasi anda saat ini (Map Picker) -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-slate-800">
                            Kirim lokasi anda saat ini :
                        </label>
                        <span id="gps-status" class="text-[11px] text-emerald-700 font-semibold">
                            📍 Titik Jelutung Terdeteksi
                        </span>
                    </div>
                    
                    <div id="map-picker" class="w-full h-44 rounded-2xl border border-slate-300 overflow-hidden shadow-inner"></div>
                    
                    <input type="hidden" id="latitude" name="latitude" value="-1.614320">
                    <input type="hidden" id="longitude" name="longitude" value="103.606250">
                </div>

                <!-- Submit Button -->
                <div class="pt-3">
                    <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-900/20 active:scale-[0.99] transition-all">
                        Kirim & Selesaikan Pendaftaran
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const defaultLat = -1.614320;
        const defaultLng = 103.606250;
        const map = L.map('map-picker').setView([defaultLat, defaultLng], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap' }).addTo(map);

        let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);
        marker.bindPopup("<b>Lokasi Warung</b><br>Geser pin ke titik tepat warung").openPopup();

        marker.on('dragend', function (e) {
            const pos = marker.getLatLng();
            document.getElementById('latitude').value = pos.lat.toFixed(6);
            document.getElementById('longitude').value = pos.lng.toFixed(6);
            document.getElementById('gps-status').innerText = '📍 Pin: (' + pos.lat.toFixed(4) + ', ' + pos.lng.toFixed(4) + ')';
        });
    });
</script>
@endpush
@endsection
