<?php

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';

switch ($page) {
    case 'inscription':
        include 'controllers/inscription.php';
        break;
    
    case 'connexion':
        include 'controllers/connexion.php';
        break;
    
    case 'home':
        include 'controllers/home.php';
        break;
    
    case 'logout':
        include 'controllers/logout.php';
        break;
    
    default:
        include 'controllers/home.php';
        break;
    

}