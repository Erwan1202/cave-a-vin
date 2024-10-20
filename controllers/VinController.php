<?php
require_once 'models/vin.php';
require_once 'models/bdd.php';

class VinController {

    // Méthode privée pour obtenir la connexion à la base de données
    private function getBddConnection() {
        return Bdd::connexion();
    }

    // Créer un vin
    public function create($nom, $annee, $couleur, $region, $type_bouteille, $utilisateur_id, $cave_id) {
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
