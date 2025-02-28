<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Catégorie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Modifier une Catégorie</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST"
            class="bg-white shadow rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                <input type="text" id="name" name="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $category->name }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Type:</label>
                <div class="flex items-center">
                    <input type="radio" id="type_revenu" name="type" value="revenu" class="mr-2" {{ $category->type == 'revenu' ? 'checked' : '' }} required>
                    <label for="type_revenu" class="mr-4">Revenu</label>

                    <input type="radio" id="type_depense" name="type" value="depense" class="mr-2" {{ $category->type == 'depense' ? 'checked' : '' }} required>
                    <label for="type_depense">Dépense</label>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Mettre à jour
                </button>
                <a href="{{ route('categories.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</body>

</html>