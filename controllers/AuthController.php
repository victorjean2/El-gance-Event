<?php

require_once '../models/User.php';
require_once '../config/functions.php';

class AuthController
{
    public function register()
    {
        if (!empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=account');
            exit;
        }

        $errors = [];
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lastname = trim($_POST['lastname'] ?? '');
            $firstname = trim($_POST['firstname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            

            if (empty($lastname) || empty($firstname) || empty($email) || empty($password)) {
                $errors[] = "Tous les champs sont obligatoires.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse e-mail n'est pas valide.";
            }

            $passwordErrors = validatePassword($password);
            $errors = array_merge($errors, $passwordErrors);
            

            $userModel = new User();

            if ($userModel->emailExists($email)) {
                $errors[] = "Cette adresse e-mail est déjà utilisée.";
            }

            if (empty($errors)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $isCreated = $userModel->create($lastname, $firstname, $email, $hashedPassword);

                if ($isCreated) {
                    $success = "Votre compte a été créé avec succès.";
                    $_POST = [];
                } else {
                    $errors[] = "Une erreur est survenue lors de l'inscription.";
                }
            }
        }

        require_once '../views/register.php';
    }

    public function login()
    {
        if (!empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=account');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $errors[] = "Veuillez remplir tous les champs.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse e-mail n'est pas valide.";
            } else {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if (!$user) {
                    $errors[] = "Identifiants incorrects.";
                } elseif (!password_verify($password, $user['password'])) {
                    $errors[] = "Identifiants incorrects.";
                } else {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'lastname' => $user['lastname'],
                        'firstname' => $user['firstname'],
                        'email' => $user['email']
                    ];

                    header('Location: ' . BASE_URL . '/index.php?route=account');
                    exit;
                }
            }
        }

        require_once '../views/login.php';
    }

    public function account()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/index.php?route=login');
            exit;
        }

        require_once '../views/account.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);

        header('Location: ' . BASE_URL . '/index.php?route=login');
        exit;
    }
}