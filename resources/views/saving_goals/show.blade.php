<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Objectif d'Épargne</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Détails de l'Objectif d'Épargne</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <p><strong>Nom:</strong> {{ $savingGoal->name }}</p>
            <p><strong>Montant Cible:</strong> {{ $savingGoal->target_amount }}</p>
            <p><strong>Montant Actuel:</strong> {{ $savingGoal->current_amount }}</p>
            <p><strong>Date Limite:</strong> {{ $savingGoal->deadline ? $savingGoal->deadline->format('d/m/Y') : '-' }}
            </p>
            <p><strong>Description:</strong> {{ $savingGoal->description }}</p>

            <div class="mt-4">
                <a href="{{ route('saving_goals.edit', $savingGoal->id) }}"
                    class="text-green-500 hover:text-green-700">Modifier</a>
                <a href="{{ route('saving_goals.index') }}" class="text-blue-500 hover:text-blue-700 ml-2">Retour à la
                    liste</a>
            </div>
        </div>
    </div>
</body>

</html>