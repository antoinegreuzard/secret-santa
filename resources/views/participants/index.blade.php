@extends('layouts.app')

@section('title', 'Liste des Participants')

@section('content')

    @include('participants.form')

    <!-- Messages de succès / erreur -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded-lg mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded-lg mb-4">{{ session('error') }}</div>
    @endif

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
