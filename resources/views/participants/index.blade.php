@extends('layouts.app')

@section('title', 'Liste des Participants')

@section('content')

    @if (session('room_id'))
        <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
            <form action="{{ route('rooms.update', session('room_id')) }}" method="POST"
                  class="flex flex-col space-y-4">
                @csrf
                @method('PUT')

                <label for="new_name" class="block text-lg font-semibold text-gray-700">Renommer la Room :</label>

                <div class="flex items-center space-x-3">
                    <input type="text" name="new_name" value="{{ session('room_name') }}" required
                           class="p-2 border border-gray-300 rounded-lg flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition cursor-pointer">
                        💾 Sauver
                    </button>
                </div>
            </form>
        </div>
    @endif

    @include('participants.form')

    <ul class="bg-gray-50 p-4 rounded-lg shadow">
        @foreach ($participants as $participant)
            @include('participants.item', ['participant' => $participant])
        @endforeach
    </ul>

    <!-- Bouton pour lancer le tirage -->
    <form action="/draw" method="POST" class="mt-6 text-center">
        @csrf
        <button type="submit"
                class="bg-green-500 text-white px-6 py-3 cursor-pointer rounded-lg text-lg hover:bg-green-600">
            🎲 Lancer le tirage
        </button>
    </form>

@endsection
