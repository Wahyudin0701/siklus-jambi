<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\QrCertificate;
use App\Models\RewardPoint;
use App\Models\Subdistrict;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WarungProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loading()
    {
        return view('mobile.loading');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('mobile.dashboard');
        }
        return view('mobile.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->has('remember'));
            return redirect()->route('mobile.dashboard');
        }

        return back()->with('error', 'Nomor WhatsApp atau Kata Sandi salah. Silakan coba lagi.');
    }

    public function registerStep1()
    {
        return view('mobile.register.step1');
    }

    public function registerStep1Post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'terms' => 'accepted',
        ]);

        session([
            'reg_name' => $request->name,
            'reg_phone' => $request->phone_number,
        ]);

        return redirect()->route('mobile.register.step2');
    }

    public function registerStep2()
    {
        if (!session('reg_phone')) {
            return redirect()->route('mobile.register.step1');
        }
        return view('mobile.register.step2_otp');
    }

    public function registerStep2Post(Request $request)
    {
        // Simulation OTP: accepts any 4 digits
        return redirect()->route('mobile.register.step3');
    }

    public function registerStep3()
    {
        return view('mobile.register.step3_password');
    }

    public function registerStep3Post(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        session(['reg_password' => $request->password]);

        return redirect()->route('mobile.register.step4');
    }

    public function registerStep4()
    {
        $subdistricts = Subdistrict::orderBy('name')->get();
        return view('mobile.register.step4_business', compact('subdistricts'));
    }

    public function registerStep4Post(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'subdistrict_id' => 'required|exists:subdistricts,id',
            'daily_oil_usage' => 'required|numeric|min:1',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $name = session('reg_name', 'Wisnu Nugroho');
        $phone = session('reg_phone', '0812' . rand(10000000, 99999999));
        $password = session('reg_password', 'password123');

        // Create or update user
        $user = User::updateOrCreate(
            ['phone_number' => $phone],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'umkm',
                'is_verified' => true,
            ]
        );

        // Create Warung Profile
        $warung = WarungProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'subdistrict_id' => $request->subdistrict_id,
                'business_name' => $request->business_name,
                'owner_name' => $name,
                'address' => 'Kota Jambi',
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'daily_oil_usage' => $request->daily_oil_usage,
                'is_active' => true,
            ]
        );

        // Create Wallet
        Wallet::updateOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0.00]
        );

        // Create Reward Point
        RewardPoint::updateOrCreate(
            ['user_id' => $user->id],
            ['total_points' => 0]
        );

        // Issue initial QR Certificate (30-day validity)
        QrCertificate::updateOrCreate(
            ['warung_profile_id' => $warung->id],
            [
                'certificate_code' => QrCertificate::generateCertificateCode(),
                'qr_hash' => Str::random(32),
                'issued_at' => now(),
                'expires_at' => Carbon::now()->addDays(30),
                'status' => 'active',
                'total_liters_saved' => 0,
            ]
        );

        Auth::login($user);

        return redirect()->route('mobile.dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang di SiklusJambi.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('mobile.login');
    }
}
