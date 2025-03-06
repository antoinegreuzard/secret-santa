@extends('layouts.app')

@section('title', 'Choisir une Room')

@section('content')
    <h2 class="text-xl font-bold text-center mb-4">Choisir ou créer une Room</h2>

    @if (session('room_id'))
        <form action="{{ route('rooms.update', session('room_id')) }}" method="POST"
              class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
            @csrf
            @method('PUT')
            <label for="new_name" class="block text-lg font-bold mb-2">Renommer la Room :</label>
            <div class="flex">
                <input type="text" name="new_name" value="{{ session('room_name') }}" required
                       class="p-2 border rounded-lg flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 ml-2">
                    💾 Sauver
                </button>
            </div>
        </form>
    @endif

    <form action="/rooms" method="POST" class="mb-6">
        @csrf
        <input type="text" name="name" placeholder="Nom de la Room" required class="p-2 border rounded-lg">
        <input type="password" name="password" placeholder="Mot de passe" required class="p-2 border rounded-lg">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Créer</button>
    </form>

    <ul class="bg-gray-50 p-4 rounded-lg shadow">
        @foreach ($rooms as $room)
            <li class="flex justify-between items-center py-2 border-b">
                <span>{{ $room->name }}</span>
                <form action="/rooms/{{ $room->id }}/join" method="POST" class="flex">
                    @csrf
                    <input type="password" name="password" placeholder="Mot de passe" required
                           class="p-2 border rounded-lg">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                        Rejoindre
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
