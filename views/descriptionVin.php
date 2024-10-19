<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Vin</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x.x/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl" x-data="{ commentaire: '' }">
        <h1 class="text-2xl font-bold mb-6 text-center">Détails du Vin</h1>
        <div class="mb-4">
            <p><strong>Nom:</strong> <?php echo $vin['nom']; ?></p>
            <p><strong>Année:</strong> <?php echo $vin['annee']; ?></p>
            <p><strong>Couleur:</strong> <?php echo $vin['couleur']; ?></p>
            <p><strong>Région:</strong> <?php echo $vin['region']; ?></p>
            <p><strong>Type de Bouteille:</strong> <?php echo $vin['type_bouteille']; ?></p>
        </div>
        <h2 class="text-xl font-bold mb-4">Commentaires</h2>
        <div class="mb-4">
            <form action="index.php?action=createCommentaire" method="post" @submit.prevent="if(commentaire) $el.submit()">
                <input type="hidden" name="vin_id" value="<?php echo $vin['id']; ?>">
                <label for="commentaire" class="block text-gray-700">Ajouter un commentaire:</label>
                <textarea id="commentaire" name="texte" x-model="commentaire" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required></textarea>
                <br>
                <input type="submit" value="Ajouter" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
            </form>
        </div>
        <div>
            <ul>
                <?php foreach ($commentaires as $commentaire): ?>
                    <li class="mb-2 border-b pb-2">
                        <p><?php echo $commentaire['texte']; ?></p>
                        <a href="index.php?action=updateCommentaireForm&id=<?php echo $commentaire['id']; ?>" class="text-blue-500 hover:underline">Modifier</a>
                        <a href="index.php?action=deleteCommentaire&id=<?php echo $commentaire['id']; ?>" class="text-red-500 hover:underline ml-2">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
