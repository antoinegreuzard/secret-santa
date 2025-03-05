<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Santa Express</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">

<div class="bg-white shadow-md rounded-lg p-6 w-full max-w-3xl">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">🎁 Secret Santa Express 🎁</h1>

    <!-- Formulaire d'ajout -->
    <form action="/participants" method="POST" class="mb-4">
        @csrf
        <div class="flex space-x-2">
            <input type="text" name="name" placeholder="Nom" required
                   class="w-1/2 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="email" name="email" placeholder="Email" required
                   class="w-1/2 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Ajouter
            </button>
        </div>
    </form>

    <!-- Messages de succès / erreur -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded-lg mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded-lg mb-4">{{ session('error') }}</div>
    @endif

    <ul class="bg-gray-50 p-4 rounded-lg shadow">
        @foreach ($participants as $participant)
            <li class="flex justify-between items-center py-2 border-b last:border-0">
                <!-- Formulaire d'édition inline -->
                <form action="/participants/{{ $participant->id }}" method="POST"
                      class="flex-grow flex items-center space-x-2 edit-form hidden">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $participant->name }}" required
                           class="w-1/3 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="email" name="email" value="{{ $participant->email }}" required
                           class="w-1/3 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 cursor-pointer">💾
                        Sauver
                    </button>
                    <button type="button" class="cancel-edit text-gray-500 hover:underline cursor-pointer">❌ Annuler
                    </button>
                </form>

                <!-- Affichage normal -->
                <div class="participant-view flex justify-between items-center w-full">
                    <span>{{ $participant->name }} ({{ $participant->email }})</span>
                    <div class="space-x-2">
                        <button type="button" class="edit-btn text-blue-500 hover:underline cursor-pointer">✏️
                            Modifier
                        </button>
                        <form action="/participants/{{ $participant->id }}" method="POST" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline cursor-pointer">❌ Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </li>
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
</div>

<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            let listItem = this.closest('li');
            listItem.querySelector('.participant-view').classList.add('hidden');
            listItem.querySelector('.edit-form').classList.remove('hidden');
        });
    });

    document.querySelectorAll('.cancel-edit').forEach(button => {
        button.addEventListener('click', function () {
            let listItem = this.closest('li');
            listItem.querySelector('.edit-form').classList.add('hidden');
            listItem.querySelector('.participant-view').classList.remove('hidden');
        });
    });

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!confirm("Êtes-vous sûr de vouloir supprimer ce participant ?")) {
                e.preventDefault();
            }
        });
    });
</script>

</body>
</html>
