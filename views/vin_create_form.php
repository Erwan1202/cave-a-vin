<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Vin</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x.x/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg" x-data="{ nom: '', annee: '', couleur: '', region: '', type_bouteille: '' }">
        <h1 class="text-2xl font-bold mb-6 text-center">Ajouter un Vin</h1>
        
        <form action="index.php?action=createVin" method="post" class="space-y-4">
            <!-- Nom du vin -->
            <div>
                <label for="nom" class="block text-gray-700">Nom du vin:</label>
                <input type="text" id="nom" name="nom" x-model="nom" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            
            <!-- Année -->
            <div>
                <label for="annee" class="block text-gray-700">Année:</label>
                <input type="number" id="annee" name="annee" x-model="annee" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
            </div>

            <!-- Couleur -->
            <div>
                <label for="couleur" class="block text-gray-700">Couleur:</label>
                <select id="couleur" name="couleur" x-model="couleur" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
                    <option value="">Sélectionner</option>
                    <option value="Rouge">Rouge</option>
                    <option value="Blanc">Blanc</option>
                    <option value="Rosé">Rosé</option>
                </select>
            </div>
            
            <!-- Région -->
            <div>
                <label for="region" class="block text-gray-700">Région:</label>
                <input type="text" id="region" name="region" x-model="region" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
            </div>

            <!-- Type de bouteille -->
            <div>
                <label for="type_bouteille" class="block text-gray-700">Type de Bouteille:</label>
                <select id="type_bouteille" name="type_bouteille" x-model="type_bouteille" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
                    <option value="">Sélectionner</option>
                    <option value="Bouteille standard">Bouteille standard</option>
                    <option value="Magnum">Magnum</option>
                    <option value="Demi-bouteille">Demi-bouteille</option>
                </select>
            </div>

            <!-- Champs cachés pour utilisateur_id et cave_id -->
            <input type="hidden" name="utilisateur_id" value="<?php echo $_SESSION['utilisateur_id']; ?>">
            <input type="hidden" name="cave_id" value="<?php echo $cave_id; ?>"> <!-- Assurez-vous que $cave_id est défini -->

            <!-- Bouton de soumission -->
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Ajouter</button>
                <a href="index.php?action=showCave" class="text-blue-500 hover:underline">Retour à la cave</a>
            </div>
        </form>
    </div>
</body>
</html>
