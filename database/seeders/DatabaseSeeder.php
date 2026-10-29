<?php

namespace Database\Seeders;

use App\Models\EnvironmentalImpactLog;
use App\Models\PickupOrder;
use App\Models\QrCertificate;
use App\Models\QualityInspection;
use App\Models\RewardCatalog;
use App\Models\RewardPoint;
use App\Models\Subdistrict;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\WarungProfile;
use App\Models\WastePrice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed 11 Kecamatan di Kota Jambi
        $subdistrictsData = [
            [
                'name' => 'Jelutung',
                'latitude' => -1.614300,
                'longitude' => 103.606200,
                'fatberg_hotspots_rt' => ['RT 04 Cempaka Putih', 'RT 12 Handil Jaya', 'RT 09 Jelutung'],
                'fatberg_risk_level' => 'high',
                'active_umkm_count' => 142,
                'total_oil_collected' => 3450.50,
            ],
            [
                'name' => 'Telanaipura',
                'latitude' => -1.595600,
                'longitude' => 103.582400,
                'fatberg_hotspots_rt' => ['RT 03 Telanaipura', 'RT 07 Simpang IV Sipin'],
                'fatberg_risk_level' => 'medium',
                'active_umkm_count' => 98,
                'total_oil_collected' => 2120.00,
            ],
            [
                'name' => 'Danau Sipin',
                'latitude' => -1.589200,
                'longitude' => 103.598700,
                'fatberg_hotspots_rt' => ['RT 02 Legok', 'RT 05 Sungai Putri'],
                'fatberg_risk_level' => 'high',
                'active_umkm_count' => 110,
                'total_oil_collected' => 2680.00,
            ],
            [
                'name' => 'Pasar Jambi',
                'latitude' => -1.586100,
                'longitude' => 103.617500,
                'fatberg_hotspots_rt' => ['RT 01 Pasar', 'RT 06 Beringin'],
                'fatberg_risk_level' => 'high',
                'active_umkm_count' => 85,
                'total_oil_collected' => 1950.00,
            ],
            [
                'name' => 'Jambi Timur',
                'latitude' => -1.597500,
                'longitude' => 103.638200,
                'fatberg_hotspots_rt' => ['RT 11 Kasang', 'RT 08 Rajawali'],
                'fatberg_risk_level' => 'medium',
                'active_umkm_count' => 76,
                'total_oil_collected' => 1840.00,
            ],
            [
                'name' => 'Jambi Selatan',
                'latitude' => -1.632100,
                'longitude' => 103.639100,
                'fatberg_hotspots_rt' => ['RT 05 Pasir Putih', 'RT 14 Tambak Sari'],
                'fatberg_risk_level' => 'medium',
                'active_umkm_count' => 92,
                'total_oil_collected' => 2010.00,
            ],
            [
                'name' => 'Paal Merah',
                'latitude' => -1.648000,
                'longitude' => 103.655000,
                'fatberg_hotspots_rt' => ['RT 09 Eka Jaya', 'RT 15 Lingkar Selatan'],
                'fatberg_risk_level' => 'low',
                'active_umkm_count' => 64,
                'total_oil_collected' => 1250.00,
            ],
            [
                'name' => 'Kota Baru',
                'latitude' => -1.638500,
                'longitude' => 103.586300,
                'fatberg_hotspots_rt' => ['RT 08 Paal Lima', 'RT 12 Kenali Asam Bawah'],
                'fatberg_risk_level' => 'medium',
                'active_umkm_count' => 88,
                'total_oil_collected' => 1760.00,
            ],
            [
                'name' => 'Alam Barajo',
                'latitude' => -1.621000,
                'longitude' => 103.558000,
                'fatberg_hotspots_rt' => ['RT 04 Beliung', 'RT 10 Rawasari'],
                'fatberg_risk_level' => 'low',
                'active_umkm_count' => 52,
                'total_oil_collected' => 980.00,
            ],
            [
                'name' => 'Danau Teluk',
                'latitude' => -1.572000,
                'longitude' => 103.602000,
                'fatberg_hotspots_rt' => ['RT 03 Olak Kemang'],
                'fatberg_risk_level' => 'low',
                'active_umkm_count' => 24,
                'total_oil_collected' => 450.00,
            ],
            [
                'name' => 'Pelayangan',
                'latitude' => -1.575000,
                'longitude' => 103.621000,
                'fatberg_hotspots_rt' => ['RT 02 Tahtul Yaman'],
                'fatberg_risk_level' => 'low',
                'active_umkm_count' => 18,
                'total_oil_collected' => 310.00,
            ],
        ];

        foreach ($subdistrictsData as $subdistrict) {
            Subdistrict::updateOrCreate(['name' => $subdistrict['name']], $subdistrict);
        }

        $jelutung = Subdistrict::where('name', 'Jelutung')->first();

        // 2. Seed Master Harga Limbah
        WastePrice::updateOrCreate(
            ['waste_type' => 'minyak_jelantah', 'is_active' => true],
            [
                'price_per_unit' => 7500.00,
                'unit' => 'Liter',
                'effective_date' => Carbon::now()->startOfMonth(),
            ]
        );

        WastePrice::updateOrCreate(
            ['waste_type' => 'kardus', 'is_active' => true],
            [
                'price_per_unit' => 1500.00,
                'unit' => 'Kg',
                'effective_date' => Carbon::now()->startOfMonth(),
            ]
        );

        // 3. Seed Users
        // UMKM: Wisnu Nugroho (sesuai Mockup Figma)
        $umkmUser = User::updateOrCreate(
            ['phone_number' => '081234567890'],
            [
                'name' => 'Wisnu Nugroho',
                'email' => 'wisnu@padangpayakumbuh.com',
                'password' => Hash::make('password123'),
                'role' => 'umkm',
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // Profil Warung Wisnu
        $warungWisnu = WarungProfile::updateOrCreate(
            ['user_id' => $umkmUser->id],
            [
                'subdistrict_id' => $jelutung->id,
                'business_name' => 'Rumah Makan Padang Payakumbuh',
                'owner_name' => 'Wisnu Nugroho',
                'address' => 'Jl. Hayam Wuruk No. 45, Jelutung, Kota Jambi',
                'latitude' => -1.614320,
                'longitude' => 103.606250,
                'daily_oil_usage' => 15.00,
                'business_photo_path' => '/images/mockups/halaman_dashboard.png',
                'is_active' => true,
            ]
        );

        // Dompet Wisnu: Saldo Rp 1.376.000,00 (identik mockup)
        Wallet::updateOrCreate(
            ['user_id' => $umkmUser->id],
            [
                'balance' => 1376000.00,
                'bank_name' => 'Bank BRI',
                'bank_account_number' => '5432-01-002938-50-1',
                'bank_account_holder' => 'Wisnu Nugroho',
            ]
        );

        // Poin Wisnu: 380 Poin (identik mockup)
        RewardPoint::updateOrCreate(
            ['user_id' => $umkmUser->id],
            ['total_points' => 380]
        );

        // Sertifikat QR Warung Sehat Wisnu (Masa aktif 30 hari)
        QrCertificate::updateOrCreate(
            ['warung_profile_id' => $warungWisnu->id],
            [
                'certificate_code' => 'WS-JMB-2026-0042',
                'qr_hash' => Str::random(32),
                'issued_at' => Carbon::now()->subDays(5),
                'expires_at' => Carbon::now()->addDays(25),
                'status' => 'active',
                'total_liters_saved' => 184.00,
                'last_dinkes_inspected_at' => Carbon::now()->subDays(15),
            ]
        );

        // Kurir: Budi Santoso
        $courierUser = User::updateOrCreate(
            ['phone_number' => '081298765432'],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.courier@siklusjambi.com',
                'password' => Hash::make('password123'),
                'role' => 'courier',
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // Admin Pemkot Jambi
        User::updateOrCreate(
            ['email' => 'admin@jambikota.go.id'],
            [
                'name' => 'Admin Pemkot Jambi (PUPR/DLH)',
                'phone_number' => '081100000001',
                'password' => Hash::make('password123'),
                'role' => 'admin_pemkot',
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // Dinkes Kota Jambi
        User::updateOrCreate(
            ['email' => 'dinkes@jambikota.go.id'],
            [
                'name' => 'Pengawas Dinkes Kota Jambi',
                'phone_number' => '081100000002',
                'password' => Hash::make('password123'),
                'role' => 'dinkes',
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // KLH
        User::updateOrCreate(
            ['email' => 'klh@menlhk.go.id'],
            [
                'name' => 'Auditor Emisi KLH',
                'phone_number' => '081100000003',
                'password' => Hash::make('password123'),
                'role' => 'klh',
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // PT Pertamina SAF
        User::updateOrCreate(
            ['email' => 'pertamina.saf@pertamina.com'],
            [
                'name' => 'Depot Pertamina SAF Kota Jambi',
                'phone_number' => '081100000004',
                'password' => Hash::make('password123'),
                'role' => 'pertamina',
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // 4. Seed Dummy Pickup Orders (sesuai mockup Tab 2 Jadwal Jemputan)
        // Order 1: Sedang dalam penjemputan (Orange badge)
        $order1 = PickupOrder::updateOrCreate(
            ['order_number' => 'ORD-20261025-0001'],
            [
                'warung_profile_id' => $warungWisnu->id,
                'courier_id' => $courierUser->id,
                'waste_type' => 'Minyak Jelantah dan Kardus',
                'estimated_volume' => 12.00,
                'actual_volume' => null,
                'unit_price' => 7500.00,
                'total_price' => 90000.00,
                'points_earned' => 12,
                'status' => 'in_progress',
                'notes' => 'Tolong jemput sebelum jam 11 siang',
                'created_at' => Carbon::create(2026, 10, 25, 8, 54, 0),
            ]
        );

        // Order 2, 3, 4: Selesai (Green badge)
        for ($i = 2; $i <= 4; $i++) {
            $compOrder = PickupOrder::updateOrCreate(
                ['order_number' => "ORD-2026102{$i}-000{$i}"],
                [
                    'warung_profile_id' => $warungWisnu->id,
                    'courier_id' => $courierUser->id,
                    'waste_type' => 'Minyak Jelantah dan Kardus',
                    'estimated_volume' => 12.00,
                    'actual_volume' => 12.00,
                    'unit_price' => 7500.00,
                    'total_price' => 90000.00,
                    'points_earned' => 12,
                    'status' => 'completed',
                    'created_at' => Carbon::create(2026, 10, 20 + $i, 8, 54, 0),
                ]
            );

            QualityInspection::updateOrCreate(
                ['pickup_order_id' => $compOrder->id],
                [
                    'courier_id' => $courierUser->id,
                    'is_water_free' => true,
                    'is_sediment_free' => true,
                    'is_pure_uco' => true,
                    'is_passed' => true,
                    'proof_photo_path' => '/images/mockups/halaman_dashboard.png',
                    'inspected_at' => Carbon::create(2026, 10, 20 + $i, 9, 30, 0),
                ]
            );
        }

        // 5. Seed Reward Catalogs
        $catalogs = [
            [
                'title' => 'Minyak Goreng Baru Kemasan 1L',
                'description' => 'Minyak goreng kelapa sawit premium higienis SNI',
                'points_required' => 50,
                'stock' => 100,
            ],
            [
                'title' => 'Kaos Eksklusif SiklusJambi',
                'description' => 'Kaos katun combed 30s ramah lingkungan berlogo Lacak Jambi',
                'points_required' => 100,
                'stock' => 50,
            ],
            [
                'title' => 'Token Listrik PLN Rp50.000',
                'description' => 'Voucher pulsa listrik prabayar untuk warung makan',
                'points_required' => 150,
                'stock' => 200,
            ],
            [
                'title' => 'Paket Sembako Berkah UMKM',
                'description' => 'Beras 5kg + Gula 1kg + Teh untuk kebutuhan dapur',
                'points_required' => 250,
                'stock' => 30,
            ],
        ];

        foreach ($catalogs as $cat) {
            RewardCatalog::updateOrCreate(['title' => $cat['title']], $cat);
        }

        // 6. Seed Environmental Impact Log
        EnvironmentalImpactLog::updateOrCreate(
            ['subdistrict_id' => $jelutung->id, 'log_date' => Carbon::today()],
            [
                'total_oil_liters' => 18450.00,
                'clean_water_saved_liters' => 18450000.00, // 18,45 Juta Liter air Sungai Batanghari
                'co2e_reduced_kg' => 39800.00,            // 39,8 Ton CO2e
                'saf_produced_liters' => 14760.00,         // Konversi Bioavtur SAF
            ]
        );

        // 7. Seed Initial Manifest (MNF-SAF-04)
        \App\Models\Manifest::updateOrCreate(
            ['manifest_code' => 'MNF-SAF-04'],
            [
                'courier_id' => $courierUser->id,
                'total_volume_liters' => 215.5,
                'total_warung_count' => 12,
                'iscc_traceability_hash' => 'ISCC-JMB-2026-X892J',
                'status' => 'delivered_depot',
                'delivered_at' => Carbon::today()->subHours(2),
            ]
        );
    }
}
