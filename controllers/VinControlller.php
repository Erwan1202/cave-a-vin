<?php
require_once 'models/vin.php';
require_once 'bdd.php';

class VinController {
    public function create($nom, $annee, $couleur, $region, $type_bouteille, $utilisateur_id, $cave_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("INSERT INTO vin (nom, annee, couleur, region, type_bouteille, utilisateur_id, cave_id) VALUES (:nom, :annee, :couleur, :region, :type_bouteille, :utilisateur_id, :cave_id)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':couleur', $couleur);
        $stmt->bindParam(':region', $region);
        $stmt->bindParam(':type_bouteille', $type_bouteille);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':cave_id', $cave_id);
        $stmt->execute();
    }

    public function read($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM vin WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nom, $annee, $couleur, $region, $type_bouteille, $utilisateur_id, $cave_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("UPDATE vin SET nom = :nom, annee = :annee, couleur = :couleur, region = :region, type_bouteille = :type_bouteille, utilisateur_id = :utilisateur_id, cave_id = :cave_id WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':couleur', $couleur);
        $stmt->bindParam(':region', $region);
        $stmt->bindParam(':type_bouteille', $type_bouteille);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':cave_id', $cave_id);
        $stmt->execute();
    }

    public function delete($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("DELETE FROM vin WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
