<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x.x/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md" x-data="{ nom: '', mdp: '' }">
        <h1 class="text-2xl font-bold mb-6 text-center">Connexion</h1>
        <form action="index.php?action=login" method="post" @submit.prevent="if(nom && mdp) $el.submit()">
            <div class="mb-4">
                <label for="nom" class="block text-gray-700">Nom:</label>
                <input type="text" id="nom" name="nom" x-model="nom" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <div class="mb-6">
                <label for="mdp" class="block text-gray-700">Mot de passe:</label>
                <input type="password" id="mdp" name="mdp" x-model="mdp" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Se connecter</button>
            </div>
        </form>
        <!-- Bouton d'inscription ajouté ici -->
        <div action="index.php?action=inscription" class="text-center mt-4">
            <a class="text-blue-500 hover:underline">Créer un compte</a>
        </div>
    </div>
</body>
</html>
