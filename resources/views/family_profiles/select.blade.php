<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélectionner un Profil Familial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-3xl text-center">
        <h1 class="text-2xl font-bold mb-6">Sélectionner un Profil Familial</h1>

        @if ($familyProfiles->isEmpty())
            <p class="mb-4">Vous n'avez aucun profil familial.</p>
            <a href="{{ route('family_profiles.create') }}"
                class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">
                <span class="text-xl font-bold mr-2">+</span> Créer un profil
            </a>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                @foreach ($familyProfiles as $profile)
                    <form action="{{ route('store_selected_profile') }}" method="POST">
                        @csrf
                        <input type="hidden" name="family_profile_id" value="{{ $profile->id }}">
                        <button type="submit" class="w-full">
                            <div
                                class="bg-gray-200 p-4 rounded-lg flex flex-col items-center shadow hover:bg-gray-300 transition">
                                <img src="{{ $profile->profile_image ?? asset('placeholder-image.png') }}" alt="Image de profil"
                                    class="mt-2 rounded-full w-20 h-20 object-cover">
                                <p class="font-semibold">{{ $profile->first_name }} {{ $profile->last_name }}</p>
                            </div>
                        </button>
                    </form>
                @endforeach
                <a href="{{ route('family_profiles.create') }}"
                    class="bg-gray-300 p-4 rounded-lg flex flex-col items-center justify-center shadow hover:bg-gray-400">
                    <span class="text-4xl font-bold text-gray-600">+</span>
                    <p class="text-sm text-gray-700">Ajouter un profil</p>
                </a>
            </div>
        @endif
    </div>
</body>

</html>