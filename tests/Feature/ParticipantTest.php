<?php

namespace Tests\Feature;

use App\Models\Participant;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class ParticipantTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_participants_can_be_created()
    {
        $room = Room::factory()->create();

        $response = $this->post('/participants', [
            'name' => 'Charlie',
            'email' => 'charlie@example.com',
            'room_id' => $room->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('participants', [
            'email' => 'charlie@example.com',
            'room_id' => $room->id
        ]);
    }

    public function test_participants_can_be_updated()
    {
        $participant = Participant::factory()->create();

        $response = $this->put("/participants/{$participant->id}", [
            'name' => 'Updated Name',
            'email' => $participant->email
        ]);

        $response->assertSessionHas('success', "Participant Updated Name mis à jour avec succès !");
        $this->assertDatabaseHas('participants', ['name' => 'Updated Name']);
    }

    public function test_participants_can_be_deleted()
    {
        $participant = Participant::factory()->create();

        $response = $this->delete("/participants/{$participant->id}");

        $response->assertSessionHas('success', "Participant {$participant->name} supprimé avec succès !");
        $this->assertDatabaseMissing('participants', ['id' => $participant->id]);
    }
}
