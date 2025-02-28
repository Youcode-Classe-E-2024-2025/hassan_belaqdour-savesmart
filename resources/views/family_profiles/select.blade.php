<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélectionner un Profil Familial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Sélectionner un Profil Familial</h1>

        @if ($familyProfiles->isEmpty())
            <p>Vous n'avez aucun profil familial. <a href="{{ route('family_profiles.create') }}">Créer un profil</a></p>
        @else
            <form action="{{ route('store_selected_profile') }}" method="POST" class="bg-white shadow rounded-lg p-6">
                @csrf

                <div class="mb-4">
                    <label for="family_profile_id" class="block text-gray-700 text-sm font-bold mb-2">Choisir un profil
                        :</label>
                    <select id="family_profile_id" name="family_profile_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($familyProfiles as $profile)
                            <option value="{{ $profile->id }}">{{ $profile->first_name }} {{ $profile->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Sélectionner
                    </button>
                </div>
            </form>
        @endif
    </div>
</body>

</html>