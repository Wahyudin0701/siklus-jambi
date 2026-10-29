<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\EnvironmentalImpactLog;
use App\Models\PickupOrder;
use App\Models\QrCertificate;
use App\Models\RewardCatalog;
use App\Models\RewardPoint;
use App\Models\Wallet;
use App\Models\WarungProfile;
use App\Models\WastePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private function getAuthenticatedUser()
    {
        return Auth::user() ?? \App\Models\User::where('phone_number', '081234567890')->first();
    }

    public function dashboard()
    {
        $user = $this->getAuthenticatedUser();
        $warung = $user->warungProfile ?? WarungProfile::first();
        $wallet = $user->wallet ?? Wallet::first();
        $rewardPoint = $user->rewardPoints ?? RewardPoint::first();
        
        $activeOrder = PickupOrder::where('warung_profile_id', $warung->id ?? 1)
            ->whereIn('status', ['pending', 'in_progress'])
            ->latest()
            ->first();

        $certificate = $warung->qrCertificate ?? QrCertificate::first();
        $currentPrice = WastePrice::getCurrentPrice('minyak_jelantah') ?? 7500;

        return view('mobile.dashboard', compact('user', 'warung', 'wallet', 'rewardPoint', 'activeOrder', 'certificate', 'currentPrice'));
    }

    public function schedule()
    {
        $user = $this->getAuthenticatedUser();
        $warung = $user->warungProfile ?? WarungProfile::first();
        
        $orders = PickupOrder::where('warung_profile_id', $warung->id)
            ->latest()
            ->get();

        return view('mobile.schedule', compact('user', 'warung', 'orders'));
    }

    public function profile()
    {
        $user = $this->getAuthenticatedUser();
        $warung = $user->warungProfile ?? WarungProfile::first();
        $rewardPoint = $user->rewardPoints ?? RewardPoint::first();
        $wallet = $user->wallet ?? Wallet::first();

        return view('mobile.profile', compact('user', 'warung', 'rewardPoint', 'wallet'));
    }

    public function pickupCreate()
    {
        $user = $this->getAuthenticatedUser();
        $warung = $user->warungProfile ?? WarungProfile::first();
        $currentPrice = WastePrice::getCurrentPrice('minyak_jelantah');

        return view('mobile.pickup.create', compact('user', 'warung', 'currentPrice'));
    }

    public function pickupStore(Request $request)
    {
        $request->validate([
            'estimated_volume' => 'required|numeric|min:10', // BR-01: Minimum 10 Liter
            'waste_type' => 'required|string',
        ], [
            'estimated_volume.min' => 'Batas minimum pengajuan penjemputan adalah 10 Liter untuk efisiensi armada logistik.',
        ]);

        $user = $this->getAuthenticatedUser();
        $warung = $user->warungProfile ?? WarungProfile::first();
        $unitPrice = WastePrice::getCurrentPrice('minyak_jelantah');
        $totalPrice = $request->estimated_volume * $unitPrice;

        $order = PickupOrder::create([
            'order_number' => PickupOrder::generateOrderNumber(),
            'warung_profile_id' => $warung->id,
            'waste_type' => $request->waste_type,
            'estimated_volume' => $request->estimated_volume,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'points_earned' => (int) $request->estimated_volume, // 1 Liter = 1 Poin
            'status' => 'in_progress', // Langsung masuk antrean proses jemput
            'notes' => $request->notes,
        ]);

        return redirect()->route('mobile.schedule')->with('success', 'Permintaan penjemputan ' . $order->order_number . ' berhasil diajukan!');
    }

    public function certificateView()
    {
        $user = $this->getAuthenticatedUser();
        $warung = $user->warungProfile ?? WarungProfile::first();
        $certificate = $warung->qrCertificate ?? QrCertificate::first();

        return view('mobile.certificate.view', compact('user', 'warung', 'certificate'));
    }

    public function publicQr($qr_hash)
    {
        $certificate = QrCertificate::where('qr_hash', $qr_hash)->firstOrFail();
        $warung = $certificate->warungProfile;

        return view('public.qr_verify', compact('certificate', 'warung'));
    }

    public function location()
    {
        $user = $this->getAuthenticatedUser();
        $warung = $user->warungProfile ?? WarungProfile::first();
        return view('mobile.quick_views.location', compact('warung'));
    }

    public function rewards()
    {
        $user = $this->getAuthenticatedUser();
        $rewardPoint = $user->rewardPoints ?? RewardPoint::first();
        $catalogs = RewardCatalog::where('is_active', true)->get();
        return view('mobile.quick_views.rewards', compact('rewardPoint', 'catalogs'));
    }

    public function prices()
    {
        $prices = WastePrice::where('is_active', true)->get();
        return view('mobile.quick_views.prices', compact('prices'));
    }

    public function impact()
    {
        $impact = EnvironmentalImpactLog::first();
        return view('mobile.quick_views.impact', compact('impact'));
    }

    public function news()
    {
        return view('mobile.quick_views.news');
    }
}
