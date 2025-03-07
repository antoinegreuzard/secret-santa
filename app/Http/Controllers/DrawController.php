<?php

namespace App\Http\Controllers;

use App\Mail\SecretSantaMail;
use App\Models\Participant;
use App\Services\SecretSantaService;
use Illuminate\Support\Facades\Mail;

class DrawController
{
    public function drawNames()
    {
        $room_id = session('room_id');
        if (!$room_id) {
            return redirect()->route('rooms.index')->with('error', 'Sélectionnez une room.');
        }

        $participants = Participant::where('room_id', $room_id)->get();

        if ($participants->count() < 2) {
            return redirect()->back()->with('error', 'Il faut au moins 2 participants pour faire un tirage.');
        }

        $service = new SecretSantaService();
        $assignments = $service->draw($participants);

        foreach ($assignments as $from => $to) {
            Mail::to($from)->send(new SecretSantaMail($to));
        }

        return redirect()->back()->with('success', 'Tirage effectué et emails envoyés !');
    }
}
