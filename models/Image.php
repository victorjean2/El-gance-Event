<?php

require_once '../config/database.php';

class Image
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM images ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $filename, string $alt, string $category): bool
    {
        $sql = "INSERT INTO images (filename, alt_text, category)
                VALUES (:filename, :alt, :category)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'filename' => $filename,
            'alt' => $alt,
            'category' => $category
        ]);
    }
}