<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard administrateur - Élégance Event</title>
    <meta name="description" content="Tableau de bord administrateur Élégance Event.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin-dashboard.css">
</head>

<body>

    <header class="admin-header">
        <div class="container admin-header-content">
            <a href="<?= BASE_URL ?>/index.php" class="admin-logo">Élégance Event</a>

            <nav class="admin-nav" aria-label="Navigation administrateur">
                <ul class="admin-nav-list">
                    <li><a href="<?= BASE_URL ?>/index.php?route=admin-dashboard" aria-current="page">Dashboard</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=admin-products">Produits</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=admin-reviews">Avis clients</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php">Voir le site</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=admin-logout">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="admin-dashboard-page">
        <div class="container">

            <section class="admin-hero">
                <p class="admin-label">Administration</p>
                <h1>
                    Bienvenue
                    <?= htmlspecialchars($_SESSION['admin']['firstname'] ?? '') ?>
                    <?= htmlspecialchars($_SESSION['admin']['lastname'] ?? '') ?>
                </h1>
                <p class="admin-intro">
                    Vous êtes connecté en tant qu’administrateur. Retrouvez ici les messages clients, les commandes et les accès rapides de gestion.
                </p>
            </section>

            <section class="admin-stats-grid">
                <article class="admin-stat-card">
                    <span class="stat-number">1</span>
                    <p class="stat-label">Session admin active</p>
                </article>

                <article class="admin-stat-card">
                    <span class="stat-number"><?= isset($contacts) ? count($contacts) : 0 ?></span>
                    <p class="stat-label">Messages reçus</p>
                </article>

                <article class="admin-stat-card">
                    <span class="stat-number"><?= isset($adminOrders) ? count($adminOrders) : 0 ?></span>
                    <p class="stat-label">Commandes clients</p>
                </article>

                <article class="admin-stat-card">
                    <span class="stat-number"><?= isset($pendingReviewsCount) ? $pendingReviewsCount : 0 ?></span>
                    <p class="stat-label">Avis en attente</p>
                </article>
            </section>

            <section class="admin-grid">

                <article class="admin-card">
                    <h2>Profil administrateur</h2>

                    <div class="info-row">
                        <span class="info-label">Nom</span>
                        <p class="info-value"><?= htmlspecialchars($_SESSION['admin']['lastname'] ?? '') ?></p>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Prénom</span>
                        <p class="info-value"><?= htmlspecialchars($_SESSION['admin']['firstname'] ?? '') ?></p>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <p class="info-value"><?= htmlspecialchars($_SESSION['admin']['email'] ?? '') ?></p>
                    </div>
                </article>

                <article class="admin-card">
                    <h2>Actions rapides</h2>

                    <div class="admin-actions">
                        <a href="<?= BASE_URL ?>/index.php?route=admin-products" class="admin-action-link">
                            Gérer les produits
                        </a>

                        <a href="<?= BASE_URL ?>/index.php?route=admin-product-create" class="admin-action-link">
                            Ajouter un produit
                        </a>

                        <a href="<?= BASE_URL ?>/index.php?route=admin-reviews" class="admin-action-link">
                            Modérer les avis
                        </a>

                        <a href="<?= BASE_URL ?>/index.php" class="admin-action-link">
                            Voir le site
                        </a>

                        <a href="<?= BASE_URL ?>/index.php?route=contact" class="admin-action-link">
                            Page contact
                        </a>

                        <a href="<?= BASE_URL ?>/index.php?route=services" class="admin-action-link">
                            Page services
                        </a>

                        <a href="<?= BASE_URL ?>/index.php?route=admin-logout" class="admin-action-link logout-link">
                            Se déconnecter
                        </a>
                    </div>
                </article>

                <article class="admin-card full-width-card">
                    <h2>Messages reçus</h2>

                    <?php if (empty($contacts)): ?>
                        <p class="empty-message">Aucun message enregistré pour le moment.</p>
                    <?php else: ?>
                        <div class="messages-list">
                            <?php foreach ($contacts as $contact): ?>
                                <?php
                                $firstname = trim($contact['firstname'] ?? '');
                                $lastname = trim($contact['lastname'] ?? '');
                                $fullName = trim($firstname . ' ' . $lastname);
                                $email = trim($contact['email'] ?? '');
                                $phone = trim($contact['phone'] ?? '');
                                $subject = trim($contact['subject'] ?? '');
                                $message = trim($contact['message'] ?? '');
                                $createdAt = trim($contact['created_at'] ?? '');
                                ?>

                                <article class="message-card">
                                    <div class="message-header">
                                        <h3>
                                            <?= htmlspecialchars($fullName !== '' ? $fullName : 'Client non renseigné') ?>
                                        </h3>
                                        <p class="message-date">
                                            <?= htmlspecialchars($createdAt !== '' ? $createdAt : 'Date non disponible') ?>
                                        </p>
                                    </div>

                                    <p>
                                        <strong>Email :</strong>
                                        <?= htmlspecialchars($email !== '' ? $email : 'Non renseigné') ?>
                                    </p>

                                    <p>
                                        <strong>Téléphone :</strong>
                                        <?= htmlspecialchars($phone !== '' ? $phone : 'Non renseigné') ?>
                                    </p>

                                    <p>
                                        <strong>Sujet :</strong>
                                        <?= htmlspecialchars($subject !== '' ? $subject : 'Sans sujet') ?>
                                    </p>

                                    <p><strong>Message :</strong></p>

                                    <div class="message-content">
                                        <?= nl2br(htmlspecialchars($message !== '' ? $message : 'Aucun message')) ?>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </article>

                <article class="admin-card full-width-card">
                    <h2>Commandes clients</h2>

                    <?php if (empty($adminOrders)): ?>
                        <p class="empty-message">Aucune commande enregistrée pour le moment.</p>
                    <?php else: ?>
                        <div class="messages-list">
                            <?php foreach ($adminOrders as $order): ?>
                                <?php
                                $orderId = (int)($order['id'] ?? 0);
                                $firstname = trim($order['firstname'] ?? '');
                                $lastname = trim($order['lastname'] ?? '');
                                $fullName = trim($firstname . ' ' . $lastname);
                                $email = trim($order['email'] ?? '');
                                $status = trim($order['status'] ?? 'en attente');
                                $totalAmount = isset($order['total_amount']) ? (float)$order['total_amount'] : 0;
                                $createdAt = trim($order['created_at'] ?? '');
                                $items = $order['items'] ?? [];
                                ?>

                                <article class="message-card">
                                    <div class="message-header">
                                        <h3>
                                            Commande #<?= $orderId ?> -
                                            <?= htmlspecialchars($fullName !== '' ? $fullName : 'Client non renseigné') ?>
                                        </h3>
                                        <p class="message-date">
                                            <?= htmlspecialchars($createdAt !== '' ? $createdAt : 'Date non disponible') ?>
                                        </p>
                                    </div>

                                    <p>
                                        <strong>Email :</strong>
                                        <?= htmlspecialchars($email !== '' ? $email : 'Non renseigné') ?>
                                    </p>

                                    <p>
                                        <strong>Total :</strong>
                                        <?= number_format($totalAmount, 2, ',', ' ') ?> €
                                    </p>

                                    <p>
                                        <strong>Statut actuel :</strong>
                                        <?= htmlspecialchars($status) ?>
                                    </p>

                                    <form action="<?= BASE_URL ?>/index.php?route=admin-order-status" method="post" class="order-status-form">
                                        <input type="hidden" name="order_id" value="<?= $orderId ?>">

                                        <label for="status-<?= $orderId ?>">
                                            <strong>Traiter la commande :</strong>
                                        </label>

                                        <select name="status" id="status-<?= $orderId ?>">
                                            <option value="en attente" <?= $status === 'en attente' ? 'selected' : '' ?>>En attente</option>
                                            <option value="validée" <?= $status === 'validée' ? 'selected' : '' ?>>Validée</option>
                                            <option value="en préparation" <?= $status === 'en préparation' ? 'selected' : '' ?>>En préparation</option>
                                            <option value="expédiée" <?= $status === 'expédiée' ? 'selected' : '' ?>>Expédiée</option>
                                            <option value="annulée" <?= $status === 'annulée' ? 'selected' : '' ?>>Annulée</option>
                                        </select>

                                        <button type="submit" class="admin-action-link">
                                            Mettre à jour
                                        </button>
                                    </form>

                                    <p><strong>Produits commandés :</strong></p>

                                    <div class="message-content">
                                        <?php if (empty($items)): ?>
                                            <p>Aucun article associé à cette commande.</p>
                                        <?php else: ?>
                                            <?php foreach ($items as $item): ?>
                                                <?php
                                                $productTitle = trim($item['product_title'] ?? '');
                                                $productPrice = isset($item['product_price']) ? (float)$item['product_price'] : 0;
                                                $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
                                                $lineTotal = isset($item['line_total']) ? (float)$item['line_total'] : 0;
                                                ?>
                                                <div class="order-item">
                                                    <p>
                                                        <strong><?= htmlspecialchars($productTitle !== '' ? $productTitle : 'Produit') ?></strong>
                                                    </p>
                                                    <p>Prix unitaire : <?= number_format($productPrice, 2, ',', ' ') ?> €</p>
                                                    <p>Quantité : <?= $quantity ?></p>
                                                    <p>Sous-total : <?= number_format($lineTotal, 2, ',', ' ') ?> €</p>
                                                </div>
                                                <hr class="order-divider">
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </article>

            </section>

        </div>
    </main>

</body>

</html>