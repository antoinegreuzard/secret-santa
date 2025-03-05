@extends('layouts.app')

@section('title', 'Tirage au Sort')

@section('content')

    <h2 class="text-xl font-bold text-center mb-4">Résultat du Tirage 🎲</h2>

    <ul class="bg-gray-50 p-4 rounded-lg shadow">
        @foreach ($results as $giver => $receiver)
            <li class="py-2 border-b last:border-0 text-center">
                🎁 {{ $giver }} offre un cadeau à 🎁 {{ $receiver }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('participants.index') }}"
       class="block text-center mt-6 bg-blue-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-600">
        🔙 Retour
    </a>

@endsection
