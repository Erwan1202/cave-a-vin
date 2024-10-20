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
        // Éviter les erreurs de sortie
        ob_start();
        
        // Logique de connexion ici
        // Assurez-vous que votre connexion à la base de données et vos requêtes ne génèrent pas d'erreurs
        
        if ($nom) { // Si l'utilisateur est trouvé
            // Initialiser la session ou rediriger
            header('Location: index.php?action=maCave');
            exit();
        } else {
            // Redirection en cas d'échec
            header('Location: index.php?action=connexion&error=1');
            exit();
        }
        
        // Terminer le tampon de sortie
        ob_end_clean();
    }
    
}
?>
