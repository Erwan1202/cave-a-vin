<?php 
class Cave {
    private $id;
    private $nom;
    private $utilisateur_id;

    public function __construct($id, $nom, $utilisateur_id) {
        $this->id = $id;
        $this->nom = $nom;
        $this->utilisateur_id = $utilisateur_id;
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getUtilisateurId() {
        return $this->utilisateur_id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setUtilisateurId($utilisateur_id) {
        $this->utilisateur_id = $utilisateur_id;
    }
}
