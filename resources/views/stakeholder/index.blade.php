<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Command Center Multi-Stakeholder - SiklusJambi</title>
    
    <!-- Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Leaflet GIS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen font-sans flex flex-col">

    <!-- Top Navigation Bar -->
    <header class="bg-slate-950 border-b border-slate-800 px-4 lg:px-6 py-3.5 flex flex-col xl:flex-row items-start xl:items-center justify-between gap-3 sticky top-0 z-50">
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-official.jpg') }}" alt="Logo Resmi SiklusJambi" class="w-10 h-10 object-contain rounded-xl bg-white p-0.5 shadow-lg shadow-emerald-950/40 border border-slate-700 shrink-0">
                <div>
                    <h1 class="text-sm font-extrabold tracking-tight text-white flex items-center space-x-2">
                        <span>SIKLUSJAMBI COMMAND CENTER</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">1440x900 READY</span>
                    </h1>
                    <p class="text-[11px] text-slate-400">Monitoring Spasial GIS 11 Kecamatan Kota Jambi Menuju Bioavtur SAF Pertamina</p>
                </div>
            </div>
        </div>

        <!-- Role Selector Switcher (Multi-Stakeholder) -->
        <div class="flex items-center space-x-2 bg-slate-900 p-1.5 rounded-2xl border border-slate-800">
            <span class="text-[11px] text-slate-400 font-bold px-2">PERAN INSTANSI:</span>

            <!-- Pemkot -->
            <a href="?role=pemkot" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $role === 'pemkot' ? 'bg-[#076342] text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                🏛️ Pemkot Jambi (PUPR/DLH)
            </a>

            <!-- Dinkes -->
            <a href="?role=dinkes" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $role === 'dinkes' ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                🏥 Dinkes (Warung Sehat)
            </a>

            <!-- KLH -->
            <a href="?role=klh" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $role === 'klh' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                🌿 KLH (Dekarbonisasi)
            </a>

            <!-- Pertamina -->
            <a href="?role=pertamina" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all {{ $role === 'pertamina' ? 'bg-purple-700 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                ⛽ PT Pertamina SAF
            </a>
        </div>

        <!-- Right Action Button -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('stakeholder.export', ['format' => 'csv']) }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-xl text-xs font-bold border border-slate-700 shadow-sm flex items-center space-x-1.5">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Ekspor Laporan Resmi (CSV)</span>
            </a>
            <a href="{{ route('mobile.dashboard') }}" target="_blank" class="px-3 py-2 bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-300 rounded-xl text-xs font-bold border border-emerald-500/30">
                📱 Buka App Mobile UMKM &rarr;
            </a>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="flex-1 p-6 space-y-6 max-w-[1600px] w-full mx-auto">

        <!-- Top 4 KPI Metric Cards -->
        <div class="grid grid-cols-4 gap-4">
            <!-- 1. Total Jelantah Terserap -->
            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800 shadow-lg relative overflow-hidden">
                <span class="text-[11px] uppercase tracking-wider font-bold text-slate-400 block mb-1">Total Jelantah Terserap</span>
                <span class="text-3xl font-black text-white">18.450 <span class="text-sm font-semibold text-emerald-400">Liter</span></span>
                <span class="text-[11px] text-emerald-400 block mt-2 font-medium">↑ +14.2% dari target bulanan</span>
            </div>

            <!-- 2. Mitigasi Fatberg Drainase -->
            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800 shadow-lg relative overflow-hidden">
                <span class="text-[11px] uppercase tracking-wider font-bold text-slate-400 block mb-1">Mitigasi Fatberg Drainase</span>
                <span class="text-3xl font-black text-amber-400">30 <span class="text-sm font-semibold text-slate-400">RT Rawan</span></span>
                <span class="text-[11px] text-slate-400 block mt-2 font-medium">Bebas sumbatan lemak di 11 Kecamatan</span>
            </div>

            <!-- 3. UMKM Berstiker Warung Sehat -->
            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800 shadow-lg relative overflow-hidden">
                <span class="text-[11px] uppercase tracking-wider font-bold text-slate-400 block mb-1">Kepatuhan Warung Sehat</span>
                <span class="text-3xl font-black text-blue-400">840 <span class="text-sm font-semibold text-slate-400">UMKM Aktif</span></span>
                <span class="text-[11px] text-blue-300 block mt-2 font-medium">Audit rutin Dinkes $\le$ 30 hari</span>
            </div>

            <!-- 4. Pasokan Bioavtur Pertamina SAF -->
            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800 shadow-lg relative overflow-hidden">
                <span class="text-[11px] uppercase tracking-wider font-bold text-slate-400 block mb-1">Realisasi Kuota SAF Pertamina</span>
                <span class="text-3xl font-black text-purple-400">92,2% <span class="text-sm font-semibold text-slate-400">(14.760 L)</span></span>
                <span class="text-[11px] text-purple-300 block mt-2 font-medium">Sertifikasi rantai pasok ISCC valid</span>
            </div>
        </div>

        <!-- Middle Section: Left GIS Map + Right Dynamic Role Panel -->
        <div class="grid grid-cols-12 gap-6 items-start">
            
            <!-- Left: GIS Spatial Heatmap 11 Kecamatan (7 cols) -->
            <div class="col-span-7 bg-slate-950 rounded-2xl border border-slate-800 shadow-xl overflow-hidden p-5 space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-sm font-bold text-white flex items-center space-x-2">
                            <span>🗺️ Peta Spasial Geografis 11 Kecamatan Kota Jambi</span>
                        </h2>
                        <p class="text-[11px] text-slate-400">Sebaran titik penjemputan jelantah, rute kurir OSRM, & zona risiko fatberg</p>
                    </div>
                    <div class="flex items-center space-x-2 text-[10px]">
                        <span class="flex items-center"><span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block mr-1"></span> Risiko Tinggi (Fatberg)</span>
                        <span class="flex items-center"><span class="w-2.5 h-2.5 rounded-full bg-amber-500 inline-block mr-1"></span> Sedang</span>
                        <span class="flex items-center"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block mr-1"></span> Rendah / Bersih</span>
                    </div>
                </div>

                <!-- Leaflet GIS Map Container -->
                <div id="gis-command-map" class="w-full h-[450px] rounded-xl border border-slate-800 shadow-inner"></div>

                <!-- Subdistrict Stats Table -->
                <div class="max-h-48 overflow-y-auto no-scrollbar border border-slate-800/80 rounded-xl">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-900 text-slate-400 uppercase text-[10px] sticky top-0">
                            <tr>
                                <th class="p-2.5">Kecamatan</th>
                                <th class="p-2.5">Tingkat Risiko Fatberg</th>
                                <th class="p-2.5">UMKM Aktif</th>
                                <th class="p-2.5">Total Terserap</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @foreach($subdistricts as $s)
                            <tr class="hover:bg-slate-900/50">
                                <td class="p-2.5 font-bold text-white">{{ $s->name }}</td>
                                <td class="p-2.5">
                                    @if($s->fatberg_risk_level === 'high')
                                        <span class="px-2 py-0.5 rounded-full bg-red-500/20 text-red-400 font-semibold text-[10px]">Tinggi (3 RT Pantau)</span>
                                    @elseif($s->fatberg_risk_level === 'medium')
                                        <span class="px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-400 font-semibold text-[10px]">Sedang</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 font-semibold text-[10px]">Rendah</span>
                                    @endif
                                </td>
                                <td class="p-2.5 text-slate-300">{{ $s->active_umkm_count }} Warung</td>
                                <td class="p-2.5 font-bold text-emerald-400">{{ number_format($s->total_oil_collected, 1, ',', '.') }} L</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right: Dynamic Instansi Panel (5 cols) -->
            <div class="col-span-5 space-y-6">

                <!-- 1. Panel PEMKOT (PUPR & DLH) -->
                @if($role === 'pemkot')
                <div class="bg-slate-950 rounded-2xl border border-slate-800 p-5 space-y-4 shadow-xl">
                    <div class="flex items-center space-x-2 text-[#076342]">
                        <span class="text-xl">🏛️</span>
                        <h3 class="text-sm font-bold text-white">Panel Pemkot Jambi (PUPR & DLH)</h3>
                    </div>

                    <!-- Update Harga Harian Form -->
                    <div class="bg-slate-900 p-4 rounded-xl border border-slate-800 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-300">Indeks Harga Jelantah Saat Ini:</span>
                            <span class="text-sm font-black text-emerald-400">Rp{{ number_format($currentPrice, 0, ',', '.') }}/L</span>
                        </div>

                        <form action="{{ route('stakeholder.update_price') }}" method="POST" class="space-y-2">
                            @csrf
                            <label class="block text-[11px] text-slate-400">Perbarui Harga Beli Harian (Rp/Liter) :</label>
                            <div class="flex space-x-2">
                                <input type="number" name="price_per_unit" value="{{ $currentPrice }}" step="100" min="1000" class="flex-1 px-3 py-2 bg-slate-950 border border-slate-700 rounded-xl text-xs font-bold text-white focus:outline-none focus:border-emerald-500">
                                <button type="submit" class="px-4 py-2 bg-[#076342] text-white rounded-xl text-xs font-bold hover:bg-[#065035]">Simpan</button>
                            </div>
                        </form>
                    </div>

                    <!-- 30 RT Fatberg Points Alert -->
                    <div class="space-y-2">
                        <h4 class="text-xs font-bold text-slate-300">Fokus Mitigasi Drainase 30 RT Rawan Banjir:</h4>
                        <div class="space-y-1.5 text-xs text-slate-400 max-h-48 overflow-y-auto no-scrollbar">
                            <div class="p-2.5 bg-slate-900 rounded-xl border border-slate-800 flex justify-between items-center">
                                <span>Kec. Jelutung (RT 04 Cempaka Putih)</span>
                                <span class="text-emerald-400 font-bold">Terserap 3.450 L</span>
                            </div>
                            <div class="p-2.5 bg-slate-900 rounded-xl border border-slate-800 flex justify-between items-center">
                                <span>Kec. Danau Sipin (RT 02 Legok)</span>
                                <span class="text-emerald-400 font-bold">Terserap 2.680 L</span>
                            </div>
                            <div class="p-2.5 bg-slate-900 rounded-xl border border-slate-800 flex justify-between items-center">
                                <span>Kec. Pasar Jambi (RT 01 Pasar)</span>
                                <span class="text-emerald-400 font-bold">Terserap 1.950 L</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- 2. Panel DINKES & KEMENKES -->
                @if($role === 'dinkes')
                <div class="bg-slate-950 rounded-2xl border border-slate-800 p-5 space-y-4 shadow-xl">
                    <div class="flex items-center space-x-2 text-blue-400">
                        <span class="text-xl">🏥</span>
                        <h3 class="text-sm font-bold text-white">Panel Dinas Kesehatan (Sanitasi Warung Sehat)</h3>
                    </div>

                    <p class="text-xs text-slate-400 leading-relaxed">
                        Aturan Kepatuhan 30 Hari: Warung yang tidak menyetor jelantah dalam 30 hari dinonaktifkan stiker QR-nya dan dijadwalkan inspeksi higienitas.
                    </p>

                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-amber-400">⚠️ Warung Pasif Mendekati / Melewati Ambang 30 Hari:</h4>
                        
                        @forelse($activeCertificates as $cert)
                        <div class="p-3 bg-slate-900 rounded-xl border border-slate-800 space-y-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <strong class="text-xs text-white block">{{ $cert->warungProfile->business_name }}</strong>
                                    <span class="text-[11px] text-slate-400">{{ $cert->warungProfile->owner_name }} (Kec. {{ $cert->warungProfile->subdistrict->name }})</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-400">
                                    {{ $cert->days_remaining }} Hari Lagi
                                </span>
                            </div>

                            <form action="{{ route('stakeholder.dinkes_warning', $cert->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition-colors">
                                    Kirim Peringatan WA & Jadwal Inspeksi
                                </button>
                            </form>
                        </div>
                        @empty
                        <p class="text-xs text-slate-500">Semua warung patuh dan aktif!</p>
                        @endforelse
                    </div>
                </div>
                @endif

                <!-- 3. Panel KLH (Dekarbonisasi & DAS) -->
                @if($role === 'klh')
                <div class="bg-slate-950 rounded-2xl border border-slate-800 p-5 space-y-4 shadow-xl">
                    <div class="flex items-center space-x-2 text-emerald-400">
                        <span class="text-xl">🌿</span>
                        <h3 class="text-sm font-bold text-white">Kementerian Lingkungan Hidup (Audit Dekarbonisasi)</h3>
                    </div>

                    <div class="bg-gradient-to-r from-blue-950 to-cyan-950 p-4 rounded-xl border border-blue-900/50 space-y-1">
                        <span class="text-[10px] text-blue-300 font-bold uppercase">Pencegahan Pencemaran DAS</span>
                        <h4 class="text-xl font-black text-white">18,45 Juta Liter Air</h4>
                        <p class="text-[11px] text-blue-200">Volume air Sungai Batanghari yang terselamatkan dari pencemaran minyak jelantah.</p>
                    </div>

                    <div class="bg-gradient-to-r from-emerald-950 to-green-950 p-4 rounded-xl border border-emerald-900/50 space-y-1">
                        <span class="text-[10px] text-emerald-300 font-bold uppercase">Kalkulasi Dekarbonisasi Nasional</span>
                        <h4 class="text-xl font-black text-white">-39,8 Ton CO₂e</h4>
                        <p class="text-[11px] text-emerald-200">Reduksi emisi gas rumah kaca terverifikasi melalui konversi limbah ke bahan bakar hayati.</p>
                    </div>
                </div>
                @endif

                <!-- 4. Panel PERTAMINA (SAF Bioavtur) -->
                @if($role === 'pertamina')
                <div class="bg-slate-950 rounded-2xl border border-slate-800 p-5 space-y-4 shadow-xl">
                    <div class="flex items-center space-x-2 text-purple-400">
                        <span class="text-xl">⛽</span>
                        <h3 class="text-sm font-bold text-white">PT Pertamina (Proyek SAF Bioavtur & ISCC)</h3>
                    </div>

                    <div class="bg-purple-950/40 p-4 rounded-xl border border-purple-900/50 space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-purple-300">Kuota Bulanan SAF Jambi:</span>
                            <span class="font-bold text-white">14.760 L / 16.000 L</span>
                        </div>
                        <div class="w-full bg-purple-900/50 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 92.2%"></div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h4 class="text-xs font-bold text-slate-300">Audit Traceability Manifest ISCC Masuk:</h4>
                        <div class="space-y-2 max-h-48 overflow-y-auto no-scrollbar">
                            @foreach($manifests as $m)
                            <div class="p-3 bg-slate-900 rounded-xl border border-slate-800 text-xs space-y-1">
                                <div class="flex justify-between">
                                    <strong class="text-purple-400">{{ $m->manifest_code }}</strong>
                                    <span class="text-emerald-400 font-bold">{{ $m->total_volume_liters }} L</span>
                                </div>
                                <div class="text-[10px] text-slate-400">
                                    Kurir: {{ $m->courier->name }} | {{ $m->total_warung_count }} Warung Asal
                                </div>
                                <div class="text-[9px] font-mono text-slate-500">
                                    Hash: {{ substr($m->iscc_traceability_hash, 0, 24) }}...
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

            </div>

        </div>

    </main>

    <footer class="bg-slate-950 border-t border-slate-800 p-4 text-center text-xs text-slate-500">
        Sistem Informasi SiklusJambi © 2026 — Kolaborasi Pemkot Jambi, Kemenkes, KLH & PT Pertamina Bioavtur.
    </footer>

    <!-- Leaflet GIS Map Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Center of Kota Jambi
            const jambiLat = -1.6101229;
            const jambiLng = 103.6131203;

            const map = L.map('gis-command-map').setView([jambiLat, jambiLng], 12);

            // Dark CartoDB Tiles for Command Center Look
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap &copy; CARTO',
                subdomains: 'abcd',
                maxZoom: 19
            }).addTo(map);

            // Subdistricts data pins
            const subdistricts = @json($subdistricts);

            subdistricts.forEach(s => {
                let color = '#10B981'; // Green
                if (s.fatberg_risk_level === 'high') color = '#EF4444'; // Red
                else if (s.fatberg_risk_level === 'medium') color = '#F59E0B'; // Amber

                const circle = L.circleMarker([s.latitude, s.longitude], {
                    radius: 8 + (s.total_oil_collected / 400),
                    fillColor: color,
                    color: '#ffffff',
                    weight: 1.5,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(map);

                circle.bindPopup(`
                    <div style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12px; color: #0f172a; padding: 4px;">
                        <strong style="font-size: 13px; color: #076342;">Kecamatan ${s.name}</strong><br>
                        <strong>Terserap:</strong> ${Number(s.total_oil_collected).toLocaleString('id-ID')} Liter<br>
                        <strong>UMKM Aktif:</strong> ${s.active_umkm_count} Warung<br>
                        <strong>Risiko Fatberg:</strong> ${s.fatberg_risk_level.toUpperCase()}
                    </div>
                `);
            });
        });
    </script>
</body>
</html>
