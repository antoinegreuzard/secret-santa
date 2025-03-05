<?php

namespace App\Http\Controllers;

use App\Mail\SecretSantaMail;
use App\Models\Participant;
use Illuminate\Support\Facades\Mail;

class DrawController
{
    public function drawNames()
    {
        $participants = Participant::all()->shuffle();

        if ($participants->count() < 2) {
            return back()->with('error', 'Il faut au moins 2 participants pour faire un tirage.');
        }

        $assignments = [];
        for ($i = 0; $i < count($participants); $i++) {
            $assignments[$participants[$i]->email] = $participants[($i + 1) % count($participants)]->name;
        }

        foreach ($assignments as $from => $to) {
            Mail::to($from)->send(new SecretSantaMail($to));
        }
        
        return back()->with('success', 'Tirage effectué et emails envoyés !');
    }
}
