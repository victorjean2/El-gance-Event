<?php

require_once  '../models/Review.php';
require_once  '../models/Order.php';

class ReviewController
{
    private Review $reviewModel;
    private Order $orderModel;

    public function __construct()
    {
        $this->reviewModel = new Review();
        $this->orderModel = new Order();
    }

    public function store()
    {
        if (empty($_SESSION['user'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $userName = $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'];

        $productId = (int) $_POST['product_id'];
        $rating = (int) $_POST['rating'];
        $comment = trim($_POST['comment']);

        $errors = [];

        if ($rating < 1 || $rating > 5) {
            $errors[] = "Note invalide.";
        }

        if (strlen($comment) < 10) {
            $errors[] = "Commentaire trop court.";
        }

        $order = $this->orderModel->userHasOrderedProduct($userId, $productId);

        if (!$order) {
            $errors[] = "Vous devez avoir commandé ce produit.";
        }

        if ($this->reviewModel->hasUserReviewed($userId, $productId)) {
            $errors[] = "Vous avez déjà laissé un avis.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors; 
            var_dump($errors);die;
            header('Location: index.php?route=services');
            exit;
        }

        $this->reviewModel->create([
            'user_id' => $userId,
            'user_name' => $userName,
            'product_id' => $productId,
            'order_id' => $order['id'],
            'rating' => $rating,
            'comment' => htmlspecialchars($comment)
        ]);

        $_SESSION['success'] = "Avis envoyé !";
        header('Location: index.php?route=services');
    }

    public function adminIndex()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?route=admin_login');
            exit;
        }

        $reviews = $this->reviewModel->getAll();
        require __DIR__ . '/../views/admin/reviews/index.php';
    }

    public function updateStatus()
    {
        $this->reviewModel->updateStatus($_GET['id'], $_GET['status']);
        header('Location: index.php?route=admin_reviews');
    }

    public function delete()
    {
        $this->reviewModel->delete($_GET['id']);
        header('Location: index.php?route=admin_reviews');
    }
}