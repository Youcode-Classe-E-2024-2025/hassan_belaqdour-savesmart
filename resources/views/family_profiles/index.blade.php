<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profils Familiaux</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Profils Familiaux</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('family_profiles.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Ajouter un
            Profil</a>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($familyProfiles as $profile)
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-xl font-semibold">{{ $profile->first_name }} {{ $profile->last_name }}</h2>
                    @if($profile->profile_image)
                        <img src="{{ $profile->profile_image }}" alt="Image de profil"
                            class="mt-2 rounded-full w-20 h-20 object-cover">
                    @endif
                    <p class="text-gray-600">{{ $profile->bio }}</p>
                    <div class="mt-4">
                        <a href="{{ route('family_profiles.show', $profile->id) }}"
                            class="text-blue-500 hover:text-blue-700">Voir</a>
                        <a href="{{ route('family_profiles.edit', $profile->id) }}"
                            class="text-green-500 hover:text-green-700 ml-2">Modifier</a>
                        <form action="{{ route('family_profiles.destroy', $profile->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce profil ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>