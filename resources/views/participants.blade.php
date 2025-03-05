<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Santa Express</title>
</head>
<body>
<h1>Participants</h1>

<form action="/participants" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Ajouter</button>
</form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<ul>
    @foreach ($participants as $participant)
        <li>{{ $participant->name }} ({{ $participant->email }})</li>
    @endforeach
</ul>

<form action="/draw" method="POST">
    @csrf
    <button type="submit">Lancer le tirage</button>
</form>
</body>
</html>
