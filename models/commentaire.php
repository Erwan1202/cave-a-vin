<?php

class Commentaire {
    private $id;
    private $texte;
    private $utilisateur_id;
    private $vin_id;

    public function __construct($id, $texte, $utilisateur_id, $vin_id) {
        $this->id = $id;
        $this->texte = $texte;
        $this->utilisateur_id = $utilisateur_id;
        $this->vin_id = $vin_id;
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getTexte() {
        return $this->texte;
    }

    public function getUtilisateurId() {
        return $this->utilisateur_id;
    }

    public function getVinId() {
        return $this->vin_id;
    }

    public function setTexte($texte) {
        $this->texte = $texte;
    }

    public function setUtilisateurId($utilisateur_id) {
        $this->utilisateur_id = $utilisateur_id;
    }

    public function setVinId($vin_id) {
        $this->vin_id = $vin_id;
    }
}
