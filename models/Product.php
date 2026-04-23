<?php

require_once '../config/database.php';

class Product
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function create(
        string $title,
        string $description,
        float $price,
        string $category,
        ?string $image,
        int $isPublished
    ): bool {
        $sql = "INSERT INTO products (title, description, price, category, image, is_published)
                VALUES (:title, :description, :price, :category, :image, :is_published)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category' => $category,
            'image' => $image,
            'is_published' => $isPublished
        ]);
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM products ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublishedProducts(): array
    {
        $sql = "SELECT * FROM products WHERE is_published = 1 ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): array|false
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductById(int $id): array|false
    {
        $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(
        int $id,
        string $title,
        string $description,
        float $price,
        string $category,
        ?string $image,
        int $isPublished
    ): bool {
        if ($image !== null) {
            $sql = "UPDATE products
                    SET title = :title,
                        description = :description,
                        price = :price,
                        category = :category,
                        image = :image,
                        is_published = :is_published
                    WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'category' => $category,
                'image' => $image,
                'is_published' => $isPublished
            ]);
        }

        $sql = "UPDATE products
                SET title = :title,
                    description = :description,
                    price = :price,
                    category = :category,
                    is_published = :is_published
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category' => $category,
            'is_published' => $isPublished
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function getPublishedProductById(int $id): array|false
    {
        $sql = "SELECT *
            FROM products
            WHERE id = :id
              AND is_published = 1
            LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
