@extends('layouts.mobile')

@section('content')
<div class="min-h-screen w-full flex flex-col justify-center items-center py-8 px-4 sm:px-6 bg-slate-50">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        
        <!-- Top Green Gradient Header -->
        <div class="bg-gradient-to-r from-[#076342] to-[#0A5C36] p-6 text-white text-center relative">
            <a href="{{ route('mobile.register.step2') }}" class="absolute left-5 top-5 inline-flex items-center text-xs font-semibold text-emerald-100 hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>

            <!-- Logo -->
            <div class="inline-block p-1.5 bg-white rounded-2xl shadow-sm mb-2">
                <img src="/images/logo-official.jpg" alt="Logo Resmi SiklusJambi" class="w-12 h-12 object-contain rounded-xl">
            </div>

            <h1 class="text-xl font-bold tracking-tight">Selamat Datang di SiklusJambi</h1>
            <p class="text-xs text-emerald-100/90 leading-relaxed mt-1">Langkah 3 dari 4: Buat Kata Sandi Keamanan Akun</p>
        </div>

        <div class="p-6 sm:p-8 space-y-5">
            <h2 class="text-xl font-bold text-slate-900 text-center">Buat Kata Sandi</h2>

            @if($errors->any())
                <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('mobile.register.step3.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Sandi Baru -->
                <div class="space-y-1">
                    <label for="password" class="block text-xs font-bold text-slate-800">
                        Sandi Baru :
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           value="password123"
                           placeholder="Masukkan kata sandi baru kamu...." 
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] text-slate-900 placeholder-slate-400 bg-slate-50/50">
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="space-y-1">
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-800">
                        Konfirmasi Kata Sandi :
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           value="password123"
                           placeholder="Ulangi kata sandi kamu...." 
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] text-slate-900 placeholder-slate-400 bg-slate-50/50">
                </div>

                <!-- Tombol Lanjut -->
                <div class="pt-3">
                    <button type="submit" 
                            class="w-full py-3.5 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-900/20 active:scale-[0.99] transition-all">
                        Lanjut ke Data Usaha &rarr;
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>
@endsection
