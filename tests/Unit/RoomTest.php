<?php

namespace Tests\Unit;

use App\Models\Participant;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class RoomTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_a_room_can_have_participants()
    {
        $room = Room::factory()->create();

        $participant = Participant::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'room_id' => $room->id
        ]);

        $this->assertTrue($room->participants->contains($participant));
        $this->assertEquals(1, $room->participants()->count());
    }
}
