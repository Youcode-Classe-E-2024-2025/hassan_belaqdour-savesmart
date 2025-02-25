<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Sniglet&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Sniglet', cursive;
        }
    </style>
</head>

<body class="h-screen overflow-hidden flex bg-purple-50 text-gray-800">

    <!-- Partie Image (50% de la largeur) -->
    <div class="w-1/2 h-screen">
        <img src="https://img.freepik.com/vecteurs-libre/illustration-notion-comptabilite_114360-16010.jpg?t=st=1740499472~exp=1740503072~hmac=74c9ceb6fe7a705225886ae0b9a18d8bf1721fa564a42a8efd854f6aa6cc2ef9&w=900"
            alt="Illustration de gestion financière" class="object-cover h-full w-full">
    </div>

    <!-- Partie Formulaire de Connexion (50% de la largeur) -->
    <div class="w-1/2 flex items-center justify-center bg-gradient-to-br from-purple-200 to-purple-400">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 w-3/4">
            <div class="text-center mb-6">
                <h1 class="font-semibold text-3xl text-purple-900" style="font-family: 'Sniglet', cursive;">SaveSmart
                </h1>
                <p class="text-sm text-gray-700" style="font-family: 'Sniglet', cursive;">Connectez-vous à votre
                    compte.</p>
            </div>

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
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2"
                        style="font-family: 'Sniglet', cursive;">Email :</label>
                    <input type="email" id="email" name="email"
                        class="shadow appearance-none border border-purple-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('email') }}" required style="font-family: 'Sniglet', cursive;">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2"
                        style="font-family: 'Sniglet', cursive;">Mot de passe :</label>
                    <input type="password" id="password" name="password"
                        class="shadow appearance-none border border-purple-400 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        required style="font-family: 'Sniglet', cursive;">
                </div>
                <button type="submit"
                    class="bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
                    style="font-family: 'Sniglet', cursive;">Se connecter</button>
            </form>

            <div class="mt-8 text-center">
                <p style="font-family: 'Sniglet', cursive;">Pas encore inscrit ?
                    <a href="{{ route('register') }}" class="text-purple-500 hover:text-purple-700 font-bold"
                        style="font-family: 'Sniglet', cursive;">Inscrivez-vous</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>