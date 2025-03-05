<?php

namespace Tests;

use App\Mail\SecretSantaMail;
use App\Models\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Mail;

class SecretSantaTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_draw_names_requires_at_least_two_participants()
    {
        $response = $this->post('/draw');

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('error', 'Il faut au moins 2 participants pour faire un tirage.');
    }

    public function test_draw_names_assigns_participants_and_sends_emails()
    {
        Mail::fake();

        Participant::factory()->create(['name' => 'Alice', 'email' => 'alice@example.com']);
        Participant::factory()->create(['name' => 'Bob', 'email' => 'bob@example.com']);

        $response = $this->post('/draw');

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', 'Tirage effectué et emails envoyés !');

        Mail::assertSent(SecretSantaMail::class, 2);
    }

    public function test_participants_can_be_created()
    {
        $response = $this->post('/participants', [
            'name' => 'Charlie',
            'email' => 'charlie@example.com'
        ]);

        $response->assertSessionHas('success', 'Participant ajouté avec succès !');
        $this->assertDatabaseHas('participants', ['email' => 'charlie@example.com']);
    }

    public function test_participants_can_be_updated()
    {
        $participant = Participant::factory()->create();

        $response = $this->put("/participants/$participant->id", [
            'name' => 'Updated Name',
            'email' => $participant->email
        ]);

        $response->assertSessionHas('success', "Participant Updated Name mis à jour avec succès !");
        $this->assertDatabaseHas('participants', ['name' => 'Updated Name']);
    }

    public function test_participants_can_be_deleted()
    {
        $participant = Participant::factory()->create();

        $response = $this->delete("/participants/$participant->id");

        $response->assertSessionHas('success', "Participant $participant->name supprimé avec succès !");
        $this->assertDatabaseMissing('participants', ['id' => $participant->id]);
    }
}
