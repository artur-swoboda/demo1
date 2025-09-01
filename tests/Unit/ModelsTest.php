<?php

namespace Tests\Unit;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_reservation_relations_work()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();
        $slot = Slot::factory()->create();

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'slot_id' => $slot->id,
            'status' => 'pending',
        ]);

        $this->assertEquals($service->id, $reservation->service->id);
        $this->assertEquals($slot->id, $reservation->slot->id);
        $this->assertEquals($user->id, $reservation->user->id);
    }
}
