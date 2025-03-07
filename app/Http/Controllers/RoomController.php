<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomController
{
    public function index()
    {
        return view('rooms.index', ['rooms' => Room::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:rooms,name',
            'password' => 'required|string|min:6',
        ]);

        Room::create([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Room créée avec succès !');
    }

    public function join(Request $request, Room $room)
    {
        $request->validate(['password' => 'required']);

        if (!Hash::check($request->password, $room->password)) {
            return back()->with('error', 'Mot de passe incorrect.');
        }

        session([
            'room_id' => $room->id,
            'room_name' => $room->name,
        ]);

        return redirect()->route('participants.index');
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'new_name' => 'required|string|unique:rooms,name,'.$room->id,
        ]);

        $room->update(['name' => $validated['new_name']]);

        session(['room_name' => $room->name]);

        return back()->with('success', 'Room renommée avec succès !');
    }
}
