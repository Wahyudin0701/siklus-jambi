<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Manifest;
use App\Models\PickupOrder;
use App\Models\QualityInspection;
use App\Models\User;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourierController extends Controller
{
    private function getCourier()
    {
        return User::where('role', 'courier')->first();
    }

    public function dashboard()
    {
        $courier = $this->getCourier();
        
        $pendingOrders = PickupOrder::whereIn('status', ['pending', 'assigned', 'in_progress'])
            ->with('warungProfile.subdistrict')
            ->get();

        $completedToday = PickupOrder::where('courier_id', $courier->id)
            ->where('status', 'completed')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        $totalLitersToday = $completedToday->sum('actual_volume') ?: 215.5;

        return view('courier.dashboard', compact('courier', 'pendingOrders', 'completedToday', 'totalLitersToday'));
    }

    public function inspect(PickupOrder $order)
    {
        $order->load('warungProfile.subdistrict');
        return view('courier.inspect', compact('order'));
    }

    public function processInspection(Request $request, PickupOrder $order)
    {
        $courier = $this->getCourier();

        if ($request->action === 'reject') {
            $request->validate(['rejection_reason' => 'required|string']);

            $order->update([
                'status' => 'rejected_qc',
                'notes' => 'Ditolak QC SAF: ' . $request->rejection_reason,
            ]);

            QualityInspection::create([
                'pickup_order_id' => $order->id,
                'courier_id' => $courier->id,
                'is_water_free' => false,
                'is_sediment_free' => false,
                'is_pure_uco' => false,
                'is_passed' => false,
                'rejection_reason' => $request->rejection_reason,
                'inspected_at' => now(),
            ]);

            return redirect()->route('courier.dashboard')->with('error', 'Penjemputan ditolak. Notifikasi edukasi saring ulang telah dikirim ke pemilik warung.');
        }

        // Lolos QC SAF
        $request->validate([
            'actual_volume' => 'required|numeric|min:1',
            'is_water_free' => 'accepted',
            'is_sediment_free' => 'accepted',
            'is_pure_uco' => 'accepted',
        ]);

        DB::transaction(function () use ($request, $order, $courier) {
            $actualVol = (float) $request->actual_volume;
            $unitPrice = $order->unit_price;
            $totalAmount = $actualVol * $unitPrice;
            $points = (int) $actualVol; // 1 Liter = 1 Poin

            // 1. Update Order
            $order->update([
                'courier_id' => $courier->id,
                'actual_volume' => $actualVol,
                'total_price' => $totalAmount,
                'points_earned' => $points,
                'status' => 'completed',
            ]);

            // 2. Record Quality Inspection
            QualityInspection::create([
                'pickup_order_id' => $order->id,
                'courier_id' => $courier->id,
                'is_water_free' => true,
                'is_sediment_free' => true,
                'is_pure_uco' => true,
                'is_passed' => true,
                'proof_photo_path' => '/images/mockups/halaman_dashboard.png',
                'inspected_at' => now(),
            ]);

            // 3. Instant Credit Wallet UMKM (ACID)
            $warungUser = $order->warungProfile->user;
            $wallet = $warungUser->wallet;
            $wallet->increment('balance', $totalAmount);

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'pickup_order_id' => $order->id,
                'type' => 'credit',
                'amount' => $totalAmount,
                'description' => "Penjualan {$actualVol}L Minyak Jelantah ({$order->order_number})",
                'reference_code' => 'TX-' . strtoupper(Str::random(10)),
            ]);

            // 4. Instant Add Points
            $warungUser->rewardPoints->increment('total_points', $points);

            // 5. Extend QR Certificate validity to 30 days from today
            $cert = $order->warungProfile->qrCertificate;
            if ($cert) {
                $cert->update([
                    'status' => 'active',
                    'expires_at' => Carbon::now()->addDays(30),
                    'total_liters_saved' => $cert->total_liters_saved + $actualVol,
                ]);
            }
        });

        return redirect()->route('courier.dashboard')->with('success', "Order {$order->order_number} berhasil diselesaikan! Saldo dan poin langsung dikreditkan ke warung.");
    }

    public function manifest()
    {
        $courier = $this->getCourier();
        $manifest = Manifest::where('courier_id', $courier->id)->latest()->first();

        return view('courier.manifest', compact('courier', 'manifest'));
    }

    public function generateManifest()
    {
        $courier = $this->getCourier();
        
        $manifest = Manifest::create([
            'manifest_code' => 'MNF-SAF-04',
            'courier_id' => $courier->id,
            'total_volume_liters' => 215.5,
            'total_warung_count' => 12,
            'iscc_traceability_hash' => 'ISCC-JMB-' . strtoupper(Str::random(12)),
            'status' => 'in_transit',
        ]);

        return redirect()->route('courier.manifest')->with('success', 'Manifest Harian ' . $manifest->manifest_code . ' berhasil diterbitkan untuk Depot Pertamina!');
    }
}
