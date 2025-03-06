<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objectifs d'Épargne</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Objectifs d'Épargne</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('saving_goals.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Ajouter un
            Objectif</a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Montant Cible</th>
                        <th class="py-2 px-4 border-b">Montant Actuel</th>
                        <th class="py-2 px-4 border-b">Date Limite</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($savingGoals as $goal)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $goal->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $goal->target_amount }}</td>
                            <td class="py-2 px-4 border-b">{{ $goal->current_amount }}</td>
                            <td class="py-2 px-4 border-b">{{ $goal->deadline ? $goal->deadline->format('d/m/Y') : '-' }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('saving_goals.show', $goal->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Voir</a>
                                <a href="{{ route('saving_goals.edit', $goal->id) }}"
                                    class="text-green-500 hover:text-green-700 ml-2">Modifier</a>
                                <form action="{{ route('saving_goals.destroy', $goal->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>