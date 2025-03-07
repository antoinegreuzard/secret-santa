<?php

namespace Tests\Unit;

use App\Models\Participant;
use App\Services\SecretSantaService;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class DrawTest extends BaseTestCase
{
    public function test_secret_santa_draw_works()
    {
        $participants = collect([
            new Participant(['name' => 'Alice', 'email' => 'alice@example.com']),
            new Participant(['name' => 'Bob', 'email' => 'bob@example.com']),
            new Participant(['name' => 'Charlie', 'email' => 'charlie@example.com']),
        ]);

        $service = new SecretSantaService();
        $assignments = $service->draw($participants);

        $this->assertCount($participants->count(), $assignments);
        foreach ($assignments as $giver => $receiver) {
            $this->assertNotEquals($giver, $receiver, "Un participant ne peut pas se tirer lui-même.");
        }
    }
}
