<?php
require_once 'controllers/UtilisateurController.php';
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
        // Ajoutez ici la logique de connexion
        break;
    case 'createVinForm':
        include 'views/vin_create_form.php';
        break;
    case 'createVin':
        $controller = new VinController();
        $controller->create($_POST['nom'], $_POST['annee'], $_POST['couleur'], $_POST['region'], $_POST['type_bouteille'], $_POST['utilisateur_id'], $_POST['cave_id']);
        header('Location: index.php?action=maCave');
        break;
    case 'updateVinForm':
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
        $controller->create($_POST['texte'], $_POST['utilisateur_id'], $_POST['vin_id']);
        header('Location: index.php?action=vinDetails&id=' . $_POST['vin_id']);
        break;
    case 'updateCommentaireForm':
        $controller = new CommentaireController();
        $data = $controller->read($id);
        include 'views/commentaire_update_form.php';
        break;
    case 'updateCommentaire':
        $controller = new CommentaireController();
        $controller->update($id, $_POST['texte'], $_POST['utilisateur_id'], $_POST['vin_id']);
        header('Location: index.php?action=vinDetails&id=' . $_POST['vin_id']);
        break;
    case 'deleteCommentaire':
        $controller = new CommentaireController();
        $controller->delete($id);
        header('Location: index.php?action=vinDetails&id=' . $_GET['vin_id']);
        break;
    case 'maCave':
        $controller = new CaveController();
        $vins = $controller->getVinsByUtilisateur($_SESSION['utilisateur_id']);
        $commentaireController = new CommentaireController();
        $commentaires = $commentaireController->getCommentairesByUtilisateur($_SESSION['utilisateur_id']);
        include 'views/ma_cave.php';
        break;
    default:
        include 'views/connexion.php';
        break;
}
?>
