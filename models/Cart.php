<?php

require_once '../config/database.php';

class Cart
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getCartItem(int $userId, int $productId): array|false
    {
        $sql = "SELECT *
                FROM cart_items
                WHERE user_id = :user_id AND product_id = :product_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart(int $userId, int $productId): bool
    {
        $existingItem = $this->getCartItem($userId, $productId);

        if ($existingItem) {
            $sql = "UPDATE cart_items
                    SET quantity = quantity + 1
                    WHERE user_id = :user_id AND product_id = :product_id";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
        }

        $sql = "INSERT INTO cart_items (user_id, product_id, quantity)
                VALUES (:user_id, :product_id, :quantity)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => 1
        ]);
    }

    public function getCartItemsByUser(int $userId): array
    {
        $sql = "SELECT
                    cart_items.id,
                    cart_items.user_id,
                    cart_items.product_id,
                    cart_items.quantity,
                    cart_items.created_at,
                    products.title,
                    products.description,
                    products.price,
                    products.image
                FROM cart_items
                INNER JOIN products ON cart_items.product_id = products.id
                WHERE cart_items.user_id = :user_id
                ORDER BY cart_items.created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeFromCart(int $cartItemId, int $userId): bool
    {
        $sql = "DELETE FROM cart_items
                WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $cartItemId,
            'user_id' => $userId
        ]);
    }

    public function updateQuantity(int $cartItemId, int $userId, int $quantity): bool
    {
        $sql = "UPDATE cart_items
                SET quantity = :quantity
                WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'quantity' => $quantity,
            'id' => $cartItemId,
            'user_id' => $userId
        ]);
    }

    public function getCartTotal(int $userId): float
    {
        $sql = "SELECT SUM(cart_items.quantity * products.price) AS total
                FROM cart_items
                INNER JOIN products ON cart_items.product_id = products.id
                WHERE cart_items.user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (float) ($result['total'] ?? 0);
    }

    public function countCartItemsByUser(int $userId): int
    {
        $sql = "SELECT SUM(quantity) AS total_items
                FROM cart_items
                WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) ($result['total_items'] ?? 0);
    }

    public function clearCartByUser(int $userId): bool
    {
        $sql = "DELETE FROM cart_items
                WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'user_id' => $userId
        ]);
    }

    public function getAllCartsForAdmin(): array
    {
        $sql = "SELECT
                    cart_items.id,
                    cart_items.user_id,
                    cart_items.product_id,
                    cart_items.quantity,
                    cart_items.created_at,
                    users.firstname,
                    users.lastname,
                    users.email,
                    products.title,
                    products.price,
                    products.image
                FROM cart_items
                INNER JOIN users ON cart_items.user_id = users.id
                INNER JOIN products ON cart_items.product_id = products.id
                ORDER BY users.lastname ASC, users.firstname ASC, cart_items.created_at DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGroupedCartsForAdmin(): array
    {
        $cartItems = $this->getAllCartsForAdmin();
        $groupedCarts = [];

        foreach ($cartItems as $item) {
            $userId = (int) $item['user_id'];

            if (!isset($groupedCarts[$userId])) {
                $groupedCarts[$userId] = [
                    'user_id' => $userId,
                    'firstname' => $item['firstname'],
                    'lastname' => $item['lastname'],
                    'email' => $item['email'],
                    'items' => [],
                    'total' => 0
                ];
            }

            $lineTotal = (float) $item['price'] * (int) $item['quantity'];

            $groupedCarts[$userId]['items'][] = [
                'cart_item_id' => (int) $item['id'],
                'product_id' => (int) $item['product_id'],
                'title' => $item['title'],
                'price' => (float) $item['price'],
                'quantity' => (int) $item['quantity'],
                'image' => $item['image'],
                'line_total' => $lineTotal,
                'created_at' => $item['created_at']
            ];

            $groupedCarts[$userId]['total'] += $lineTotal;
        }

        return $groupedCarts;
    }
}