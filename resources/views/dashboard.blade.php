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
    <aside class="bg-white w-64 py-4 px-3 flex-shrink-0 fixed h-full">
        <div class="mb-8">
            <a href="{{ route('home') }}" class="text-2xl font-semibold block mb-2"
                style="font-family: 'Sniglet', cursive;">SaveSmart</a>
            <p class="text-sm opacity-75" style="font-family: 'Sniglet', cursive;">Gestion Financière</p>
        </div>

        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('home') ? 'bg-gray-200' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Tableau de Bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('transactions.index') ? 'bg-gray-200' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Voir les Transactions
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('categories.index') ? 'bg-gray-200' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Gérer les Catégories
                    </a>
                </li>
                <li>
                    <a href="{{ route('family_profiles.index') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('family_profiles.index') ? 'bg-gray-200' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Gérer les Profils Familiaux
                    </a>
                </li>
                <li>
                    <a href="{{ route('saving_goals.index') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('saving_goals.index') ? 'bg-gray-200' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Gérer les Objectifs d'Épargne
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.edit') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('user.edit') ? 'bg-gray-200' : '' }}"
                        style="font-family: 'Sniglet', cursive;">
                        Modifier mon Profil
                    </a>
                </li>
                <!-- Ajoutez d'autres liens ici -->
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-64">
        <!-- Header -->
        <header class="bg-white shadow-sm p-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <!--  Profile Image and Name -->
                    <img src="{{ asset('placeholder-image.png') }}" alt="Profile" class="rounded-full w-10 h-10">
                    <span class="font-semibold" style="font-family: 'Sniglet', cursive;">{{ Auth::user()->name }}</span>
                </div>
                <!-- Déconnexion Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        style="font-family: 'Sniglet', cursive;">Déconnexion</button>
                </form>

            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 p-4 overflow-y-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- Left Column -->
                <div class="md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Solde Total -->
                        <div class="bg-white shadow-md rounded p-4">
                            <h3 class="text-gray-500 text-sm" style="font-family: 'Sniglet', cursive;">Solde Total</h3>
                            <p class="text-2xl font-bold text-gray-800">
                                {{ number_format(Auth::user()->revenu_mensuel, 2) }}
                                €</p>
                        </div>

                        <!-- Revenus -->
                        <div class="bg-white shadow-md rounded p-4">
                            <h3 class="text-gray-500 text-sm" style="font-family: 'Sniglet', cursive;">Revenus</h3>
                            <p class="text-2xl font-bold text-green-600">+0.00 €</p>
                        </div>

                        <!-- Dépenses -->
                        <div class="bg-white shadow-md rounded p-4">
                            <h3 class="text-gray-500 text-sm" style="font-family: 'Sniglet', cursive;">Dépenses</h3>
                            <p class="text-2xl font-bold text-red-600">-0.00 €</p>
                        </div>
                    </div>

                    <!-- Add Transaction Form -->
                    <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                        <h3 class="text-xl font-bold mb-4" style="font-family: 'Sniglet', cursive;">Ajouter une
                            Transaction</h3>
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2"
                                    style="font-family: 'Sniglet', cursive;">Catégorie:</label>
                                <select id="category_id" name="category_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div class="mb-4">
                                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2"
                                        style="font-family: 'Sniglet', cursive;">Montant:</label>
                                    <input type="number" id="amount" name="amount" step="0.01"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="date" class="block text-gray-700 text-sm font-bold mb-2"
                                        style="font-family: 'Sniglet', cursive;">Date:</label>
                                    <input type="date" id="date" name="date"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        required>
                                </div>

                            </div>


                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2"
                                    style="font-family: 'Sniglet', cursive;">Description:</label>
                                <textarea id="description" name="description" rows="3"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                    style="font-family: 'Sniglet', cursive;">Type:</label>
                                <div class="flex items-center">
                                    <input type="radio" id="type_revenu" name="type" value="revenu" class="mr-2"
                                        required>
                                    <label for="type_revenu" class="mr-4"
                                        style="font-family: 'Sniglet', cursive;">Revenu</label>

                                    <input type="radio" id="type_depense" name="type" value="depense" class="mr-2"
                                        required>
                                    <label for="type_depense" style="font-family: 'Sniglet', cursive;">Dépense</label>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    style="font-family: 'Sniglet', cursive;">
                                    Ajouter
                                </button>

                            </div>
                        </form>
                    </div>

                    <!-- Add Savings Goal Form -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4" style="font-family: 'Sniglet', cursive;">Ajouter un Objectif
                            d'Épargne</h3>
                        <form action="{{ route('saving_goals.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2"
                                    style="font-family: 'Sniglet', cursive;">Nom:</label>
                                <input type="text" id="name" name="name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="target_amount" class="block text-gray-700 text-sm font-bold mb-2"
                                        style="font-family: 'Sniglet', cursive;">Montant Cible:</label>
                                    <input type="number" id="target_amount" name="target_amount" step="0.01"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2"
                                        style="font-family: 'Sniglet', cursive;">Date Limite:</label>
                                    <input type="date" id="deadline" name="deadline"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                            </div>



                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2"
                                    style="font-family: 'Sniglet', cursive;">Description:</label>
                                <textarea id="description" name="description" rows="3"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    style="font-family: 'Sniglet', cursive;">
                                    Ajouter
                                </button>

                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="md:col-span-1">
                    <!-- Transactions Récentes -->
                    <div class="bg-white shadow-md rounded p-4 mb-4">
                        <h3 class="font-semibold mb-2" style="font-family: 'Sniglet', cursive;">Transactions
                            Récentes</h3>
                        <div class="space-y-3">
                            @forelse($transactions as $transaction)
                                <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                                    <div>
                                        <p class="font-medium">{{ $transaction->category->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $transaction->date->format('d M Y') }}</p>
                                    </div>
                                    <span class="{{ $transaction->type == 'depense' ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $transaction->type == 'depense' ? '-' : '+' }}{{ number_format($transaction->amount, 2) }}
                                        €
                                    </span>
                                </div>
                            @empty
                                <p>No transaction added.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Objectifs d'Épargne -->
                    <div class="bg-white shadow-md rounded p-4">
                        <h3 class="font-semibold mb-2" style="font-family: 'Sniglet', cursive;">Objectifs d'Épargne
                        </h3>
                        <div class="space-y-3">
                            <!-- Add the saving goal information here -->
                            <p>No data found about saving goals.</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </div>

</body>

</html>