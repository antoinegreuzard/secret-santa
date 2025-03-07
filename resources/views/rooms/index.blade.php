@extends('layouts.app')

@section('title', 'Choisir une Room')

@section('content')
    <h2 class="text-xl font-bold text-center mb-4">Choisir ou créer une Room</h2>

    <form action="/rooms" method="POST" class="mb-6">
        @csrf
        <input type="text" name="name" placeholder="Nom de la Room" required
               class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <input type="password" name="password" placeholder="Mot de passe" required
               class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
        @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 cursor-pointer">
            Créer
        </button>
    </form>

    <ul class="bg-gray-50 p-4 rounded-lg shadow">
        @foreach ($rooms as $room)
            <li class="flex justify-between items-center py-2 border-b">
                <span>{{ $room->name }}</span>
                <form action="/rooms/{{ $room->id }}/join" method="POST" class="flex">
                    @csrf
                    <input type="password" name="password" placeholder="Mot de passe" required
                           class="p-2 border rounded-lg">
                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 cursor-pointer">
                        Rejoindre
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
