<?php
session_start(); // Démarrez la session pour utiliser les variables de session

require_once 'controllers/UtilisateurController.php';
require_once 'controllers/CaveController.php';
require_once 'controllers/VinController.php';
require_once 'controllers/CommentairesController.php';

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

// Vérifiez si l'utilisateur est connecté
function checkUserLoggedIn() {
    if (!isset($_SESSION['utilisateur_id'])) {
        header('Location: index.php?action=connexion'); // Redirigez vers la page de connexion
        exit();
    }
}

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
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        include 'views/vin_create_form.php';
        break;

    case 'createVin':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new VinController();
        $controller->create(
            $_POST['nom'], 
            $_POST['annee'], 
            $_POST['couleur'], 
            $_POST['region'], 
            $_POST['type_bouteille'], 
            $_SESSION['utilisateur_id'], // Accès sécurisé
            $_POST['cave_id']
        );
        header('Location: index.php?action=maCave');
        break;

    case 'updateVinForm':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new VinController();
        $data = $controller->read($id);
        include 'views/vin_update_form.php';
        break;

    case 'updateVin':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new VinController();
        $controller->update(
            $id, 
            $_POST['nom'], 
            $_POST['annee'], 
            $_POST['couleur'], 
            $_POST['region'], 
            $_POST['type_bouteille'], 
            $_SESSION['utilisateur_id'], // Accès sécurisé
            $_POST['cave_id']
        );
        header('Location: index.php?action=maCave');
        break;

    case 'deleteVin':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
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
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CommentaireController();
        $controller->create($_POST['texte'], $_SESSION['utilisateur_id'], $_POST['vin_id']);
        header('Location: index.php?action=vinDetails&id=' . $_POST['vin_id']);
        break;

    case 'updateCommentaireForm':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CommentaireController();
        $data = $controller->read($id);
        include 'views/commentaire_update_form.php';
        break;

    case 'updateCommentaire':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CommentaireController();
        $controller->update($id, $_POST['texte'], $_SESSION['utilisateur_id'], $_POST['vin_id']);
        header('Location: index.php?action=vinDetails&id=' . $_POST['vin_id']);
        break;

    case 'deleteCommentaire':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CommentaireController();
        $controller->delete($id);
        header('Location: index.php?action=vinDetails&id=' . $_GET['vin_id']);
        break;

    case 'maCave':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CaveController();
        $data = $controller->getVinsByUtilisateur($_SESSION['utilisateur_id']);
        include 'views/gestionCave.php';
        break;

    case 'createCave':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CaveController();
        $controller->create($_POST['nom'], $_SESSION['utilisateur_id']);
        header('Location: index.php?action=maCave');
        break;

    case 'updateCaveForm':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CaveController();
        $data = $controller->read($id);
        include 'views/cave_update_form.php';
        break;

    case 'updateCave':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
        $controller = new CaveController();
        $controller->update($id, $_POST['nom'], $_SESSION['utilisateur_id']);
        header('Location: index.php?action=maCave');
        break;

    case 'deleteCave':
        checkUserLoggedIn(); // Vérifiez si l'utilisateur est connecté
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
