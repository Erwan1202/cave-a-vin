<?php
include_once('bdd.php');
class cave{
    public static function getVins(){
        global $bdd;
        $req = $bdd->query('SELECT * FROM vins');
        return $req;
    }
    public static function getVin($id){
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM vins WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }
    public static function addVin($nom, $annee, $cepage, $region, $description){
        global $bdd;
        $req = $bdd->prepare('INSERT INTO vins(nom, annee, cepage, region, description) VALUES(?, ?, ?, ?, ?)');
        $req->execute(array($nom, $annee, $cepage, $region, $description));
    }
    public static function updateVin($id, $nom, $annee, $cepage, $region, $description){
        global $bdd;
        $req = $bdd->prepare('UPDATE vins SET nom = ?, annee = ?, cepage = ?, region = ?, description = ? WHERE id = ?');
        $req->execute(array($nom, $annee, $cepage, $region, $description, $id));
    }
    public static function deleteVin($id){
        global $bdd;
        $req = $bdd->prepare('DELETE FROM vins WHERE id = ?');
        $req->execute(array($id));
    }
}