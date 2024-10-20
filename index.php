<?php
session_start(); // Démarrer la session

error_reporting(E_ALL); // Afficher toutes les erreurs
ini_set('display_errors', 1); // Afficher les erreurs à l'écran

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
        header('Location: index.php'); // Rediriger vers la page de connexion après l'inscription
        break;

        case 'login':
            if (isset($_POST['nom']) && isset($_POST['mdp'])) {
                $controller = new UtilisateurController();
                $utilisateur = $controller->readByNom($_POST['nom']); // Assurez-vous d'avoir cette méthode dans le contrôleur
        
                if ($utilisateur && password_verify($_POST['mdp'], $utilisateur['mdp'])) {
                    $_SESSION['utilisateur_id'] = $utilisateur['id']; // Stocker l'ID de l'utilisateur dans la session
                    header('Location: index.php?action=maCave'); // Rediriger vers la cave
                    exit();
                } else {
                    // Gérer les erreurs de connexion (nom ou mot de passe incorrect)
                }
            }
            include 'views/connexion.php'; // Afficher à nouveau le formulaire si non connecté
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
        $controller->create($_POST['texte'], $_SESSION['utilisateur_id'], $_POST['vin_id']); // Assurez-vous que l'utilisateur est connecté
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
        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: index.php'); // Rediriger vers la connexion si non authentifié
            exit();
        }
        $controller = new CaveController();
        $vins = $controller->getVinsByUtilisateur($_SESSION['utilisateur_id']);
        include 'views/ma_cave.php';
        break;

    default:
        include 'views/connexion.php'; // Afficher le formulaire de connexion par défaut
        break;
}
?>
