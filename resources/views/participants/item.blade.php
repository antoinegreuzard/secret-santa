<li class="flex justify-between items-center py-2 border-b last:border-0">
    <!-- Formulaire d'édition inline -->
    <form action="/participants/{{ $participant->id }}" method="POST"
          class="flex-grow flex items-center space-x-2 edit-form hidden">
        @csrf
        @method('PUT')

        <div class="w-1/3">
            <input type="text" name="name" value="{{ $participant->name }}" required
                   class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-1/3">
            <input type="email" name="email" value="{{ $participant->email }}" required
                   class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 cursor-pointer">
            💾 Sauver
        </button>
        <button type="button" class="cancel-edit text-gray-500 cursor-pointer">
            ❌ Annuler
        </button>
    </form>

    <!-- Affichage normal -->
    <div class="participant-view flex justify-between items-center w-full">
        <span>{{ $participant->name }} ({{ $participant->email }})</span>
        <div class="space-x-2">
            <button type="button" class="edit-btn text-blue-500 cursor-pointer">✏️ Modifier</button>
            <form action="/participants/{{ $participant->id }}" method="POST" class="inline delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 cursor-pointer">
                    ❌ Supprimer
                </button>
            </form>
        </div>
    </div>
</li>
