@extends('layouts.mobile')

@section('content')
<div class="min-h-screen w-full flex flex-col justify-center items-center py-8 px-4 sm:px-6 bg-slate-50">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        
        <!-- Top Green Gradient Header -->
        <div class="bg-gradient-to-r from-[#076342] to-[#0A5C36] p-6 text-white text-center relative">
            <a href="{{ route('mobile.login') }}" class="absolute left-5 top-5 inline-flex items-center text-xs font-semibold text-emerald-100 hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>

            <!-- Logo -->
            <div class="inline-block p-1.5 bg-white rounded-2xl shadow-sm mb-2">
                <img src="/images/logo-official.jpg" alt="Logo Resmi SiklusJambi" class="w-12 h-12 object-contain rounded-xl">
            </div>

            <h1 class="text-xl font-bold tracking-tight">Selamat Datang di SiklusJambi</h1>
            <p class="text-xs text-emerald-100/90 leading-relaxed mt-1">Langkah 1 dari 4: Identitas Dasar Akun Warung</p>
        </div>

        <!-- Form Body -->
        <div class="p-6 sm:p-8 space-y-5">
            <h2 class="text-xl font-bold text-slate-900 text-center">Buat Akun Baru!</h2>

            @if($errors->any())
                <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('mobile.register.step1.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nama Lengkap -->
                <div class="space-y-1">
                    <label for="name" class="block text-xs font-bold text-slate-800">
                        Nama Lengkap :
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', session('reg_name', 'Wisnu Nugroho')) }}"
                           placeholder="Masukkan nama lengkap kamu...." 
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] text-slate-900 placeholder-slate-400 bg-slate-50/50">
                </div>

                <!-- Nomor Whatsapp -->
                <div class="space-y-1">
                    <label for="phone_number" class="block text-xs font-bold text-slate-800">
                        Nomor Whatsapp :
                    </label>
                    <input type="text" 
                           id="phone_number" 
                           name="phone_number" 
                           value="{{ old('phone_number', session('reg_phone', '081234567890')) }}"
                           placeholder="0812-xxxx-xxxx" 
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#076342] text-slate-900 placeholder-slate-400 bg-slate-50/50">
                </div>

                <!-- Checkbox S&K -->
                <div class="flex items-start pt-1">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms" 
                           required 
                           checked
                           class="w-4 h-4 mt-0.5 text-[#076342] border-slate-300 rounded focus:ring-[#076342] cursor-pointer">
                    <label for="terms" class="ml-2 text-xs text-slate-600 leading-tight select-none">
                        Saya menyatakan bahwa usaha kuliner saya berlokasi di wilayah Kota Jambi dan menyetujui Ketentuan Layanan SiklusJambi
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3.5 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-900/20 active:scale-[0.99] transition-all">
                        Lanjut ke Verifikasi OTP &rarr;
                    </button>
                </div>

                <div class="text-center pt-2">
                    <p class="text-xs text-slate-600 font-medium">
                        Sudah punya akun? 
                        <a href="{{ route('mobile.login') }}" class="text-[#2563EB] font-bold hover:underline">
                            Masuk disini
                        </a>
                    </p>
                </div>
            </form>
        </div>

    </div>

</div>
@endsection
