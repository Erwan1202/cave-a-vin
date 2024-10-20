<?php
require_once 'models/cave.php';
require_once 'models/bdd.php';

class CaveController {
    public function create($nom, $utilisateur_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("INSERT INTO cave (nom, utilisateur_id) VALUES (:nom, :utilisateur_id)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
    }

    public function read($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM cave WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nom, $utilisateur_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("UPDATE cave SET nom = :nom, utilisateur_id = :utilisateur_id WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
    }

    public function delete($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("DELETE FROM cave WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getVinsByUtilisateur($utilisateurId) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM vin WHERE utilisateur_id = :utilisateur_id");
        $stmt->bindParam(':utilisateur_id', $utilisateurId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
?>
