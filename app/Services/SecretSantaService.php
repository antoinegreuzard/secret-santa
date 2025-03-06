<?php

namespace App\Services;

use Illuminate\Support\Collection;

class SecretSantaService
{
    public function draw(Collection $participants): array
    {
        $shuffled = $participants->shuffle();
        $assignments = [];

        for ($i = 0; $i < count($shuffled); $i++) {
            $assignments[$shuffled[$i]->email] = $shuffled[($i + 1) % count($shuffled)]->name;
        }

        return $assignments;
    }
}
