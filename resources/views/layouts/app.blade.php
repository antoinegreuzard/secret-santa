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

    @yield('content')
</div>

@vite('resources/js/app.js')
</body>
</html>
