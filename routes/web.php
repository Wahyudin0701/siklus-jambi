<?php

use App\Http\Controllers\Courier\CourierController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\DashboardController as MobileDashboard;
use App\Http\Controllers\Stakeholder\DashboardController as StakeholderDashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Ekosistem SiklusJambi
|--------------------------------------------------------------------------
*/

// 0. Official Landing Page (Responsive Web Portal)
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/loading', [AuthController::class, 'loading'])->name('mobile.loading');

// 1. Mobile UMKM Auth Flow (sesuai Figma 9 Layar)
Route::get('/login', [AuthController::class, 'login'])->name('mobile.login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('mobile.login.post');

Route::prefix('register')->name('mobile.register.')->group(function () {
    Route::get('/', [AuthController::class, 'registerStep1'])->name('step1');
    Route::post('/', [AuthController::class, 'registerStep1Post'])->name('step1.post');
    Route::get('/otp', [AuthController::class, 'registerStep2'])->name('step2');
    Route::post('/otp', [AuthController::class, 'registerStep2Post'])->name('step2.post');
    Route::get('/password', [AuthController::class, 'registerStep3'])->name('step3');
    Route::post('/password', [AuthController::class, 'registerStep3Post'])->name('step3.post');
    Route::get('/business', [AuthController::class, 'registerStep4'])->name('step4');
    Route::post('/business', [AuthController::class, 'registerStep4Post'])->name('step4.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('mobile.logout');

// 2. Mobile UMKM Core App
Route::get('/beranda', [MobileDashboard::class, 'dashboard'])->name('mobile.dashboard');
Route::get('/jadwal', [MobileDashboard::class, 'schedule'])->name('mobile.schedule');
Route::get('/profil', [MobileDashboard::class, 'profile'])->name('mobile.profile');

Route::get('/jemput', [MobileDashboard::class, 'pickupCreate'])->name('mobile.pickup.create');
Route::post('/jemput', [MobileDashboard::class, 'pickupStore'])->name('mobile.pickup.store');

Route::get('/profil/stiker', [MobileDashboard::class, 'certificateView'])->name('mobile.certificate.view');
Route::get('/lokasi', [MobileDashboard::class, 'location'])->name('mobile.profile.location');
Route::get('/tukar-poin', [MobileDashboard::class, 'rewards'])->name('mobile.rewards');
Route::get('/harga-limbah', [MobileDashboard::class, 'prices'])->name('mobile.prices');
Route::get('/dampak-kita', [MobileDashboard::class, 'impact'])->name('mobile.impact');
Route::get('/berita', [MobileDashboard::class, 'news'])->name('mobile.news');

// 3. Public QR Verification
Route::get('/warung-sehat/{qr_hash}', [MobileDashboard::class, 'publicQr'])->name('public.qr');

// 4. Kurir Logistik Lapangan (Uji QC Standar SAF Pertamina)
Route::prefix('kurir')->name('courier.')->group(function () {
    Route::get('/', [CourierController::class, 'dashboard'])->name('dashboard');
    Route::get('/order/{order}/inspect', [CourierController::class, 'inspect'])->name('inspect');
    Route::post('/order/{order}/inspect', [CourierController::class, 'processInspection'])->name('inspect.post');
    Route::get('/manifest', [CourierController::class, 'manifest'])->name('manifest');
    Route::post('/manifest', [CourierController::class, 'generateManifest'])->name('manifest.generate');
});

// 5. Multi-Stakeholder Dashboard Command Center (1440x900)
Route::prefix('dashboard-instansi')->name('stakeholder.')->group(function () {
    Route::get('/', [StakeholderDashboard::class, 'index'])->name('dashboard');
    Route::post('/harga', [StakeholderDashboard::class, 'updatePrice'])->name('update_price');
    Route::post('/dinkes-warning/{certificate}', [StakeholderDashboard::class, 'sendDinkesWarning'])->name('dinkes_warning');
    Route::get('/export', [StakeholderDashboard::class, 'exportReport'])->name('export');
});
