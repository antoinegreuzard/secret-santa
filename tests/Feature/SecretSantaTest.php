<?php

namespace Tests\Feature;

use App\Mail\SecretSantaMail;
use App\Models\Participant;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Mail;

class SecretSantaTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_draw_names_requires_at_least_two_participants()
    {
        $room = Room::factory()->create();

        $this->withSession(['room_id' => $room->id]);

        $response = $this->post('/draw');

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('error', 'Il faut au moins 2 participants pour faire un tirage.');
    }

    public function test_draw_names_assigns_participants_and_sends_emails()
    {
        Mail::fake();

        $room = Room::factory()->create();

        Participant::factory()->create(['name' => 'Alice', 'email' => 'alice@example.com', 'room_id' => $room->id]);
        Participant::factory()->create(['name' => 'Bob', 'email' => 'bob@example.com', 'room_id' => $room->id]);

        $this->withSession(['room_id' => $room->id]);

        $response = $this->post('/draw');

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', 'Tirage effectué et emails envoyés !');

        Mail::assertSent(SecretSantaMail::class, 2);
    }
}
