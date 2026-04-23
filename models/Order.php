<?php

require_once '../config/database.php';

class Order
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function createOrder(
        int $userId,
        array $cartItems,
        ?string $eventDate,
        string $deliveryDatetime,
        string $returnDatetime
    ): int|false {
        if (empty($cartItems)) {
            return false;
        }

        try {
            $this->pdo->beginTransaction();

            $totalAmount = 0;

            foreach ($cartItems as $item) {
                $price = (float) $item['price'];
                $quantity = (int) $item['quantity'];
                $totalAmount += $price * $quantity;
            }

            $sqlOrder = "INSERT INTO orders (
                            user_id,
                            event_date,
                            delivery_datetime,
                            return_datetime,
                            total_amount,
                            status
                         ) VALUES (
                            :user_id,
                            :event_date,
                            :delivery_datetime,
                            :return_datetime,
                            :total_amount,
                            :status
                         )";

            $stmtOrder = $this->pdo->prepare($sqlOrder);
            $stmtOrder->execute([
                'user_id' => $userId,
                'event_date' => $eventDate ?: null,
                'delivery_datetime' => $deliveryDatetime,
                'return_datetime' => $returnDatetime,
                'total_amount' => $totalAmount,
                'status' => 'en attente'
            ]);

            $orderId = (int) $this->pdo->lastInsertId();

            $sqlItem = "INSERT INTO order_items (
                            order_id,
                            product_id,
                            product_title,
                            product_price,
                            quantity,
                            line_total
                        ) VALUES (
                            :order_id,
                            :product_id,
                            :product_title,
                            :product_price,
                            :quantity,
                            :line_total
                        )";

            $stmtItem = $this->pdo->prepare($sqlItem);

            foreach ($cartItems as $item) {
                $price = (float) $item['price'];
                $quantity = (int) $item['quantity'];
                $lineTotal = $price * $quantity;

                $stmtItem->execute([
                    'order_id' => $orderId,
                    'product_id' => (int) $item['product_id'],
                    'product_title' => $item['title'],
                    'product_price' => $price,
                    'quantity' => $quantity,
                    'line_total' => $lineTotal
                ]);
            }

            $this->pdo->commit();

            return $orderId;
        } catch (Exception $e) {
    $this->pdo->rollBack();
    die('Erreur createOrder : ' . $e->getMessage());
}
    }

    public function getOrdersByUser(int $userId): array
    {
        $sql = "SELECT *
                FROM orders
                WHERE user_id = :user_id
                ORDER BY created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById(int $orderId, int $userId): array|false
    {
        $sql = "SELECT *
                FROM orders
                WHERE id = :id
                  AND user_id = :user_id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $orderId,
            'user_id' => $userId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItemsByOrder(int $orderId): array
    {
        $sql = "SELECT *
                FROM order_items
                WHERE order_id = :order_id
                ORDER BY id ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'order_id' => $orderId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrdersForAdmin(): array
    {
        $sql = "SELECT
                    orders.*,
                    users.firstname,
                    users.lastname,
                    users.email
                FROM orders
                INNER JOIN users ON orders.user_id = users.id
                ORDER BY orders.created_at DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrdersWithItemsForAdmin(): array
    {
        $orders = $this->getAllOrdersForAdmin();

        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItemsByOrder((int) $order['id']);
        }

        return $orders;
    }

    public function updateStatus(int $orderId, string $status): bool
    {
        $allowedStatuses = [
            'en attente',
            'validée',
            'en préparation',
            'expédiée',
            'annulée'
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            return false;
        }

        $sql = "UPDATE orders
                SET status = :status
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'status' => $status,
            'id' => $orderId
        ]);
    }

    public function userHasOrderedProduct(int $userId, int $productId): array|false
    {
        $sql = "SELECT o.id
                FROM orders o
                INNER JOIN order_items oi ON oi.order_id = o.id
                WHERE o.user_id = :user_id
                  AND oi.product_id = :product_id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrdersWithItemsByUser(int $userId): array
    {
        $orders = $this->getOrdersByUser($userId);

        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItemsByOrder((int) $order['id']);
        }

        return $orders;
    }
}