@extends('layouts.mobile')

@section('content')
<div class="min-h-screen w-full flex flex-col justify-center items-center py-8 px-4 sm:px-6 bg-slate-50">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        
        <!-- Top Green Gradient Header -->
        <div class="bg-gradient-to-r from-[#076342] to-[#0A5C36] p-6 text-white text-center relative">
            <a href="{{ route('mobile.register.step1') }}" class="absolute left-5 top-5 inline-flex items-center text-xs font-semibold text-emerald-100 hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>

            <!-- Logo -->
            <div class="inline-block p-1.5 bg-white rounded-2xl shadow-sm mb-2">
                <img src="/images/logo-official.jpg" alt="Logo Resmi SiklusJambi" class="w-12 h-12 object-contain rounded-xl">
            </div>

            <h1 class="text-xl font-bold tracking-tight">Selamat Datang di SiklusJambi</h1>
            <p class="text-xs text-emerald-100/90 leading-relaxed mt-1">
                Langkah 2 dari 4: Kode OTP dikirim ke <span class="font-bold text-amber-300">{{ session('reg_phone', '0812-xxxx-xxxx') }}</span>
            </p>
        </div>

        <div class="p-6 sm:p-8 space-y-5">
            <h2 class="text-xl font-bold text-slate-900 text-center">Verifikasi Kode OTP</h2>

            <div class="p-3 bg-amber-50 border border-amber-200 text-amber-800 text-xs rounded-xl text-center">
                💡 <strong>Mode Simulasi:</strong> Masukkan 4 angka bebas (contoh: <strong>1 2 3 4</strong>)
            </div>

            <form action="{{ route('mobile.register.step2.post') }}" method="POST" class="space-y-6">
                @csrf

                <!-- 4 Circular OTP Inputs -->
                <div class="flex justify-center items-center space-x-3.5 my-4">
                    <input type="text" maxlength="1" name="otp[]" value="1" autofocus
                           class="otp-digit w-14 h-14 rounded-2xl border border-slate-300 text-center text-xl font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#076342] bg-slate-50 transition-all">
                    <input type="text" maxlength="1" name="otp[]" value="2"
                           class="otp-digit w-14 h-14 rounded-2xl border border-slate-300 text-center text-xl font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#076342] bg-slate-50 transition-all">
                    <input type="text" maxlength="1" name="otp[]" value="3"
                           class="otp-digit w-14 h-14 rounded-2xl border border-slate-300 text-center text-xl font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#076342] bg-slate-50 transition-all">
                    <input type="text" maxlength="1" name="otp[]" value="4"
                           class="otp-digit w-14 h-14 rounded-2xl border border-slate-300 text-center text-xl font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#076342] bg-slate-50 transition-all">
                </div>

                <div class="text-center">
                    <button type="button" class="text-xs font-semibold text-[#2563EB] hover:underline">
                        Kirim Ulang Kode OTP
                    </button>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3.5 bg-gradient-to-r from-[#076342] to-[#0A5C36] hover:from-[#065035] text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-900/20 active:scale-[0.99] transition-all">
                        Verifikasi & Lanjut &rarr;
                    </button>
                </div>

                <div class="text-center pt-1">
                    <p class="text-xs text-slate-600 font-medium">
                        Ganti nomor? 
                        <a href="{{ route('mobile.register.step1') }}" class="text-[#2563EB] font-bold hover:underline">
                            Klik disini
                        </a>
                    </p>
                </div>
            </form>
        </div>

    </div>

</div>

<script>
    const inputs = document.querySelectorAll('.otp-digit');
    inputs.forEach((input, index) => {
        input.addEventListener('keyup', (e) => {
            if (e.key >= '0' && e.key <= '9') {
                if (index < inputs.length - 1) inputs[index + 1].focus();
            } else if (e.key === 'Backspace') {
                if (index > 0) inputs[index - 1].focus();
            }
        });
    });
</script>
@endsection
