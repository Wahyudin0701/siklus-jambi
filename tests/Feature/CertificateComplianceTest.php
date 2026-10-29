<?php

namespace Tests\Feature;

use App\Models\QrCertificate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificateComplianceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_certificate_shows_validity_days_and_active_status()
    {
        $cert = QrCertificate::first();
        $this->assertFalse($cert->isExpired());
        $this->assertGreaterThan(0, $cert->days_remaining);
    }

    public function test_public_qr_verification_page_renders_safe_public_data()
    {
        $cert = QrCertificate::first();

        $response = $this->get(route('public.qr', $cert->qr_hash));

        $response->assertStatus(200);
        $response->assertSeeText($cert->warungProfile->business_name);
        $response->assertSeeText($cert->certificate_code);
        $response->assertSeeText('Terverifikasi Aktif');

        // Ensure private financial data is NOT exposed
        $response->assertDontSeeText('5432-01-002938-50-1'); // bank account number
        $response->assertDontSeeText('Rp1.376.000'); // wallet balance
    }

    public function test_expired_certificate_displays_warning()
    {
        $cert = QrCertificate::first();
        // Force expire the certificate
        $cert->update([
            'expires_at' => Carbon::now()->subDays(2),
            'status' => 'expired',
        ]);

        $this->assertTrue($cert->isExpired());

        $response = $this->get(route('public.qr', $cert->qr_hash));
        $response->assertStatus(200);
        $response->assertSeeText('Sertifikat Kedaluwarsa');
    }
}
