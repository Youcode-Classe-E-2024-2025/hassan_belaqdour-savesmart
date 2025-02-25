<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-semibold mb-4">Bienvenue sur votre tableau de bord, {{ Auth::user()->name }}!</h1>
        <p>Ceci est un exemple de tableau de bord. Vous pouvez ajouter ici des widgets, des statistiques, etc.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Déconnexion
            </button>
        </form>
    </div>
</body>

</html>