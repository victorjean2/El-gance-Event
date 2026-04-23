<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des avis - Élégance Event</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin-reviews.css">
</head>

<body>

<header class="admin-header">
    <div class="container admin-header-content">
        <a href="<?= BASE_URL ?>/index.php" class="admin-logo">Élégance Event</a>

        <nav class="admin-nav">
            <ul class="admin-nav-list">
                <li><a href="<?= BASE_URL ?>/index.php?route=admin-dashboard">Dashboard</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?route=admin-products">Produits</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?route=admin-reviews" class="active">Avis client</a></li>
                <li><a href="<?= BASE_URL ?>/index.php">Voir le site</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?route=admin-logout">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="admin-reviews-page">
    <div class="container">

        <h1>Gestion des avis clients</h1>

        <?php if (empty($reviews)): ?>
            <p class="empty-message">Aucun avis trouvé.</p>
        <?php else: ?>

            <div class="table-wrapper">
                <table class="reviews-table">
                    <thead>
                        <tr>
                            <th>Auteur</th>
                            <th>Produit</th>
                            <th>Commande</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($reviews as $review): ?>

                            <?php
                                $status = $review['status'] ?? 'pending';
                                $statusClass = match ($status) {
                                    'published' => 'status-published',
                                    'refused' => 'status-refused',
                                    default => 'status-pending'
                                };
                            ?>

                            <tr>
                                <td><?= htmlspecialchars($review['user_name'] ?? '') ?></td>
                                <td>#<?= (int) ($review['product_id'] ?? 0) ?></td>
                                <td>#<?= (int) ($review['order_id'] ?? 0) ?></td>

                                <td class="rating">
                                    <?= (int) ($review['rating'] ?? 0) ?>/5
                                </td>

                                <td class="comment">
                                    <?= htmlspecialchars($review['comment'] ?? '') ?>
                                </td>

                                <td>
                                    <span class="status-badge <?= $statusClass ?>">
                                        <?= htmlspecialchars($status) ?>
                                    </span>
                                </td>

                                <td><?= htmlspecialchars($review['created_at'] ?? '') ?></td>

                                <td class="actions">
                                    <a class="btn publish"
                                       href="<?= BASE_URL ?>/index.php?route=admin-review-status&id=<?= (string) $review['_id'] ?>&status=published">
                                        Publier
                                    </a>

                                    <a class="btn refuse"
                                       href="<?= BASE_URL ?>/index.php?route=admin-review-status&id=<?= (string) $review['_id'] ?>&status=refused">
                                        Refuser
                                    </a>

                                    <a class="btn delete"
                                       href="<?= BASE_URL ?>/index.php?route=admin-review-delete&id=<?= (string) $review['_id'] ?>"
                                       onclick="return confirm('Supprimer cet avis ?')">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

    </div>
</main>

</body>
</html>