<?php

namespace Tests\Feature;

use App\Models\PickupOrder;
use App\Models\User;
use App\Models\WarungProfile;
use App\Models\WastePrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PickupOrderBusinessRulesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_pickup_order_requires_minimum_10_liters()
    {
        $user = User::where('role', 'umkm')->first();
        $this->actingAs($user);

        // Try submitting less than 10 liters (e.g. 7 liters)
        $response = $this->post(route('mobile.pickup.store'), [
            'estimated_volume' => 7,
            'waste_type' => 'Minyak Jelantah',
        ]);

        $response->assertSessionHasErrors('estimated_volume');
        $this->assertDatabaseMissing('pickup_orders', [
            'estimated_volume' => 7,
        ]);
    }

    public function test_pickup_order_accepted_when_volume_is_at_least_10_liters()
    {
        $user = User::where('role', 'umkm')->first();
        $this->actingAs($user);

        // Submit 15 liters
        $response = $this->post(route('mobile.pickup.store'), [
            'estimated_volume' => 15,
            'waste_type' => 'Minyak Jelantah',
            'notes' => 'Tolong jemput pagi',
        ]);

        $response->assertRedirect(route('mobile.schedule'));
        $this->assertDatabaseHas('pickup_orders', [
            'estimated_volume' => 15,
            'points_earned' => 15, // 1 Liter = 1 Poin
            'status' => 'in_progress',
        ]);
    }

    public function test_courier_saf_inspection_accepts_order_and_credits_wallet_instantly()
    {
        $courier = User::where('role', 'courier')->first();
        $order = PickupOrder::where('status', 'in_progress')->first();
        $initialBalance = $order->warungProfile->user->wallet->balance;

        $response = $this->actingAs($courier)->post(route('courier.inspect.post', $order->id), [
            'action' => 'accept',
            'actual_volume' => 12.0,
            'is_water_free' => '1',
            'is_sediment_free' => '1',
            'is_pure_uco' => '1',
        ]);

        $response->assertRedirect(route('courier.dashboard'));

        // Verify order is completed
        $this->assertDatabaseHas('pickup_orders', [
            'id' => $order->id,
            'status' => 'completed',
            'actual_volume' => 12.0,
        ]);

        // Verify wallet increased by 12 * 7500 = Rp 90.000
        $expectedBalance = $initialBalance + (12 * 7500);
        $this->assertEquals($expectedBalance, $order->warungProfile->user->fresh()->wallet->balance);

        // Verify inspection logged
        $this->assertDatabaseHas('quality_inspections', [
            'pickup_order_id' => $order->id,
            'is_passed' => true,
        ]);
    }

    public function test_courier_saf_inspection_rejection_flow()
    {
        $courier = User::where('role', 'courier')->first();
        $order = PickupOrder::where('status', 'in_progress')->first();

        $response = $this->actingAs($courier)->post(route('courier.inspect.post', $order->id), [
            'action' => 'reject',
            'rejection_reason' => 'Mengandung campuran air dan endapan hitam tebal',
        ]);

        $response->assertRedirect(route('courier.dashboard'));

        // Verify order is marked as rejected_qc
        $this->assertDatabaseHas('pickup_orders', [
            'id' => $order->id,
            'status' => 'rejected_qc',
        ]);

        // Verify quality inspection logged as failed
        $this->assertDatabaseHas('quality_inspections', [
            'pickup_order_id' => $order->id,
            'is_passed' => false,
        ]);
    }
}
