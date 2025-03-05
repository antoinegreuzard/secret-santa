<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController
{
    public function index()
    {
        $participants = Participant::all();
        return view('participants', compact('participants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
        ]);

        Participant::create($request->all());

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
