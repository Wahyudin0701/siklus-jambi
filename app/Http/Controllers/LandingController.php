<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalImpactLog;
use App\Models\QrCertificate;
use App\Models\Subdistrict;
use App\Models\WarungProfile;
use App\Models\WastePrice;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the official SiklusJambi landing page.
     */
    public function index()
    {
        $impact = null;
        $currentPrice = 7500;
        $subdistricts = collect();
        $totalWarung = 1250;
        $sampleCertificate = null;

        try {
            $impact = EnvironmentalImpactLog::latest()->first();
            $currentPrice = WastePrice::where('waste_type', 'minyak_jelantah')
                ->where('is_active', true)
                ->first()?->price_per_unit ?? 7500;
            $subdistricts = Subdistrict::orderBy('name', 'asc')->get();
            $totalCount = WarungProfile::count();
            $totalWarung = $totalCount > 0 ? (1250 + $totalCount) : 1250;
            $sampleCertificate = QrCertificate::with('warungProfile.subdistrict')
                ->where('status', 'active')
                ->latest()
                ->first();
        } catch (\Throwable $e) {
            // Graceful fallback if database table not yet migrated
        }

        // Default subdistricts fallback if table empty
        if ($subdistricts->isEmpty()) {
            $subdistricts = collect([
                (object)['id' => 1, 'name' => 'Alam Barajo'],
                (object)['id' => 2, 'name' => 'Danau Sipin'],
                (object)['id' => 3, 'name' => 'Danau Teluk'],
                (object)['id' => 4, 'name' => 'Jambi Selatan'],
                (object)['id' => 5, 'name' => 'Jambi Timur'],
                (object)['id' => 6, 'name' => 'Jelutung'],
                (object)['id' => 7, 'name' => 'Kota Baru'],
                (object)['id' => 8, 'name' => 'Paal Merah'],
                (object)['id' => 9, 'name' => 'Pasar Jambi'],
                (object)['id' => 10, 'name' => 'Pelayangan'],
                (object)['id' => 11, 'name' => 'Telanaipura'],
            ]);
        }

        return view('landing', compact('impact', 'currentPrice', 'subdistricts', 'totalWarung', 'sampleCertificate'));
    }
}
