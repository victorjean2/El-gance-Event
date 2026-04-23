<?php

require_once '../models/Admin.php';
require_once '../models/Contact.php';
require_once '../models/Order.php';
require_once '../models/Review.php';
require_once '../config/functions.php';

class AdminController
{
    public function login()
    {
        if (!empty($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/index.php?route=admin-dashboard');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($email === '' || $password === '') {
                $errors[] = "Veuillez remplir tous les champs.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse e-mail n'est pas valide.";
            } else {
                $adminModel = new Admin();
                $admin = $adminModel->findByEmail($email);

                if (!$admin || !password_verify($password, $admin['password'])) {
                    $errors[] = "Identifiants administrateur incorrects.";
                } else {
                    $_SESSION['admin'] = [
                        'id' => $admin['id'],
                        'lastname' => $admin['lastname'],
                        'firstname' => $admin['firstname'],
                        'email' => $admin['email']
                    ];

                    header('Location: ' . BASE_URL . '/index.php?route=admin-dashboard');
                    exit;
                }
            }
        }

        require_once '../views/admin/login.php';
    }

    public function dashboard()
    {
        $this->checkAdminAuth();

        $contactModel = new Contact();
        $contacts = $contactModel->getAll();

        $orderModel = new Order();
        $adminOrders = $orderModel->getAllOrdersWithItemsForAdmin();

        $reviewModel = new Review();
        $reviews = $reviewModel->getAll();
        $pendingReviewsCount = 0;

        foreach ($reviews as $review) {
            if (($review['status'] ?? '') === 'pending') {
                $pendingReviewsCount++;
            }
        }

        require_once '../views/admin/dashboard.php';
    }

    public function updateOrderStatus()
    {
        $this->checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?route=admin-dashboard');
            exit;
        }

        $orderId = (int) ($_POST['order_id'] ?? 0);
        $status = trim($_POST['status'] ?? '');

        $allowedStatuses = [
            'en attente',
            'validée',
            'en préparation',
            'expédiée',
            'annulée'
        ];

        if ($orderId <= 0 || $status === '' || !in_array($status, $allowedStatuses, true)) {
            header('Location: ' . BASE_URL . '/index.php?route=admin-dashboard');
            exit;
        }

        $orderModel = new Order();
        $orderModel->updateStatus($orderId, $status);

        header('Location: ' . BASE_URL . '/index.php?route=admin-dashboard');
        exit;
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        header('Location: ' . BASE_URL . '/index.php?route=admin-login');
        exit;
    }

    private function checkAdminAuth(): void
    {
        if (empty($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/index.php?route=admin-login');
            exit;
        }
    }
}