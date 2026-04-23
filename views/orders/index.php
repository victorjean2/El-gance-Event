<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes commandes</title>
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


<h1>Mes commandes</h1>

<?php if (empty($orders)): ?>
    <p>Vous n'avez encore aucune commande.</p>
<?php else: ?>
    <?php foreach ($orders as $order): ?>
        <section style="margin-bottom: 30px; border:1px solid #ccc; padding:15px;">
            <h2>Commande #<?= (int) $order['id'] ?></h2>
            <p>Statut : <?= htmlspecialchars($order['status']) ?></p>
            <p>Date : <?= htmlspecialchars($order['created_at'] ?? '') ?></p>

            <?php if (!empty($order['items'])): ?>
                <?php foreach ($order['items'] as $item): ?>
                    <div style="margin:15px 0; padding:10px; border:1px solid #eee;">
                        <p><strong><?= htmlspecialchars($item['product_title']) ?></strong></p>
                        <p>Quantité : <?= (int) $item['quantity'] ?></p>

                        <?php
                        $product = [
                            'id' => (int) $item['product_id']
                        ];
                        ?>

                        <?php require '../views/reviews/form.php'; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>