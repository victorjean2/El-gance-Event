<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes commandes - Élégance Event</title>
    <meta name="description" content="Consultez l’historique de vos commandes et locations Élégance Event.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/cart.css">
</head>

<body>

    <!-- HEADER -->
    <header class="site-header">
        <div class="container header-content">
            <a href="<?= BASE_URL ?>/index.php" class="logo">Élégance Event</a>

            <button class="burger" aria-label="Ouvrir le menu">☰</button>

            <nav class="main-nav" aria-label="Navigation principale">
                <ul class="nav-list">
                    <li><a href="<?= BASE_URL ?>/index.php">Accueil</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=services">Services</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a></li>

                    <?php if (!empty($_SESSION['user'])): ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=cart">Panier</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=orders" aria-current="page">Mes commandes</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=account">Mon compte</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=logout">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- MAIN -->
    <main class="container">

        <section class="cart-page-header">
            <h1>Mes commandes</h1>
            <p class="cart-page-intro">
                Retrouvez ici l’historique de vos demandes de location, avec les informations de livraison et de retour.
            </p>
        </section>

        <?php if (empty($orders)): ?>
            <section class="cart-empty-state">
                <p>Vous n’avez encore passé aucune commande.</p>

                <p>
                    <a href="<?= BASE_URL ?>/index.php?route=services" class="btn">
                        Voir les services
                    </a>
                </p>
            </section>

        <?php else: ?>

            <div class="cart-list">
                <?php foreach ($orders as $order): ?>
                    <?php
                    $orderId = (int) ($order['id'] ?? 0);
                    $createdAt = trim($order['created_at'] ?? '');
                    $status = trim($order['status'] ?? 'en attente');
                    $totalAmount = isset($order['total_amount']) ? (float) $order['total_amount'] : 0;
                    $eventDate = trim($order['event_date'] ?? '');
                    $deliveryDatetime = trim($order['delivery_datetime'] ?? '');
                    $returnDatetime = trim($order['return_datetime'] ?? '');
                    $items = $order['items'] ?? [];
                    ?>

                    <section class="cart-item">
                        <div class="cart-item-content">

                            <h2>Commande #<?= $orderId ?></h2>

                            <p>
                                Date de commande :
                                <strong><?= htmlspecialchars($createdAt !== '' ? $createdAt : 'Non renseignée') ?></strong>
                            </p>

                            <p>
                                Date de l’événement :
                                <strong><?= htmlspecialchars($eventDate !== '' ? $eventDate : 'Non renseignée') ?></strong>
                            </p>

                            <p>
                                Livraison :
                                <strong><?= htmlspecialchars($deliveryDatetime !== '' ? $deliveryDatetime : 'Non renseignée') ?></strong>
                            </p>

                            <p>
                                Retour :
                                <strong><?= htmlspecialchars($returnDatetime !== '' ? $returnDatetime : 'Non renseignée') ?></strong>
                            </p>

                            <p>
                                Statut :
                                <strong><?= htmlspecialchars($status) ?></strong>
                            </p>

                            <p>
                                Total :
                                <strong><?= number_format($totalAmount, 2, ',', ' ') ?> €</strong>
                            </p>

                            <h3>Produits</h3>

                            <?php if (empty($items)): ?>
                                <p>Aucun produit associé à cette commande.</p>
                            <?php else: ?>
                                <?php foreach ($items as $item): ?>
                                    <?php
                                    $productTitle = trim($item['product_title'] ?? '');
                                    $productPrice = isset($item['product_price']) ? (float) $item['product_price'] : 0;
                                    $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 0;
                                    $lineTotal = isset($item['line_total']) ? (float) $item['line_total'] : 0;
                                    ?>
                                    <div style="margin-bottom: 1rem;">
                                        <p>
                                            <strong><?= htmlspecialchars($productTitle !== '' ? $productTitle : 'Produit') ?></strong>
                                        </p>

                                        <p>
                                            Prix :
                                            <?= number_format($productPrice, 2, ',', ' ') ?> €
                                        </p>

                                        <p>
                                            Quantité :
                                            <?= $quantity ?>
                                        </p>

                                        <p>
                                            Sous-total :
                                            <?= number_format($lineTotal, 2, ',', ' ') ?> €
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </section>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container footer-bottom">
            <p>&copy; 2026 Élégance Event. Tous droits réservés.</p>

            <ul class="footer-links-inline">
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Confidentialité</a></li>
                <li><a href="#">Presse</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a></li>
            </ul>
        </div>
    </footer>

    <script src="<?= BASE_URL ?>/assets/js/scrypt.js"></script>

</body>

</html>