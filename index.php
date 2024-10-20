<?php
session_start(); // Démarrez la session pour utiliser les variables de session

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
    case 'login':
        $controller = new UtilisateurController();
        $controller->login($_POST['nom'], $_POST['mdp']);
        break;
    case 'createVinForm':
        include 'views/vin_create_form.php';
        break;
    case 'createVin':
        $controller = new VinController();
        $controller->create($_POST['nom'], $_POST['annee'], $_POST['couleur'], $_POST['region'], $_POST['type_bouteille'], $_POST['utilisateur_id'], $_POST['cave_id']);
        header('Location: index.php?action=maCave');
        break;
    case 'updateVinFormid':
        $controller = new VinController();
        $data = $controller->read($id);
        include 'views/vin_update_form.php';
        break;
    case 'updateVin':
        $controller = new VinController();
        $controller->update($id, $_POST['nom'], $_POST['annee'], $_POST['couleur'], $_POST['region'], $_POST['type_bouteille'], $_POST['utilisateur_id'], $_POST['cave_id']);
        header('Location: index.php?action=maCave');
        break;
    case 'deleteVin':
        $controller = new VinController();
        $controller->delete($id);
        header('Location: index.php?action=maCave');
        break;
    case 'vinDetails':
        $controller = new VinController();
        $vin = $controller->read($id);
        $commentaireController = new CommentaireController();
        $commentaires = $commentaireController->readByVin($id);
        include 'views/vin_details.php';
        break;
    case 'createCommentaire':
        $controller = new CommentaireController();
        $controller->create($_POST['texte'], $_SESSION['utilisateur_id'], $_POST['vin_id']);
        header('Location: index.php?action=vinDetails&id=' . $_POST['vin_id']);
        break;
    case 'updateCommentaireForm':
        $controller = new CommentaireController();
        $data = $controller->read($id);
        include 'views/commentaire_update_form.php';
        break;
    case 'updateCommentaire':
        $controller = new CommentaireController();
        $controller->update($id, $_POST['texte'], $_SESSION['utilisateur_id'], $_POST['vin_id']);
        header('Location: index.php?action=vinDetails&id=' . $_POST['vin_id']);
        break;
    case 'deleteCommentaire':
        $controller = new CommentaireController();
        $controller->delete($id);
        header('Location: index.php?action=vinDetails&id=' . $_GET['vin_id']);
        break;

    case 'login':
        $controller = new UtilisateurController();
        $controller->login($_POST['nom'], $_POST['mdp']);
        break;

    case 'maCave':
        $controller = new CaveController();
        $data = $controller->getVinsByUtilisateur($_SESSION['utilisateur_id']);
        include 'views/gestionCave.php';
        break;
    case 'createCave':
        $controller = new CaveController();
        $controller->create($_POST['nom'], $_SESSION['utilisateur_id']);
        header('Location: index.php?action=maCave');
        break;
    case 'updateCaveForm':
        $controller = new CaveController();
        $data = $controller->read($id);
        include 'views/cave_update_form.php';
        break;
    case 'updateCave':
        $controller = new CaveController();
        $controller->update($id, $_POST['nom'], $_SESSION['utilisateur_id']);
        header('Location: index.php?action=maCave');
        break;
    case 'deleteCave':
        $controller = new CaveController();
        $controller->delete($id);
        header('Location: index.php?action=maCave');
        break;
     
        
    case 'inscription':
        include 'views/inscription.php';
        break;

    case 'deconnexion':
        session_destroy(); // Détruisez la session
        header('Location: index.php?action=connexion');
        break;
    default:
        include 'views/connexion.php';
        break;
}
?>
