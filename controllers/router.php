<?php
require_once 'controllers/UtilisateurController.php';
require_once 'controllers/CaveController.php';
require_once 'controllers/VinController.php';
require_once 'controllers/CommentaireController.php';

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'createUtilisateur':
        $controller = new UtilisateurController();
        $controller->create($_POST['nom'], $_POST['mdp']);
        break;
    case 'readUtilisateur':
        $controller = new UtilisateurController();
        $data = $controller->read($id);
        break;
    case 'updateUtilisateur':
        $controller = new UtilisateurController();
        $controller->update($id, $_POST['nom'], $_POST['mdp']);
        break;
    case 'deleteUtilisateur':
        $controller = new UtilisateurController();
        $controller->delete($id);
        break;
    case 'createCave':
        $controller = new CaveController();
        $controller->create($_POST['nom'], $_POST['utilisateur_id']);
        break;
    case 'readCave':
        $controller = new CaveController();
        $data = $controller->read($id);
        break;
    case 'updateCave':
        $controller = new CaveController();
        $controller->update($id, $_POST['nom'], $_POST['utilisateur_id']);
        break;
    case 'deleteCave':
        $controller = new CaveController();
