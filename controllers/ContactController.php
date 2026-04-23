<?php

require_once '../models/Contact.php';

class ContactController
{
    public function contact()
    {
        $errors = [];
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lastname = trim($_POST['nom'] ?? '');
            $firstname = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['telephone'] ?? '');
            $subject = trim($_POST['sujet'] ?? '');
            $message = trim($_POST['message'] ?? '');
            $rgpd = $_POST['rgpd'] ?? null;

            // Champs obligatoires : email + message
            if (empty($email) || empty($message)) {
                $errors[] = "Veuillez remplir les champs obligatoires : email et message.";
            }

            // Validation du format de l'email seulement s'il est renseigné
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse e-mail n'est pas valide.";
            }

            // RGPD obligatoire
            if (!$rgpd) {
                $errors[] = "Vous devez accepter l'utilisation de vos données.";
            }

            if (empty($errors)) {
                $contactModel = new Contact();
                $contactModel->create($lastname, $firstname, $email, $phone, $subject, $message);

                $success = "Votre message a bien été envoyé.";

                // Vider les champs après envoi réussi
                $_POST = [];
            }
        }

        require_once '../views/contact.php';
    }
}