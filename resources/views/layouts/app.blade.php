<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Secret Santa Express')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">

<div class="bg-white shadow-md rounded-lg p-6 w-full max-w-3xl">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">🎁 Secret Santa Express 🎁</h1>

    <!-- Messages de succès / erreur -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded-lg mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded-lg mb-4">{{ session('error') }}</div>
    @endif

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('room_id'))
        <div class="w-full max-w-3xl mb-4 flex justify-between items-center">
            <span class="text-lg font-bold text-gray-700">
                Room actuelle : {{ session('room_name') }}
            </span>
            <a href="{{ route('rooms.index') }}"
               class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                🔄 Changer de Room
            </a>
        </div>
    @endif

    @yield('content')
</div>

@vite('resources/js/app.js')
</body>
</html>
