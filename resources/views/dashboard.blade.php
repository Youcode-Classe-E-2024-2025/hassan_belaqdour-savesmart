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

<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="bg-purple-700 text-white w-64 py-4 px-3 flex-shrink-0">
        <div class="mb-8">
            <a href="{{ route('home') }}" class="text-2xl font-semibold block mb-2"
                style="font-family: 'Sniglet', cursive;">SaveSmart</a>
            <p class="text-sm opacity-75" style="font-family: 'Sniglet', cursive;">Gestion Financière</p>
        </div>

        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-4 rounded hover:bg-purple-800 {{ request()->routeIs('home') ? 'bg-purple-800' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Tableau de Bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('transactions.create') }}"
                        class="block py-2 px-4 rounded hover:bg-purple-800 {{ request()->routeIs('transactions.create') ? 'bg-purple-800' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Ajouter une Transaction
                    </a>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}"
                        class="block py-2 px-4 rounded hover:bg-purple-800 {{ request()->routeIs('transactions.index') ? 'bg-purple-800' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Voir les Transactions
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"
                        class="block py-2 px-4 rounded hover:bg-purple-800 {{ request()->routeIs('categories.index') ? 'bg-purple-800' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Gérer les Catégories
                    </a>
                </li>
                <li>
                    <a href="{{ route('family_profiles.index') }}"
                        class="block py-2 px-4 rounded hover:bg-purple-800 {{ request()->routeIs('family_profiles.index') ? 'bg-purple-800' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Gérer les Profils Familiaux
                    </a>
                </li>
                <li> <!-- Ajout du lien vers la gestion des objectifs d'épargne -->
                    <a href="{{ route('saving_goals.index') }}"
                        class="block py-2 px-4 rounded hover:bg-purple-800 {{ request()->routeIs('saving_goals.*') ? 'bg-purple-800' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Gérer les Objectifs d'Épargne
                    </a>
                </li>
                <li> <!-- Lien vers la modification du profil utilisateur -->
                    <a href="{{ route('user.edit') }}"
                        class="block py-2 px-4 rounded hover:bg-purple-800 {{ request()->routeIs('user.edit') ? 'bg-purple-800' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Modifier mon Profil
                    </a>
                </li>
                <!-- Ajoutez d'autres liens ici -->
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navigation Bar -->
        <nav class="bg-white shadow py-4">
            <div class="container mx-auto px-4 flex items-center justify-between">
                <!-- Le logo est déjà dans la sidebar -->
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
                        <!-- Lien vers la modification du profil utilisateur (dans la barre de navigation) -->
                        <a href="{{ route('user.edit') }}" class="text-blue-500 hover:text-blue-700"
                            style="font-family: 'Sniglet', cursive;">Modifier mon Profil</a>
                    </form>
                </div>
            </div>
        </nav>

        <main class="container mx-auto mt-8 px-4 flex-grow">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column: Dashboard Content -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800" style="font-family: 'Sniglet', cursive;">
                        Tableau de Bord</h2>
                    <p class="text-gray-700" style="font-family: 'Sniglet', cursive;">Bienvenue sur votre tableau de
                        bord SaveSmart. Ici, vous pourrez gérer vos finances personnelles et familiales.</p>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 rounded-lg shadow p-4">
                            <h3 class="text-gray-500 text-sm">Solde Total</h3>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format(Auth::user()->revenu_mensuel, 2) }} €</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg shadow p-4">
                            <h3 class="text-gray-500 text-sm">Revenus (Mois)</h3>
                            <p class="text-2xl font-bold text-green-600">+3,240.00 €</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg shadow p-4">
                            <h3 class="text-gray-500 text-sm">Dépenses (Mois)</h3>
                            <p class="text-2xl font-bold text-red-600">-1,840.75 €</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg shadow p-4">
                            <h3 class="text-gray-500 text-sm">Épargne (50/30/20)</h3>
                            <p class="text-2xl font-bold text-purple-600">20%</p>
                        </div>
                    </div>

                    <!-- Budget Distribution -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-4">Distribution du Budget (50/30/20)</h3>
                        @php
$revenuMensuel = Auth::user()->revenu_mensuel; // Récupérer le revenu mensuel
$repartition = \App\Services\BudgetService::calculerRepartition503020($revenuMensuel); // Calculer la répartition
                        @endphp
                        @if ($revenuMensuel > 0)
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span>Besoins (50%)</span>
                                        <span>{{ number_format($repartition['besoins'], 2) }} €</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 50%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span>Envies (30%)</span>
                                        <span>{{ number_format($repartition['envies'], 2) }} €</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 30%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span>Épargne (20%)</span>
                                        <span>{{ number_format($repartition['epargne'], 2) }} €</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-purple-600 h-2 rounded-full" style="width: 20%"></div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Veuillez ajouter votre revenu mensuel dans votre profil pour voir la répartition budgétaire.
                            </p>
                        @endif
                    </div>

                    <!-- Savings Goals -->
                    <div>
                        <h3 class="font-semibold mb-4">Objectifs d'Épargne</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @if(Auth::user()->savingGoals->isNotEmpty())
                                                    <!-- Vérification avant la boucle -->
                                                    @foreach(Auth::user()->savingGoals as $goal)
                                                                            <div class="border rounded-lg p-4">
                                                                                <div class="flex justify-between items-center mb-2">
                                                                                    <h4 class="font-medium">{{ $goal->name }}</h4>
                                                                                    @php
        $progress = ($goal->current_amount / $goal->target_amount) * 100;
        $progress = min($progress, 100); // Pour éviter que la barre dépasse 100%
                                                                                    @endphp
                                                                                    <span class="text-sm text-purple-600">{{ number_format($progress, 0) }}%</span>
                                                                                </div>
                                                                                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                                                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                                                                </div>
                                                                                <div class="flex justify-between text-sm text-gray-500">
                                                                                    <span>{{ $goal->current_amount }}€ / {{ $goal->target_amount }}€</span>
                                                                                    <span>{{ $goal->deadline instanceof \DateTime ? $goal->deadline->format('M Y') : 'Sans date' }}</span>
                                                                                </div>
                                                                            </div>
                                                    @endforeach
                            @else
                                <p>Aucun objectif d'épargne défini. <a href="{{ route('saving_goals.create') }}">Ajouter un
                                        objectif</a></p>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Right Column: Recent Transactions -->
                <div class="bg-white shadow rounded-lg p-6">
                    <!-- Recent Transactions -->
                    <div>
                        <h3 class="font-semibold mb-4">Transactions Récentes</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <div>
                                    <p class="font-medium">Courses Alimentaires</p>
                                    <p class="text-sm text-gray-500">15 Juin 2023</p>
                                </div>
                                <span class="text-red-600">-85.42 €</span>
                            </div>
                            <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                <div>
                                    <p class="font-medium">Salaire</p>
                                    <p class="text-sm text-gray-500">14 Juin 2023</p>
                                </div>
                                <span class="text-green-600">+2,450.00 €</span>
                            </div>
                        </div>
                    </div>
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