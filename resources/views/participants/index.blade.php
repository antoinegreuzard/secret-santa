@extends('layouts.app')

@section('title', 'Liste des Participants')

@section('content')

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
                class="bg-green-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-green-600">
            🎲 Lancer le tirage
        </button>
    </form>

@endsection
