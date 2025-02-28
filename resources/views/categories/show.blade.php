<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Catégorie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Détails de la Catégorie</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <p><strong>Nom:</strong> {{ $category->name }}</p>
            <p><strong>Type:</strong> {{ $category->type }}</p>

            <div class="mt-4">
                <a href="{{ route('categories.edit', $category->id) }}"
                    class="text-green-500 hover:text-green-700">Modifier</a>
                <a href="{{ route('categories.index') }}" class="text-blue-500 hover:text-blue-700 ml-2">Retour à la
                    liste</a>
            </div>
        </div>
    </div>
</body>

</html>