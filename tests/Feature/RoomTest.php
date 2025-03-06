<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

class RoomTest extends BaseTestCase
{
    use RefreshDatabase;

    public function test_rooms_can_be_created()
    {
        $response = $this->post('/rooms', [
            'name' => 'Christmas Room',
            'password' => 'secure123'
        ]);

        $response->assertSessionHas('success', 'Room créée avec succès !');
        $this->assertDatabaseHas('rooms', ['name' => 'Christmas Room']);
    }

    public function test_users_can_join_room_with_correct_password()
    {
        $room = Room::create([
            'name' => 'New Year Room',
            'password' => Hash::make('correctpassword')
        ]);

        $response = $this->post("/rooms/{$room->id}/join", [
            'password' => 'correctpassword'
        ]);

        $response->assertRedirect('/participants');
        $this->assertEquals(session('room_id'), $room->id);
        $this->assertEquals(session('room_name'), $room->name);
    }

    public function test_users_cannot_join_room_with_wrong_password()
    {
        $room = Room::create([
            'name' => 'Secret Room',
            'password' => Hash::make('securepass')
        ]);

        $response = $this->post("/rooms/{$room->id}/join", [
            'password' => 'wrongpassword'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Mot de passe incorrect.');
    }

    public function test_room_name_can_be_updated()
    {
        $room = Room::create([
            'name' => 'Old Name',
            'password' => Hash::make('securepass')
        ]);

        $response = $this->put("/rooms/{$room->id}", [
            'new_name' => 'New Name'
        ]);

        $response->assertSessionHas('success', 'Room renommée avec succès !');
        $this->assertDatabaseHas('rooms', ['name' => 'New Name']);
    }
}
