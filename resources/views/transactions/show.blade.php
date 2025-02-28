<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Transaction</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Détails de la Transaction</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <p><strong>Date:</strong> {{ $transaction->date->format('d/m/Y') }}</p>
            <p><strong>Catégorie:</strong> {{ $transaction->category->name }}</p>
            <p><strong>Montant:</strong> {{ $transaction->amount }}</p>
            <p><strong>Type:</strong> {{ $transaction->type }}</p>
            <p><strong>Description:</strong> {{ $transaction->description }}</p>

            <div class="mt-4">
                <a href="{{ route('transactions.edit', $transaction->id) }}"
                    class="text-green-500 hover:text-green-700">Modifier</a>
                <a href="{{ route('transactions.index') }}" class="text-blue-500 hover:text-blue-700 ml-2">Retour à la
                    liste</a>
            </div>
        </div>
    </div>
</body>

</html>