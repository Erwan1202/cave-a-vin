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
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE nom = :nom");
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si l'utilisateur existe et si le mot de passe correspond
        if ($utilisateur && password_verify($mdp, $utilisateur['mdp'])) {
            // Stockez les informations de l'utilisateur dans la session
            session_start();
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['utilisateur_nom'] = $utilisateur['nom'];

            // Redirigez vers la page de votre cave
            header('Location: index.php?action=maCave');
            exit();
        } else {
            // Redirigez vers la page de connexion avec un message d'erreur
            header('Location: index.php?action=connexion&error=1');
            exit();
        }
    }
}
?>
