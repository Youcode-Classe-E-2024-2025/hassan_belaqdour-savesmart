<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Transactions</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('transactions.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Ajouter une
            Transaction</a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Catégorie</th>
                        <th class="py-2 px-4 border-b">Montant</th>
                        <th class="py-2 px-4 border-b">Type</th>
                        <th class="py-2 px-4 border-b">Description</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $transaction->date->format('d/m/Y') }}</td>
                            <td class="py-2 px-4 border-b">{{ $transaction->category->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $transaction->amount }}</td>
                            <td class="py-2 px-4 border-b">{{ $transaction->type }}</td>
                            <td class="py-2 px-4 border-b">{{ $transaction->description }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('transactions.show', $transaction->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Voir</a>
                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                    class="text-green-500 hover:text-green-700 ml-2">Modifier</a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?')">Supprimer</button>
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