<?php

require_once '../models/Product.php';
require_once '../models/Review.php';

class ProductController
{
    public function show()
    {
        $productId = (int) ($_GET['id'] ?? 0);

        if ($productId <= 0) {
            echo 'Produit introuvable.';
            exit;
        }

        $productModel = new Product();
        $product = $productModel->getPublishedProductById($productId);

        if (!$product) {
            echo 'Produit introuvable ou non publié.';
            exit;
        }

        $reviewModel = new Review();
        $reviews = $reviewModel->getByProductId($productId);

        require_once '../views/products/show.php';
    }
}