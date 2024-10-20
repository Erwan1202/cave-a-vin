<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Cave</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x.x/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl"
         x-data="{
             filter: '',
             vins: <?php echo json_encode($vins, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
         }">
        <h1 class="text-2xl font-bold mb-6 text-center">Ma Cave</h1>
        
        <!-- Filtre de recherche et bouton d'ajout -->
        <div class="mb-4 flex justify-between items-center">
            <input type="text" placeholder="Filtrer par nom..." x-model="filter" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            <a href="index.php?action=createVinForm" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Ajouter un Vin</a>
        </div>

        <!-- Table des vins -->
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Année</th>
                    <th class="px-4 py-2">Couleur</th>
                    <th class="px-4 py-2">Région</th>
                    <th class="px-4 py-2">Type de Bouteille</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-if="vins.length === 0">
                    <tr>
                        <td colspan="6" class="text-center py-4">Aucun vin trouvé.</td>
                    </tr>
                </template>

                <template x-for="vin in vins.filter(v => v.nom.toLowerCase().includes(filter.toLowerCase()))" :key="vin.id">
                    <tr>
                        <td class="border px-4 py-2" x-text="vin.nom"></td>
                        <td class="border px-4 py-2" x-text="vin.annee"></td>
                        <td class="border px-4 py-2" x-text="vin.couleur"></td>
                        <td class="border px-4 py-2" x-text="vin.region"></td>
                        <td class="border px-4 py-2" x-text="vin.type_bouteille"></td>
                        <td class="border px-4 py-2">
                            <a :href="'index.php?action=updateVinForm&id=' + vin.id" class="text-blue-500 hover:underline">Modifier</a>
                            <a :href="'index.php?action=deleteVin&id=' + vin.id" class="text-red-500 hover:underline ml-2">Supprimer</a>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</body>
</html>
