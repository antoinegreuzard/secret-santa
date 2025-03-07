<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController
{
    public function index()
    {
        $room_id = session('room_id');
        if (!$room_id) {
            return redirect()->route('rooms.index')->with('error', 'Sélectionnez une room.');
        }

        $participants = Participant::where('room_id', $room_id)->get();
        return view('participants.index', compact('participants'));
    }

    public function store(Request $request)
    {
        $request->merge(['room_id' => session('room_id')]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'room_id' => 'required|exists:rooms,id'
        ]);

        Participant::create($validated);

        return back()->with('success', 'Participant ajouté avec succès !');
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,'.$participant->id,
        ]);

        $participant->update($request->all());

        return back()->with('success', "Participant $participant->name mis à jour avec succès !");
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return back()->with('success', "Participant $participant->name supprimé avec succès !");
    }
}
