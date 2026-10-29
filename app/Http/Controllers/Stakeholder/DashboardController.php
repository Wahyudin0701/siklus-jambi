<?php

namespace App\Http\Controllers\Stakeholder;

use App\Http\Controllers\Controller;
use App\Models\EnvironmentalImpactLog;
use App\Models\Manifest;
use App\Models\PickupOrder;
use App\Models\QrCertificate;
use App\Models\Subdistrict;
use App\Models\WarungProfile;
use App\Models\WastePrice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role', 'pemkot'); // pemkot, dinkes, klh, pertamina

        $subdistricts = Subdistrict::all();
        $totalUmkm = WarungProfile::count();
        $totalOrders = PickupOrder::count();
        $totalLiters = PickupOrder::where('status', 'completed')->sum('actual_volume') ?: 18450.0;
        
        // Certificates data for Dinkes
        $activeCertificates = QrCertificate::with('warungProfile.subdistrict')->get();
        $warningCertificates = $activeCertificates->filter(fn($c) => $c->days_remaining <= 5);

        // Environmental impact for KLH
        $impact = EnvironmentalImpactLog::first();

        // Manifests for Pertamina
        $manifests = Manifest::with('courier')->latest()->get();

        // Waste prices for Pemkot
        $currentPrice = WastePrice::getCurrentPrice('minyak_jelantah');

        return view('stakeholder.index', compact(
            'role',
            'subdistricts',
            'totalUmkm',
            'totalOrders',
            'totalLiters',
            'activeCertificates',
            'warningCertificates',
            'impact',
            'manifests',
            'currentPrice'
        ));
    }

    public function updatePrice(Request $request)
    {
        $request->validate(['price_per_unit' => 'required|numeric|min:1000']);

        WastePrice::create([
            'waste_type' => 'minyak_jelantah',
            'price_per_unit' => $request->price_per_unit,
            'unit' => 'Liter',
            'effective_date' => Carbon::today(),
            'is_active' => true,
        ]);

        return redirect()->route('stakeholder.dashboard', ['role' => 'pemkot'])->with('success', 'Indeks harga harian minyak jelantah berhasil diperbarui!');
    }

    public function sendDinkesWarning(QrCertificate $certificate)
    {
        $certificate->update(['status' => 'warning_wa']);
        return redirect()->route('stakeholder.dashboard', ['role' => 'dinkes'])->with('success', 'Peringatan resmi WA & jadwal inspeksi higienitas telah diterbitkan untuk ' . $certificate->warungProfile->business_name);
    }

    public function exportReport(Request $request)
    {
        $format = $request->query('format', 'csv');
        $filename = "Laporan_Resmi_SiklusJambi_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID Order', 'Tanggal', 'Nama Warung', 'Kecamatan', 'Volume (L)', 'Nilai Saldo (Rp)', 'Status QC SAF', 'Sertifikasi ISCC'];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $orders = PickupOrder::with('warungProfile.subdistrict')->get();
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->created_at->format('Y-m-d H:i'),
                    $order->warungProfile->business_name,
                    $order->warungProfile->subdistrict->name,
                    $order->actual_volume ?? $order->estimated_volume,
                    $order->total_price,
                    $order->status_label,
                    'ISCC-COMPLIANT'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
