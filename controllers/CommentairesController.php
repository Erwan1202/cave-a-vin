<?php
require_once 'models/commentaire.php';
require_once 'models/bdd.php';

class CommentaireController {
    public function create($texte, $utilisateur_id, $vin_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("INSERT INTO commentaire (texte, utilisateur_id, vin_id) VALUES (:texte, :utilisateur_id, :vin_id)");
        $stmt->bindParam(':texte', $texte);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':vin_id', $vin_id);
        $stmt->execute();
    }

    public function read($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM commentaire WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readByVin($vin_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM commentaire WHERE vin_id = :vin_id");
        $stmt->bindParam(':vin_id', $vin_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentairesByUtilisateur($utilisateur_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM commentaire WHERE utilisateur_id = :utilisateur_id");
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $texte, $utilisateur_id, $vin_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("UPDATE commentaire SET texte = :texte, utilisateur_id = :utilisateur_id, vin_id = :vin_id WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':texte', $texte);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':vin_id', $vin_id);
        $stmt->execute();
    }

    public function delete($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("DELETE FROM commentaire WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
