<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
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

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-indigo-800">Catégories</h1>
                <p class="text-gray-600 mt-1">Gérez les différentes catégories de votre espace</p>
            </div>
            <a href="{{ route('categories.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Ajouter une Catégorie
            </a>
        </div>

        @if(session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md mb-6 flex items-start">
                <i class="fas fa-check-circle mt-1 mr-2"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md mb-6 flex items-start">
                <i class="fas fa-exclamation-circle mt-1 mr-2"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-indigo-50 text-indigo-800">
                            <th class="py-3 px-6 text-left font-semibold border-b border-indigo-100">Nom</th>
                            <th class="py-3 px-6 text-left font-semibold border-b border-indigo-100">Type</th>
                            <th class="py-3 px-6 text-right font-semibold border-b border-indigo-100">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-6 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <span
                                            class="bg-indigo-100 text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <span class="font-medium">{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 border-b border-gray-100">
                                    <span class="bg-indigo-50 text-indigo-700 py-1 px-3 rounded-full text-xs font-medium">
                                        {{ $category->type }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 border-b border-gray-100 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('categories.show', $category->id) }}"
                                            class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                                            <i class="fas fa-eye"></i>
                                            <span class="ml-1">Voir</span>
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="text-emerald-600 hover:text-emerald-800 font-medium flex items-center">
                                            <i class="fas fa-edit"></i>
                                            <span class="ml-1">Modifier</span>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 font-medium flex items-center"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                                <i class="fas fa-trash-alt"></i>
                                                <span class="ml-1">Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if(count($categories) == 0)
                            <tr>
                                <td colspan="3" class="py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-tag text-indigo-300 text-4xl mb-3"></i>
                                        <p class="text-lg">Aucune catégorie trouvée</p>
                                        <p class="text-sm mt-1">Commencez par ajouter une première catégorie</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-lg p-4 text-indigo-700 text-sm">
            <div class="flex items-start">
                <i class="fas fa-info-circle mt-1 mr-2"></i>
                <div>
                    <p class="font-semibold">Information</p>
                    <p>Les catégories sont utilisées pour organiser vos contenus. Une fois supprimée, une catégorie ne
                        peut pas être restaurée.</p>
                </div>
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