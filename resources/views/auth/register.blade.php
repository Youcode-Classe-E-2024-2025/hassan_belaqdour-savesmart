<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Sniglet&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Sniglet', cursive;
            /* Apply Sniglet globally */
        }
    </style>
</head>

<body class="h-screen overflow-hidden flex bg-indigo-50 text-gray-800">

    <!-- Partie Image (50% de la largeur) -->
    <div class="w-1/2 h-screen">
        <img src="https://img.freepik.com/vecteurs-libre/illustration-concept-investissement_114360-3218.jpg?t=st=1740499341~exp=1740502941~hmac=87d6859c424de1ad670bd3574efad6bdd4119da5e5df4a765fb9902b84047e57&w=900"
            alt="Illustration d'investissement ou de croissance financière" class="object-cover h-full w-full">
    </div>

    <!-- Partie Formulaire d'Inscription (50% de la largeur) -->
    <div class="w-1/2 flex items-center justify-center">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 w-3/4">

            <div class="text-center mb-6">
                <h1 class="font-semibold text-3xl text-indigo-700" style="font-family: 'Sniglet', cursive;">SaveSmart
                </h1>
                <p class="text-sm" style="font-family: 'Sniglet', cursive;">Créez votre compte SaveSmart et commencez à
                    gérer vos finances.</p>
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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2"
                        style="font-family: 'Sniglet', cursive;">Nom :</label>
                    <input type="text" id="name" name="name"
                        class="shadow appearance-none border border-indigo-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('name') }}" required style="font-family: 'Sniglet', cursive;">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2"
                        style="font-family: 'Sniglet', cursive;">Email :</label>
                    <input type="email" id="email" name="email"
                        class="shadow appearance-none border border-indigo-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('email') }}" required style="font-family: 'Sniglet', cursive;">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2"
                        style="font-family: 'Sniglet', cursive;">Mot de passe :</label>
                    <input type="password" id="password" name="password"
                        class="shadow appearance-none border border-indigo-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required style="font-family: 'Sniglet', cursive;">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2"
                        style="font-family: 'Sniglet', cursive;">Confirmation
                        du mot de passe :</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="shadow appearance-none border border-indigo-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required style="font-family: 'Sniglet', cursive;">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        style="font-family: 'Sniglet', cursive;">S'inscrire</button>
                    <a class="inline-block align-baseline font-bold text-sm text-indigo-500 hover:text-indigo-700"
                        href="{{ route('login') }}" style="font-family: 'Sniglet', cursive;">Déjà un compte ? Se
                        connecter</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>