<?php
require_once 'controllers/UtilisateurContoller.php';
require_once 'controllers/CaveController.php';
require_once 'controllers/VinController.php';
require_once 'controllers/CommentairesController.php';

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

        $controller->delete($id);
        break;
    case 'createVin':
        $controller = new VinController();
        $controller->create($_POST['nom'], $_POST['annee'], $_POST['couleur'], $_POST['region'], $_POST['type_bouteille'], $_POST['utilisateur_id'], $_POST['cave_id']);
        break;
    case 'readVin':
        $controller = new VinController();
        $data = $controller->read($id);
        break;
    case 'updateVin':
        $controller = new VinController();
        $controller->update($id, $_POST['nom'], $_POST['annee'], $_POST['couleur'], $_POST['region'], $_POST['type_bouteille'], $_POST['utilisateur_id'], $_POST['cave_id']);
        break;
    case 'deleteVin':
        $controller = new VinController();
        $controller->delete($id);
        break;
    case 'createCommentaire':
        $controller = new CommentaireController();
        $controller->create($_POST['texte'], $_POST['vin_id'], $_POST['utilisateur_id']);
        break;
    case 'readCommentaire':
        $controller = new CommentaireController();
        $data = $controller->read($id);
        break;
    case 'updateCommentaire':
        $controller = new CommentaireController();
        $controller->update($id, $_POST['texte'], $_POST['vin_id'], $_POST['utilisateur_id']);
        break;
    case 'deleteCommentaire':
        $controller = new CommentaireController();
        $controller->delete($id);
        break;
    default:
        echo 'Action inconnue';
        break;
}