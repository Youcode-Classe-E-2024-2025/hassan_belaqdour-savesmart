<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-xl font-bold">Espace Familial</div>
            <div>
                <a href="/home" class="text-white hover:text-indigo-200 transition">Accueil</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-indigo-800">Modifier mon Profil</h1>
            <p class="text-gray-600 mt-1">Mettez à jour vos informations personnelles</p>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center mb-8 pb-4 border-b border-gray-100">
                    <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center text-indigo-600">
                        <i class="fas fa-user text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                <form action="{{ route('user.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2 md:col-span-1">
                            <label for="name" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-user-tag mr-1 text-indigo-500"></i> Nom complet
                            </label>
                            <input type="text" id="name" name="name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all"
                                value="{{ $user->name }}" required>
                            <p class="text-xs text-gray-500 mt-1">Votre nom tel qu'il apparaîtra sur votre profil</p>
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label for="email" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-envelope mr-1 text-indigo-500"></i> Adresse email
                            </label>
                            <input type="email" id="email" name="email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all"
                                value="{{ $user->email }}" required>
                            <p class="text-xs text-gray-500 mt-1">Cette adresse sera utilisée pour les notifications</p>
                        </div>

                        <div class="col-span-2">
                            <label for="revenu_mensuel" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-money-bill-wave mr-1 text-indigo-500"></i> Revenu mensuel
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">€</span>
                                <input type="number" id="revenu_mensuel" name="revenu_mensuel"
                                    class="w-full pl-8 px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all"
                                    step="0.01" value="{{ $user->revenu_mensuel }}">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Cette information est utilisée pour calculer votre
                                budget</p>
                        </div>
                    </div>

                    <div class="bg-indigo-50 rounded-lg p-4 mt-6 text-indigo-700 text-sm">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt mt-1 mr-2"></i>
                            <div>
                                <p class="font-semibold">Sécurité et confidentialité</p>
                                <p>Toutes vos informations sont protégées et ne seront jamais partagées avec des tiers.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i> Mettre à jour mon profil
                        </button>
                        <a href="{{ route('home') }}"
                            class="text-gray-600 hover:text-gray-800 font-medium transition-colors flex items-center">
                            <i class="fas fa-times mr-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="mt-12 bg-gray-100 border-t border-gray-200">
        <div class="container mx-auto px-4 py-6 text-center text-gray-500 text-sm">
            <p>&copy; 2025 Espace Familial - Tous droits réservés</p>
        </div>
    </footer>
</body>

</html>