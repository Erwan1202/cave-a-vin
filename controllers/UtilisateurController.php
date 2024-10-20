<?php
require_once 'models/utilisateurs.php';
require_once 'models/bdd.php';

class UtilisateurController {
    public function create($nom, $mdp) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("INSERT INTO utilisateur (nom, mdp) VALUES (:nom, :mdp)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
    }

    public function read($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nom, $mdp) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("UPDATE utilisateur SET nom = :nom, mdp = :mdp WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
    }

    public function delete($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("DELETE FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function readByNom($nom) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE nom = :nom");
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($nom, $mdp) {
        $utilisateur = $this->readByNom($nom);
        if ($utilisateur && $utilisateur['mdp'] == $mdp) {
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['utilisateur_nom'] = $utilisateur['nom']; // Ajout de la variable de session pour le nom
            header('Location: index.php?action=maCave');
        } else {
            header('Location: index.php?action=connexion');
        }
    }
}
?>
