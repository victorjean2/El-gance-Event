<?php

require_once '../config/database.php';

class Contact
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function create(
        string $lastname,
        string $firstname,
        string $email,
        string $phone,
        string $subject,
        string $message
    ): bool {
        $sql = "INSERT INTO contacts (lastname, firstname, email, phone, subject, message)
                VALUES (:lastname, :firstname, :email, :phone, :subject, :message)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message
        ]);
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}