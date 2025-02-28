<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil Familial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Modifier le Profil Familial</h1>

        <form action="{{ route('family_profiles.update', $familyProfile->id) }}" method="POST"
            enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">Prénom:</label>
                <input type="text" id="first_name" name="first_name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $familyProfile->first_name }}" required>
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                <input type="text" id="last_name" name="last_name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $familyProfile->last_name }}" required>
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-gray-700 text-sm font-bold mb-2">Bio:</label>
                <textarea id="bio" name="bio"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    rows="3">{{ $familyProfile->bio }}</textarea>
            </div>

            <div class="mb-4">
                <label for="profile_image" class="block text-gray-700 text-sm font-bold mb-2">Image de profil:</label>
                <input type="file" id="profile_image" name="profile_image"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @if($familyProfile->profile_image)
                    <img src="{{ $familyProfile->profile_image }}" alt="Image de profil actuelle"
                        class="mt-2 rounded-full w-20 h-20 object-cover">
                @endif
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Mettre à jour
                </button>
                <a href="{{ route('family_profiles.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</body>

</html>