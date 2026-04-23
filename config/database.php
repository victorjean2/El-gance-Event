<?php

class Database
{
    private string $host = 'database';
    private string $dbname = 'exemplepdo';
    private string $username = 'app';
    private string $password = 'azerty';

    public function getConnection(): PDO
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}