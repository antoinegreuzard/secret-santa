<?php

namespace App\Http\Controllers;

use App\Mail\SecretSantaMail;
use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class DrawController
{
    public function drawNames(): RedirectResponse
    {
        $room_id = session('room_id');
        if (!$room_id) {
            return redirect()->route('rooms.index')->with('error', 'Sélectionnez une room.');
        }

        $participants = Participant::where('room_id', $room_id)->get()->shuffle();

        if ($participants->count() < 2) {
            return redirect()->back()->with('error', 'Il faut au moins 2 participants pour faire un tirage.');
        }

        $assignments = [];
        for ($i = 0; $i < count($participants); $i++) {
            $assignments[$participants[$i]->email] = $participants[($i + 1) % count($participants)]->name;
        }

        foreach ($assignments as $from => $to) {
            Mail::to($from)->send(new SecretSantaMail($to));
        }

        return redirect()->back()->with('success', 'Tirage effectué et emails envoyés !');
    }
}
