<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['title'] ?? 'Produit') ?> - Élégance Event</title>
    <meta name="description" content="<?= htmlspecialchars($product['description'] ?? 'Découvrez ce produit sur Élégance Event.') ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

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
                        <li><a href="<?= BASE_URL ?>/index.php?route=orders">Mes commandes</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=account">Mon compte</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=logout">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container" style="padding: 40px 0;">
        <section class="product-detail">

            <p>
                <a href="<?= BASE_URL ?>/index.php?route=services">← Retour aux services</a>
            </p>

            <div class="product-detail-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:30px; align-items:start;">
                <div class="product-detail-image">
                    <?php if (!empty($product['image'])): ?>
                        <img
                            src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['title']) ?>"
                            style="width:100%; max-width:500px; border-radius:10px;">
                    <?php else: ?>
                        <img
                            src="<?= BASE_URL ?>/assets/images/services-hero.png"
                            alt="Image par défaut"
                            style="width:100%; max-width:500px; border-radius:10px;">
                    <?php endif; ?>
                </div>

                <div class="product-detail-content">
                    <h1><?= htmlspecialchars($product['title']) ?></h1>

                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($product['category'] ?? 'Non renseignée') ?></p>

                    <p><strong>Prix :</strong> <?= number_format((float) ($product['price'] ?? 0), 2, ',', ' ') ?> €</p>

                    <div style="margin:20px 0;">
                        <h2>Description</h2>
                        <p><?= nl2br(htmlspecialchars($product['description'] ?? 'Description non disponible.')) ?></p>
                    </div>

                    <?php if (!empty($_SESSION['user'])): ?>
                        <form action="<?= BASE_URL ?>/index.php?route=cart_add" method="post">
                            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                            <button type="submit" class="btn">Ajouter au panier</button>
                        </form>
                    <?php else: ?>
                        <p>
                            <a href="<?= BASE_URL ?>/index.php?route=login" class="btn">Connectez-vous pour réserver</a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <hr style="margin:40px 0;">

            <section class="product-reviews">
                <h2>Avis clients</h2>

                <?php if (empty($reviews)): ?>
                    <p>Aucun avis publié pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <article style="background:#f8f8f8; padding:15px; border-radius:10px; margin-bottom:15px;">
                            <p><strong><?= htmlspecialchars($review['user_name'] ?? 'Client') ?></strong></p>
                            <p>Note : <?= (int) ($review['rating'] ?? 0) ?>/5</p>
                            <p><?= nl2br(htmlspecialchars($review['comment'] ?? '')) ?></p>
                            <small><?= htmlspecialchars($review['created_at'] ?? '') ?></small>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>

        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-bottom">
            <p>&copy; 2026 Élégance Event. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="<?= BASE_URL ?>/assets/js/scrypt.js"></script>
</body>

</html>