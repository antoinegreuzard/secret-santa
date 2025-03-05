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
