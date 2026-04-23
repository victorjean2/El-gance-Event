<?php

require_once '../models/Cart.php';
require_once '../models/Product.php';

class CartController
{
    public function add()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?route=services');
            exit;
        }

        $productId = (int) ($_POST['product_id'] ?? 0);
        $userId = (int) $_SESSION['user']['id'];

        if ($productId <= 0) {
            header('Location: ' . BASE_URL . '/index.php?route=services');
            exit;
        }

        $productModel = new Product();
        $product = $productModel->getProductById($productId);

        if (!$product || (int)$product['is_published'] !== 1) {
            header('Location: ' . BASE_URL . '/index.php?route=services');
            exit;
        }

        $cartModel = new Cart();
        $cartModel->addToCart($userId, $productId);

        header('Location: ' . BASE_URL . '/index.php?route=cart');
        exit;
    }

    public function index()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        $userId = (int) $_SESSION['user']['id'];

        $cartModel = new Cart();
        $cartItems = $cartModel->getCartItemsByUser($userId);
        $total = $cartModel->getCartTotal($userId);

        require_once '../views/cart.php';
    }

    public function remove()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?route=cart');
            exit;
        }

        $cartItemId = (int) ($_POST['cart_item_id'] ?? 0);
        $userId = (int) $_SESSION['user']['id'];

        if ($cartItemId > 0) {
            $cartModel = new Cart();
            $cartModel->removeFromCart($cartItemId, $userId);
        }

        header('Location: ' . BASE_URL . '/index.php?route=cart');
        exit;
    }

    public function update()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?route=cart');
            exit;
        }

        $cartItemId = (int) ($_POST['cart_item_id'] ?? 0);
        $quantity = (int) ($_POST['quantity'] ?? 1);
        $userId = (int) $_SESSION['user']['id'];

        if ($cartItemId > 0) {
            $cartModel = new Cart();

            if ($quantity <= 0) {
                $cartModel->removeFromCart($cartItemId, $userId);
            } else {
                $cartModel->updateQuantity($cartItemId, $userId, $quantity);
            }
        }

        header('Location: ' . BASE_URL . '/index.php?route=cart');
        exit;
    }
}
