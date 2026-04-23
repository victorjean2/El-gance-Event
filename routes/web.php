<?php

require_once '../app/controllers/HomeController.php';

$controller = new HomeController();

$route = $_GET['route'] ?? '';

switch ($route) {
    case '':
        $controller->home();
        break;

    case 'services':
        $controller->services();
        break;

    case 'contact':
        $controller->contact();
        break;

    case 'login':
        $controller->login();
        break;

    default:
        echo '404 - Page non trouvée';
        break;
}