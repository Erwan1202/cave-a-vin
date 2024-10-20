<?php

class Bdd {
    private static $instance = null;

    private function __construct() {}

    public static function connexion() {
        if (self::$instance === null) {
            try {
                // Remplacer 'bd' par le nom correct de la base de données
                self::$instance = new PDO('mysql:host=localhost;dbname=cave_a_vin;charset=utf8', 'root', '');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

$bdd = Bdd::connexion();
