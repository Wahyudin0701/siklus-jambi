<?php

namespace Tests\Feature;

use App\Models\Subdistrict;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MobileAuthAndStakeholderDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_mobile_login_page_renders_with_mockup_components()
    {
        $response = $this->get(route('mobile.login'));
        $response->assertStatus(200);
        $response->assertSeeText('Selamat Datang di SiklusJambi');
        $response->assertSeeText('Masuk Akun');
        $response->assertSeeText('Nomor Whatsapp :');
    }

    public function test_mobile_login_success()
    {
        $response = $this->post(route('mobile.login.post'), [
            'phone_number' => '081234567890',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('mobile.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_mobile_dashboard_shows_wisnu_and_balance()
    {
        $user = User::where('phone_number', '081234567890')->first();

        $response = $this->actingAs($user)->get(route('mobile.dashboard'));

        $response->assertStatus(200);
        $response->assertSeeText('Halo, Wisnu Nugroho !');
        $response->assertSeeText('Rumah Makan Padang Payakumbuh');
        $response->assertSeeText('Rp1.376.000,00');
        $response->assertSeeText('380'); // Poin
        $response->assertSeeText('Jemput Limbah Saya');
    }

    public function test_multi_stakeholder_dashboard_loads_for_all_roles()
    {
        // 1. Pemkot
        $resPemkot = $this->get(route('stakeholder.dashboard', ['role' => 'pemkot']));
        $resPemkot->assertStatus(200);
        $resPemkot->assertSee('Panel Pemkot Jambi');
        $resPemkot->assertSee('18.450');

        // 2. Dinkes
        $resDinkes = $this->get(route('stakeholder.dashboard', ['role' => 'dinkes']));
        $resDinkes->assertStatus(200);
        $resDinkes->assertSee('Panel Dinas Kesehatan');

        // 3. KLH
        $resKlh = $this->get(route('stakeholder.dashboard', ['role' => 'klh']));
        $resKlh->assertStatus(200);
        $resKlh->assertSee('Kementerian Lingkungan Hidup');
        $resKlh->assertSee('18,45 Juta Liter Air');

        // 4. Pertamina
        $resPertamina = $this->get(route('stakeholder.dashboard', ['role' => 'pertamina']));
        $resPertamina->assertStatus(200);
        $resPertamina->assertSee('PT Pertamina');
        $resPertamina->assertSee('MNF-SAF-04');
    }

    public function test_stakeholder_report_export_csv()
    {
        $response = $this->get(route('stakeholder.export'));
        $response->assertStatus(200);
        $this->assertTrue(str_contains($response->headers->get('content-disposition'), 'attachment; filename=Laporan_Resmi_SiklusJambi_'));
    }

    public function test_all_responsive_pages_render_and_contain_official_assets()
    {
        $user = User::where('phone_number', '081234567890')->first();

        // 0. Official Landing Page
        $this->get(route('landing'))
            ->assertStatus(200)
            ->assertSee('images/logo-official.jpg')
            ->assertSee('SiklusJambi')
            ->assertSee('Daftarkan Warung Anda')
            ->assertSee('Warung Sehat Kota Jambi');

        // 1. Loading and Login pages
        $this->get(route('mobile.loading'))
            ->assertStatus(200)
            ->assertSee('images/logo-official.jpg');

        $this->get(route('mobile.login'))
            ->assertStatus(200)
            ->assertSee('images/logo-official.jpg')
            ->assertSee('Selamat Datang di SiklusJambi')
            ->assertSee('Masuk Akun');

        // 2. Core authenticated views
        $this->actingAs($user)->get(route('mobile.schedule'))->assertStatus(200);
        $this->actingAs($user)->get(route('mobile.profile'))->assertStatus(200);
        $this->actingAs($user)->get(route('mobile.pickup.create'))->assertStatus(200);
        $this->actingAs($user)->get(route('mobile.certificate.view'))
            ->assertStatus(200)
            ->assertSee('images/logo-official.jpg');
        $this->actingAs($user)->get(route('mobile.profile.location'))->assertStatus(200);
        $this->actingAs($user)->get(route('mobile.rewards'))->assertStatus(200);
        $this->actingAs($user)->get(route('mobile.prices'))->assertStatus(200);
        $this->actingAs($user)->get(route('mobile.impact'))->assertStatus(200);
        $this->actingAs($user)->get(route('mobile.news'))->assertStatus(200);

        // 3. Courier views
        $this->get(route('courier.dashboard'))->assertStatus(200);
        $this->get(route('courier.manifest'))->assertStatus(200);

        // 4. Verify logo file physically exists in public
        $this->assertFileExists(public_path('images/logo-official.jpg'));
    }
}
