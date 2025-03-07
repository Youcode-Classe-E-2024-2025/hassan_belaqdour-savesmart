<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profils Familiaux</title>
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
            <h1 class="text-3xl font-bold text-indigo-800">Profils Familiaux</h1>
            <a href="{{ route('family_profiles.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Ajouter un Profil
            </a>
        </div>

        @if(session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md mb-6 flex items-start">
                <i class="fas fa-check-circle mt-1 mr-2"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($familyProfiles as $profile)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            @if($profile->profile_image)
                                <img src="{{ $profile->profile_image }}" alt="Image de profil"
                                    class="rounded-full w-16 h-16 object-cover border-2 border-indigo-200">
                            @else
                                <div
                                    class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center text-indigo-500">
                                    <i class="fas fa-user text-2xl"></i>
                                </div>
                            @endif
                            <div class="ml-4">
                                <h2 class="text-xl font-semibold text-indigo-700">{{ $profile->first_name }}
                                    {{ $profile->last_name }}</h2>
                                <p class="text-sm text-gray-500">Ajouté le
                                    {{ date('d/m/Y', strtotime($profile->created_at)) }}</p>
                            </div>
                        </div>

                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $profile->bio }}</p>

                        <div class="flex justify-between pt-3 border-t border-gray-100">
                            <a href="{{ route('family_profiles.show', $profile->id) }}"
                                class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </a>
                            <div class="flex space-x-2">
                                <a href="{{ route('family_profiles.edit', $profile->id) }}"
                                    class="text-emerald-600 hover:text-emerald-800 font-medium flex items-center">
                                    <i class="fas fa-edit mr-1"></i> Modifier
                                </a>
                                <form action="{{ route('family_profiles.destroy', $profile->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 font-medium flex items-center"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce profil ?')">
                                        <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($familyProfiles) == 0)
            <div class="bg-indigo-50 rounded-lg p-8 text-center">
                <i class="fas fa-users text-indigo-300 text-5xl mb-4"></i>
                <h3 class="text-xl font-medium text-indigo-800 mb-2">Aucun profil pour le moment</h3>
                <p class="text-indigo-600 mb-4">Commencez par ajouter un premier profil familial</p>
                <a href="{{ route('family_profiles.create') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                    Créer un profil
                </a>
            </div>
        @endif
    </div>

    <footer class="mt-12 bg-gray-100 border-t border-gray-200">
        <div class="container mx-auto px-4 py-6 text-center text-gray-500 text-sm">
            <p>&copy; 2025 Espace Familial - Tous droits réservés</p>
        </div>
    </footer>
</body>

</html>