<?php

require_once '../config/database.php';

class Admin
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function findByEmail(string $email)
    {
        $sql = "SELECT * FROM admins WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(string $lastname, string $firstname, string $email, string $password): bool
    {
        $sql = "INSERT INTO admins (lastname, firstname, email, password)
                VALUES (:lastname, :firstname, :email, :password)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'password' => $password
        ]);
    }
}