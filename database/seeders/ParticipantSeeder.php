<?php

namespace Database\Seeders;

use App\Models\Participant;
use App\Models\Room;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Room::count() === 0) {
            Room::factory()->count(5)->create();
        }

        Participant::factory()->count(10)->create([
            'room_id' => Room::inRandomOrder()->first()->id,
        ]);
    }
}
