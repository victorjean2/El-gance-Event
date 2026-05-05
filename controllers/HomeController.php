<?php

require_once '../models/Product.php';
require_once '../models/Review.php';

class HomeController
{
    public function home()
    {
        $productModel = new Product();

        // Catégories dynamiques affichées sur la page d'accueil
        $categories = $productModel->getPublishedCategories();

        require_once '../views/home.php';
    }

    public function services()
    {
        $productModel = new Product();
        $reviewModel = new Review();

        // Catégorie envoyée dans l'URL : index.php?route=services&category=Mobilier
        $selectedCategory = trim($_GET['category'] ?? '');

        if ($selectedCategory !== '') {
            $products = $productModel->getPublishedProductsByCategory($selectedCategory);
        } else {
            $products = $productModel->getPublishedProducts();
        }

        // Liste des catégories pour affichage éventuel sur la page services
        $categories = $productModel->getPublishedCategories();

        // Ajout des avis publiés pour chaque produit
        foreach ($products as &$product) {
            $product['reviews'] = $reviewModel->getByProductId((int) $product['id']);
        }

        require_once '../views/services.php';
    }
}