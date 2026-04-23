<?php

require_once '../config/mongodb.php';

use MongoDB\BSON\ObjectId;

class Review
{
    private $collection;

    public function __construct()
    {
        $db = MongoConnection::getDatabase();
        $this->collection = $db->reviews;
    }

    public function create(array $data): bool
    {
        $review = [
            'user_id' => (int) $data['user_id'],
            'user_name' => $data['user_name'],
            'product_id' => (int) $data['product_id'],
            'order_id' => (int) $data['order_id'],
            'rating' => (int) $data['rating'],
            'comment' => $data['comment'],
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->collection->insertOne($review);

        return $result->getInsertedCount() > 0;
    }

    public function getByProductId(int $productId): array
    {
        return $this->collection->find(
            [
                'product_id' => $productId,
                'status' => 'published'
            ],
            ['sort' => ['created_at' => -1]]
        )->toArray();
    }

    public function getAll(): array
    {
        return $this->collection->find([], [
            'sort' => ['created_at' => -1]
        ])->toArray();
    }

    public function updateStatus(string $id, string $status): bool
    {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['status' => $status]]
        );

        return $result->getModifiedCount() > 0;
    }

    public function delete(string $id): bool
    {
        $result = $this->collection->deleteOne([
            '_id' => new ObjectId($id)
        ]);

        return $result->getDeletedCount() > 0;
    }

    public function hasUserReviewed(int $userId, int $productId): bool
    {
        $review = $this->collection->findOne([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return $review !== null;
    }
}