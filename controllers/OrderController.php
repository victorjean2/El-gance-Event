<?php

require_once '../models/Order.php';
require_once '../models/Cart.php';
require_once '../config/functions.php';

class OrderController
{
    public function checkout()
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['cart_error'] = "Vous devez être connecté pour valider votre panier.";
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?route=cart');
            exit;
        }

        $userId = (int) $_SESSION['user']['id'];

        $cartModel = new Cart();
        $cartItems = $cartModel->getCartItemsByUser($userId);

        if (empty($cartItems)) {
            $_SESSION['cart_error'] = "Votre panier est vide.";
            header('Location: ' . BASE_URL . '/index.php?route=cart');
            exit;
        }

        $eventDate = trim($_POST['event_date'] ?? '');
        $deliveryDatetime = trim($_POST['delivery_datetime'] ?? '');
        $returnDatetime = trim($_POST['return_datetime'] ?? '');

        $errors = [];

        if ($deliveryDatetime === '') {
            $errors[] = "La date et l'heure de livraison sont obligatoires.";
        }

        if ($returnDatetime === '') {
            $errors[] = "La date et l'heure de retour sont obligatoires.";
        }

        if ($deliveryDatetime !== '' && $returnDatetime !== '') {
            $deliveryTimestamp = strtotime($deliveryDatetime);
            $returnTimestamp = strtotime($returnDatetime);

            if ($deliveryTimestamp === false || $returnTimestamp === false) {
                $errors[] = "Les dates saisies sont invalides.";
            } elseif ($returnTimestamp <= $deliveryTimestamp) {
                $errors[] = "La date de retour doit être postérieure à la date de livraison.";
            }
        }

        if (!empty($eventDate)) {
            $eventTimestamp = strtotime($eventDate);
            if ($eventTimestamp === false) {
                $errors[] = "La date de l'événement est invalide.";
            }
        }

        if (!empty($errors)) {
            $_SESSION['cart_error'] = implode(' ', $errors);
            header('Location: ' . BASE_URL . '/index.php?route=cart');
            exit;
        }

        $orderModel = new Order();

        $orderId = $orderModel->createOrder(
            $userId,
            $cartItems,
            $eventDate !== '' ? $eventDate : null,
            $deliveryDatetime,
            $returnDatetime
        );

        if ($orderId === false) {
            $_SESSION['cart_error'] = "Une erreur est survenue lors de la validation de votre commande.";
            header('Location: ' . BASE_URL . '/index.php?route=cart');
            exit;
        }

        $cartModel->clearCartByUser($userId);

        $_SESSION['last_order_id'] = $orderId;
        $_SESSION['cart_success'] = "Votre commande a bien été enregistrée.";

        header('Location: ' . BASE_URL . '/index.php?route=order-confirmation');
        exit;
    }

    public function confirmation()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        $orderId = (int) ($_SESSION['last_order_id'] ?? 0);

        if ($orderId <= 0) {
            header('Location: ' . BASE_URL . '/index.php?route=orders');
            exit;
        }

        $userId = (int) $_SESSION['user']['id'];

        $orderModel = new Order();
        $order = $orderModel->getOrderById($orderId, $userId);

        if (!$order) {
            $_SESSION['cart_error'] = "Commande introuvable.";
            header('Location: ' . BASE_URL . '/index.php?route=orders');
            exit;
        }

        $orderItems = $orderModel->getOrderItemsByOrder($orderId);

        require_once '../views/orders/confirmation.php';
    }

    public function index()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        $userId = (int) $_SESSION['user']['id'];

        $orderModel = new Order();
        $orders = $orderModel->getOrdersWithItemsByUser($userId);

        require_once '../views/orders/index.php';
    }
}