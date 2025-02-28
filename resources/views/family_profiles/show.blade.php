<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir le Profil Familial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Profil Familial</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold">{{ $familyProfile->first_name }} {{ $familyProfile->last_name }}</h2>
            @if($familyProfile->profile_image)
                <img src="{{ $familyProfile->profile_image }}" alt="Image de profil"
                    class="mt-2 rounded-full w-20 h-20 object-cover">
            @endif
            <p class="text-gray-600">{{ $familyProfile->bio }}</p>
            <div class="mt-4">
                <a href="{{ route('family_profiles.edit', $familyProfile->id) }}"
                    class="text-green-500 hover:text-green-700">Modifier</a>
                <a href="{{ route('family_profiles.index') }}" class="text-blue-500 hover:text-blue-700 ml-2">Retour à
                    la liste</a>
            </div>
        </div>
    </div>
</body>

</html>