<?php

require_once '../models/Product.php';
require_once '../models/Review.php';

class HomeController
{
    public function home()
    {
        require_once '../views/home.php';
    }

    public function services()
    {
        $productModel = new Product();
        $reviewModel = new Review();

        $products = $productModel->getPublishedProducts();

        foreach ($products as &$product) {
            $product['reviews'] = $reviewModel->getByProductId((int) $product['id']);
        }

        require_once '../views/services.php';
    }
}