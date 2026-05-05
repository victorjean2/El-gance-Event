<?php

require_once '../models/Product.php';

class AdminProductController
{
    public function index()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/index.php?route=admin-login');
            exit;
        }

        $productModel = new Product();
        $products = $productModel->getAll();

        require_once '../views/admin/products/index.php';
    }

    public function create()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/index.php?route=admin-login');
            exit;
        }

        $errors = [];
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $isPublished = isset($_POST['is_published']) ? 1 : 0;
            $imageName = null;

            if (empty($title) || empty($description) || empty($price) || empty($category)) {
                $errors[] = "Veuillez remplir tous les champs obligatoires.";
            }

            if (!is_numeric($price)) {
                $errors[] = "Le prix doit être un nombre valide.";
            }

            if (!empty($_FILES['image']['name'])) {
                $file = $_FILES['image'];

                if ($file['error'] === UPLOAD_ERR_OK) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

                    if (!in_array($file['type'], $allowedTypes)) {
                        $errors[] = "Seuls les formats JPG, PNG et WEBP sont autorisés.";
                    } else {
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        $imageName = time() . '_' . uniqid() . '.' . $extension;

                        $uploadDirectory = '../public_html/uploads/';
                        $targetPath = $uploadDirectory . $imageName;

                        if (!is_dir($uploadDirectory)) {
                            $errors[] = "Le dossier d'upload n'existe pas.";
                        } elseif (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                            $errors[] = "Erreur lors du téléchargement de l'image.";
                        }
                    }
                } else {
                    $errors[] = "Erreur lors du chargement du fichier.";
                }
            }

            if (empty($errors)) {
                $productModel = new Product();

                $isCreated = $productModel->create(
                    $title,
                    $description,
                    (float)$price,
                    $category,
                    $imageName,
                    $isPublished
                );

                if ($isCreated) {
                    header('Location: ' . BASE_URL . '/index.php?route=admin-products');
                    exit;
                } else {
                    $errors[] = "Une erreur est survenue lors de l'ajout du produit.";
                }
            }
        }

        require_once '../views/admin/products/create.php';
    }

    public function edit()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/index.php?route=admin-login');
            exit;
        }

        $id = (int)($_GET['id'] ?? 0);

        $productModel = new Product();
        $product = $productModel->findById($id);

        if (!$product) {
            echo "Produit introuvable.";
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $isPublished = isset($_POST['is_published']) ? 1 : 0;
            $imageName = null;

            if (empty($title) || empty($description) || empty($price) || empty($category)) {
                $errors[] = "Veuillez remplir tous les champs obligatoires.";
            }

            if (!is_numeric($price)) {
                $errors[] = "Le prix doit être un nombre valide.";
            }

            if (!empty($_FILES['image']['name'])) {
                $file = $_FILES['image'];

                if ($file['error'] === UPLOAD_ERR_OK) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

                    if (!in_array($file['type'], $allowedTypes)) {
                        $errors[] = "Seuls les formats JPG, PNG et WEBP sont autorisés.";
                    } else {
                        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        $imageName = time() . '_' . uniqid() . '.' . $extension;

                        $uploadDirectory = '../public_html/uploads/';
                        $targetPath = $uploadDirectory . $imageName;

                        if (!is_dir($uploadDirectory)) {
                            $errors[] = "Le dossier d'upload n'existe pas.";
                        } elseif (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                            $errors[] = "Erreur lors du téléchargement de l'image.";
                        }
                    }
                } else {
                    $errors[] = "Erreur lors du chargement du fichier.";
                }
            }

            if (empty($errors)) {
                $isUpdated = $productModel->update(
                    $id,
                    $title,
                    $description,
                    (float)$price,
                    $category,
                    $imageName,
                    $isPublished
                );

                if ($isUpdated) {
                    header('Location: ' . BASE_URL . '/index.php?route=admin-products');
                    exit;
                } else {
                    $errors[] = "Une erreur est survenue lors de la modification du produit.";
                }
            }
        }

        require_once '../views/admin/products/edit.php';
    }

    public function delete()
    {
        if (empty($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/index.php?route=admin-login');
            exit;
        }

        $id = (int)($_GET['id'] ?? 0);

        $productModel = new Product();
        $product = $productModel->findById($id);

        if (!$product) {
            echo "Produit introuvable.";
            exit;
        }

        $productModel->delete($id);

        header('Location: ' . BASE_URL . '/index.php?route=admin-products');
        exit;
    }
}