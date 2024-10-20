<?php
require_once 'models/cave.php';
require_once 'models/bdd.php';

class CaveController {
    // Crée une cave
    public function create($nom, $utilisateur_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("INSERT INTO cave (nom, utilisateur_id) VALUES (:nom, :utilisateur_id)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
    }

    // Lit une cave par son ID
    public function read($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM cave WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Met à jour une cave
    public function update($id, $nom, $utilisateur_id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("UPDATE cave SET nom = :nom, utilisateur_id = :utilisateur_id WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
    }

    // Supprime une cave
    public function delete($id) {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("DELETE FROM cave WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getVinsByUtilisateur($utilisateur_id) {
        $bdd = Bdd::connexion(); // Assurez-vous que la connexion à la base de données est bien établie
        $stmt = $bdd->prepare("SELECT * FROM vins WHERE utilisateur_id = :utilisateur_id");
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!$results) {
            return []; // Retourne un tableau vide si aucun vin n'est trouvé
        }
        return $results;
    }

    // Récupère les vins par cave
    public function getVinsByCave($cave_id) {
        $bdd = Bdd::connexion(); // Connexion à la base de données
        $stmt = $bdd->prepare("SELECT * FROM vins WHERE cave_id = :cave_id");
        $stmt->execute(['cave_id' => $cave_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return []; // Retourne un tableau vide si aucun vin n'est trouvé
        }
        return $results;
    }
}
?>
