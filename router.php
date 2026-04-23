<?php

require_once '../controllers/HomeController.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/ContactController.php';
require_once '../controllers/AdminController.php';
require_once '../controllers/AdminProductController.php';
require_once '../controllers/CartController.php';
require_once '../controllers/OrderController.php';
require_once '../controllers/ReviewController.php';
require_once '../controllers/ProductController.php';

$homeController = new HomeController();
$authController = new AuthController();
$contactController = new ContactController();
$adminController = new AdminController();
$adminProductController = new AdminProductController();
$cartController = new CartController();
$orderController = new OrderController();
$reviewController = new ReviewController();
$productController = new ProductController();

$route = $_GET['route'] ?? '';

switch ($route) {
    case '':
        $homeController->home();
        break;

    case 'services':
        $homeController->services();
        break;

    case 'contact':
        $contactController->contact();
        break;

    case 'login':
        $authController->login();
        break;

    case 'register':
        $authController->register();
        break;

    case 'account':
        $authController->account();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'admin-login':
        $adminController->login();
        break;

    case 'admin-dashboard':
        $adminController->dashboard();
        break;

    case 'admin-order-status':
        $adminController->updateOrderStatus();
        break;

    case 'admin-logout':
        $adminController->logout();
        break;

    case 'admin-products':
        $adminProductController->index();
        break;

    case 'admin-product-create':
        $adminProductController->create();
        break;

    case 'admin-product-edit':
        $adminProductController->edit();
        break;

    case 'admin-product-delete':
        $adminProductController->delete();
        break;

    case 'admin-reviews':
        $reviewController->adminIndex();
        break;

    case 'admin-review-status':
        $reviewController->updateStatus();
        break;

    case 'admin-review-delete':
        $reviewController->delete();
        break;

    case 'cart':
        $cartController->index();
        break;

    case 'cart_add':
        $cartController->add();
        break;

    case 'cart_remove':
        $cartController->remove();
        break;

    case 'cart_update':
        $cartController->update();
        break;

    case 'checkout':
        $orderController->checkout();
        break;

    case 'order-confirmation':
        $orderController->confirmation();
        break;

    case 'orders':
        $orderController->index();
        break;

    case 'review-store':
        $reviewController->store();
        break;

    case 'product':
        $productController->show();
        break;

    default:
        echo '404 - Page non trouvée';
        break;
}
