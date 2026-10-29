@extends('layouts.mobile', ['statusBarTheme' => 'text-slate-800'])

@section('content')
<div class="w-full max-w-lg mx-auto flex-1 flex flex-col items-center justify-between py-12 md:py-20 px-6 text-center min-h-[85vh]">
    <!-- Top spacer -->
    <div class="h-4"></div>

    <!-- Center Logo & Branding -->
    <div class="flex flex-col items-center">
        <!-- Logo Emblem -->
        <div class="w-36 h-36 md:w-44 md:h-44 relative mb-6 flex items-center justify-center">
            <img src="{{ asset('images/logo-official.jpg') }}" 
                 alt="Logo Resmi SiklusJambi" 
                 class="w-full h-full object-contain rounded-3xl shadow-xl shadow-emerald-950/10 border border-slate-100 hover:scale-105 transition-transform duration-300">
        </div>

        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2">
            <span class="text-[#076342]">Siklus</span><span class="text-[#D88909]">Jambi</span>
        </h1>
        
        <p class="text-slate-600 text-xs md:text-sm font-medium leading-relaxed max-w-[280px]">
            Platform Ekonomi Sirkular Limbah Kuliner Kota Jambi & Rantai Pasok SAF Pertamina
        </p>
    </div>

    <!-- Bottom Progress / Loading Bar -->
    <div class="w-full max-w-[280px] flex flex-col items-center space-y-4">
        <div class="w-full bg-slate-100 rounded-full h-2 p-0.5 overflow-hidden border border-slate-200">
            <div id="loading-bar" class="bg-gradient-to-r from-[#076342] to-[#D88909] h-full rounded-full transition-all duration-300 w-1/4"></div>
        </div>
        <a href="{{ route('mobile.login') }}" class="text-xs text-slate-500 hover:text-[#076342] font-semibold transition-colors">
            Masuk Langsung &rarr;
        </a>
    </div>
</div>

<script>
    // Smooth progress bar animation that redirects to login after 2 seconds
    let progress = 20;
    const bar = document.getElementById('loading-bar');
    const interval = setInterval(() => {
        progress += 25;
        if (progress > 100) {
            clearInterval(interval);
            window.location.href = "{{ route('mobile.login') }}";
        } else {
            bar.style.width = progress + '%';
        }
    }, 450);
</script>
@endsection
