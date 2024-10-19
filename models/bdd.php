<?php

class bdd{
    public static function connexion(){
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=bd;charset=utf8', 'root', '');
            return $bdd;
        }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
    
}

$bdd = bdd::connexion();