<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - SaveSmart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Sniglet&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Sniglet', cursive;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen">

    <div class="flex flex-col h-full">

        <!-- Barre de Navigation -->
        <nav class="bg-white shadow py-4">
            <div class="container mx-auto px-4 flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-2xl font-semibold text-purple-700"
                    style="font-family: 'Sniglet', cursive;">SaveSmart</a>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-700" style="font-family: 'Sniglet', cursive;">Bonjour,
                        {{ Auth::user()->name }}
                        @if(isset($familyProfile))
                            (Profil: {{ $familyProfile->first_name }} {{ $familyProfile->last_name }})
                        @endif
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            style="font-family: 'Sniglet', cursive;">Déconnexion</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Contenu Principal -->
        <main class="container mx-auto mt-8 px-4 flex-grow">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800" style="font-family: 'Sniglet', cursive;">Tableau
                    de Bord</h2>
                <p class="text-gray-700" style="font-family: 'Sniglet', cursive;">Bienvenue sur votre tableau de bord
                    SaveSmart. Ici, vous
                    pourrez
                    gérer vos finances personnelles et familiales.</p>

                <!-- Ajoutez ici d'autres éléments de votre tableau de bord (résumés, graphiques, etc.) -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2 text-green-600" style="font-family: 'Sniglet', cursive;">
                        Actions Rapides</h3>
                    <ul class="list-disc list-inside text-gray-700" style="font-family: 'Sniglet', cursive;">
                        <li><a href="{{ route('transactions.create') }}"
                                class="text-purple-500 hover:text-purple-700">Ajouter une transaction</a></li>
                        <li><a href="{{ route('categories.index') }}"
                                class="text-purple-500 hover:text-purple-700">Gérer les catégories</a></li>
                        <li><a href="{{ route('family_profiles.index') }}"
                                class="text-purple-500 hover:text-purple-700">Gérer les profils familiaux</a></li>
                        <li><a href="{{ route('transactions.index') }}"
                                class="text-purple-500 hover:text-purple-700">Voir toutes les transactions</a></li>
                    </ul>
                </div>
            </div>
        </main>

        <!-- Footer (facultatif) -->
        <footer class="bg-gray-200 py-4 mt-8">
            <div class="container mx-auto px-4 text-center text-gray-600" style="font-family: 'Sniglet', cursive;">
                © {{ date('Y') }} SaveSmart - Tous droits réservés
            </div>
        </footer>

    </div>

</body>

</html>