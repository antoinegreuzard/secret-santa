<?php

namespace Tests\Unit;

use App\Models\Participant;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class ParticipantTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_a_participant_belongs_to_a_room()
    {
        $room = Room::factory()->create();

        $participant = Participant::factory()->create(['room_id' => $room->id]);
        
        $this->assertEquals($participant->room->id, $room->id);
        $this->assertInstanceOf(Room::class, $participant->room);
    }
}
