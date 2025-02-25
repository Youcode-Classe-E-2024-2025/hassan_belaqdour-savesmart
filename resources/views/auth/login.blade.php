<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Police plus moderne */
        }
    </style>
</head>

<body class="h-screen overflow-hidden flex bg-indigo-50 text-gray-800">

    <!-- Partie Image (50% de la largeur) -->
    <div class="w-1/2 h-screen">
        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="Illustration de gestion financière" class="object-cover h-full w-full">
    </div>

    <!-- Partie Formulaire de Connexion (50% de la largeur) -->
    <div class="w-1/2 flex items-center justify-center">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 w-3/4">
            <h1 class="block text-indigo-700 text-2xl font-bold mb-6 text-center">Connexion</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email :</label>
                    <input type="email" id="email" name="email"
                        class="shadow appearance-none border border-indigo-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('email') }}" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe :</label>
                    <input type="password" id="password" name="password"
                        class="shadow appearance-none border border-indigo-300 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <button type="submit"
                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Se
                    connecter</button>
            </form>

            <div class="mt-8 text-center">
                <p>Pas encore inscrit ?
                    <a href="{{ route('register') }}"
                        class="text-indigo-500 hover:text-indigo-700 font-bold">Inscrivez-vous</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>