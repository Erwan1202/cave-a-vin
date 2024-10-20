<?php
require_once 'models/vin.php';
require_once 'models/bdd.php';

class VinController {

    // Méthode privée pour obtenir la connexion à la base de données
    private function getBddConnection() {
        return Bdd::connexion();
    }

    public function create($nom, $annee, $couleur, $region, $type_bouteille, $utilisateur_id, $cave_id) {
        // Vérification que tous les champs nécessaires sont remplis
        if (empty($nom) || empty($annee) || empty($couleur) || empty($region) || empty($type_bouteille) || empty($utilisateur_id)) {
            throw new InvalidArgumentException("Tous les champs doivent être remplis, sauf cave_id.");
        }
        
        // Assurez-vous que cave_id est toujours défini
        $cave_id = $utilisateur_id; // Utiliser utilisateur_id comme cave_id

        try {
            $bdd = $this->getBddConnection();
            $stmt = $bdd->prepare("
                INSERT INTO vin (nom, annee, couleur, region, type_bouteille, utilisateur_id, cave_id)
                VALUES (:nom, :annee, :couleur, :region, :type_bouteille, :utilisateur_id, :cave_id)
            ");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':couleur', $couleur);
            $stmt->bindParam(':region', $region);
            $stmt->bindParam(':type_bouteille', $type_bouteille);
            $stmt->bindParam(':utilisateur_id', $utilisateur_id);
            $stmt->bindParam(':cave_id', $cave_id);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur lors de la création du vin : ' . $e->getMessage());
        }
    }

    // Lire un vin
    public function read($id) {
        if (empty($id)) {
            throw new InvalidArgumentException("L'identifiant du vin ne peut pas être vide.");
        }

        try {
            $bdd = $this->getBddConnection();
            $stmt = $bdd->prepare("SELECT * FROM vin WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la lecture du vin : ' . $e->getMessage());
        }
    }

    // Mettre à jour un vin
    public function update($id, $nom, $annee, $couleur, $region, $type_bouteille, $utilisateur_id, $cave_id) {
        if (empty($id) || empty($nom) || empty($annee) || empty($couleur) || empty($region) || empty($type_bouteille) || empty($utilisateur_id) || empty($cave_id)) {
            throw new InvalidArgumentException("Tous les champs doivent être remplis.");
        }

        try {
            $bdd = $this->getBddConnection();
            $stmt = $bdd->prepare("
                UPDATE vin
                SET nom = :nom, annee = :annee, couleur = :couleur, region = :region, type_bouteille = :type_bouteille,
                    utilisateur_id = :utilisateur_id, cave_id = :cave_id
                WHERE id = :id
            ");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':couleur', $couleur);
            $stmt->bindParam(':region', $region);
            $stmt->bindParam(':type_bouteille', $type_bouteille);
            $stmt->bindParam(':utilisateur_id', $utilisateur_id);
            $stmt->bindParam(':cave_id', $cave_id);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour du vin : ' . $e->getMessage());
        }
    }

    // Supprimer un vin
    public function delete($id) {
        if (empty($id)) {
            throw new InvalidArgumentException("L'identifiant du vin ne peut pas être vide.");
        }

        try {
            $bdd = $this->getBddConnection();
            $stmt = $bdd->prepare("DELETE FROM vin WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur lors de la suppression du vin : ' . $e->getMessage());
        }
    }
}
?>
