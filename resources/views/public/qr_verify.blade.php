<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikasi Warung Sehat - {{ $warung->business_name }}</title>
    <link rel="icon" type="image/jpeg" href="/images/logo-official.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-200/80">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-[#076342] via-[#065035] to-[#0A5C36] p-6 text-white text-center relative overflow-hidden">
            <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/5 rounded-full blur-xl pointer-events-none"></div>

            <div class="flex items-center justify-center space-x-2.5 mb-3 relative z-10">
                <img src="{{ asset('images/logo-official.jpg') }}" alt="Logo SiklusJambi" class="w-9 h-9 object-contain rounded-xl bg-white p-0.5 shadow-md border border-amber-300">
                <span class="text-xs font-black text-amber-300 tracking-wider uppercase">SiklusJambi Official</span>
            </div>

            <div class="inline-flex items-center space-x-1.5 px-3 py-1 bg-white/15 rounded-full text-[11px] font-bold text-emerald-100 mb-2 border border-white/20 relative z-10">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                <span>Sertifikasi Sanitasi Pangan Kota Jambi</span>
            </div>

            <h1 class="text-2xl font-black uppercase tracking-tight text-white relative z-10">
                Warung Sehat
            </h1>
            <p class="text-xs text-emerald-100/90 mt-1 relative z-10">
                Verifikasi Keaslian Stiker Higienitas Bebas Daur Ulang Jelantah
            </p>
        </div>

        <!-- Verification Status Badge -->
        <div class="p-6 text-center space-y-5">
            @if($certificate->status === 'active' && !$certificate->isExpired())
                <div>
                    <div class="w-16 h-16 bg-emerald-50 text-[#076342] border border-emerald-200 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <span class="inline-flex items-center space-x-1.5 px-4 py-1.5 bg-emerald-100 text-emerald-800 font-extrabold text-xs rounded-full uppercase tracking-wider mb-2 border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Terverifikasi Aktif</span>
                    </span>
                    <p class="text-xs text-slate-500 mt-1">
                        Masa berlaku sertifikat: <strong class="text-slate-800 font-bold">{{ $certificate->days_remaining }} hari lagi</strong>
                    </p>
                </div>
            @else
                <div>
                    <div class="w-16 h-16 bg-rose-50 text-rose-600 border border-rose-200 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <span class="inline-flex items-center space-x-1.5 px-4 py-1.5 bg-rose-100 text-rose-800 font-extrabold text-xs rounded-full uppercase tracking-wider mb-2 border border-rose-200">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        <span>Sertifikat Kedaluwarsa</span>
                    </span>
                    <p class="text-xs text-slate-500 mt-1">
                        Warung ini belum menyetorkan jelantah dalam 30 hari terakhir.
                    </p>
                </div>
            @endif

            <!-- Warung Data (Safe for Public Consumer Inspection) -->
            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200/80 text-left space-y-3 text-xs">
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Nama Warung Kuliner:</span>
                    <strong class="text-slate-900 text-sm font-extrabold block mt-0.5">{{ $warung->business_name }}</strong>
                </div>

                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Nama Pemilik:</span>
                    <span class="text-slate-800 font-semibold block mt-0.5">{{ $warung->owner_name }}</span>
                </div>

                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Wilayah Operasional:</span>
                    <span class="text-slate-800 font-semibold block mt-0.5">Kecamatan {{ $warung->subdistrict->name }}, Kota Jambi</span>
                </div>

                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Nomor Registrasi Dinkes:</span>
                    <span class="font-mono font-bold text-[#076342] block mt-0.5">{{ $certificate->certificate_code }}</span>
                </div>

                <div class="pt-2 border-t border-slate-200/60 flex items-center justify-between">
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Limbah Terselamatkan:</span>
                        <span class="font-black text-slate-900 text-sm">{{ number_format($certificate->total_liters_saved, 1, ',', '.') }} Liter</span>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-md">
                        Bioavtur SAF Pertamina
                    </span>
                </div>
            </div>

            <!-- Footer Compliance Note -->
            <div class="pt-3 border-t border-slate-100 text-[10px] text-slate-400 text-center leading-relaxed">
                Diterbitkan secara digital oleh Sistem Informasi SiklusJambi bersama Dinas Kesehatan Pemerintah Kota Jambi dan PT Pertamina Patra Niaga.
            </div>
        </div>

    </div>

</body>
</html>
