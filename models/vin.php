<?php

class Vin {
    private $id;
    private $nom;
    private $annee;
    private $couleur;
    private $region;
    private $type_bouteille;
    private $utilisateur_id;
    private $cave_id;

    public function __construct($id, $nom, $annee, $couleur, $region, $type_bouteille, $utilisateur_id, $cave_id) {
        $this->id = $id;
        $this->nom = $nom;
        $this->annee = $annee;
        $this->couleur = $couleur;
        $this->region = $region;
        $this->type_bouteille = $type_bouteille;
        $this->utilisateur_id = $utilisateur_id;
        $this->cave_id = $cave_id;
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function getCouleur() {
        return $this->couleur;
    }

    public function getRegion() {
        return $this->region;
    }

    public function getTypeBouteille() {
        return $this->type_bouteille;
    }

    public function getUtilisateurId() {
        return $this->utilisateur_id;
    }

    public function getCaveId() {
        return $this->cave_id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setAnnee($annee) {
        $this->annee = $annee;
    }

    public function setCouleur($couleur) {
        $this->couleur = $couleur;
    }

    public function setRegion($region) {
        $this->region = $region;
    }

    public function setTypeBouteille($type_bouteille) {
        $this->type_bouteille = $type_bouteille;
    }

    public function setUtilisateurId($utilisateur_id) {
        $this->utilisateur_id = $utilisateur_id;
    }

    public function setCaveId($cave_id) {
        $this->cave_id = $cave_id;
    }
}
