<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élégance Event - Services</title>
    <meta name="description" content="Découvrez les services et les collections proposées par Élégance Event pour sublimer vos événements.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/services.css">
</head>

<body>

    <!-- En-tête -->
    <header class="site-header">
        <div class="container header-content">
            <a href="<?= BASE_URL ?>/index.php" class="logo">Élégance Event</a>

            <button class="burger" aria-label="Ouvrir le menu">☰</button>

            <nav class="main-nav" aria-label="Navigation principale">
                <ul class="nav-list">
                    <li><a href="<?= BASE_URL ?>/index.php">Accueil</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=services" aria-current="page">Services</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a></li>

                    <?php if (!empty($_SESSION['user'])): ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=cart">Panier</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=orders">Mes commandes</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=account">Mon compte</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=logout">Déconnexion</a></li>

                    <?php elseif (!empty($_SESSION['admin'])): ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=admin-dashboard">Admin</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=admin-logout">Déconnexion</a></li>

                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>

        <!-- Introduction -->
        <section class="services-intro">
            <div class="container">
                <h1>Nos services</h1>
                <p>
                    Découvrez une sélection de mobilier, d’art de la table et de décoration
                    pensée pour créer des événements élégants, harmonieux et mémorables.
                </p>
            </div>
        </section>

        <!-- Filtres / catégories -->
        <section class="services-filters">
            <div class="container">
                <ul class="filter-list">
                    <li><a href="#produits" class="filter-link">Tous les produits</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=contact" class="filter-link">Demander un devis</a></li>
                </ul>
            </div>
        </section>

        <!-- Mise en avant principale -->
        <section class="services-showcase">
            <div class="container showcase-grid">

                <article class="showcase-main">
                    <img src="<?= BASE_URL ?>/assets/images/services-hero.png" alt="Art de la table élégant avec verres et assiettes">
                    <div class="showcase-main-content">
                        <p class="showcase-subtitle">Collection signature</p>
                        <h2>Art de la table</h2>
                        <p>
                            Porcelaine fine, verrerie de qualité et détails soignés
                            pour sublimer les moments de réception.
                        </p>
                        <a href="#produits" class="showcase-link">Découvrir les produits</a>
                    </div>
                </article>

                <aside class="showcase-side">
                    <h2>Mobilier & décoration</h2>
                    <p>
                        Une sélection de pièces sobres et élégantes pour aménager
                        vos espaces avec caractère.
                    </p>
                    <img src="<?= BASE_URL ?>/assets/images/mobilier-luxe.png" alt="Mobilier élégant pour événement">
                    <a href="<?= BASE_URL ?>/index.php?route=contact" class="showcase-link">Demander un devis</a>
                </aside>

            </div>
        </section>

        <!-- Produits dynamiques -->
        <section class="featured-products" id="produits">
            <div class="container">
                <h2>Nos produits</h2>

                <?php if (empty($products)): ?>
                    <p class="empty-products-message">
                        Aucun produit n’est encore disponible pour le moment.
                    </p>
                <?php else: ?>
                    <div class="products-grid">
                        <?php foreach ($products as $product): ?>
                            <?php
                            $productId = (int)($product['id'] ?? 0);
                            $title = trim($product['title'] ?? '');
                            $category = trim($product['category'] ?? '');
                            $description = trim($product['description'] ?? '');
                            $price = isset($product['price']) ? (float)$product['price'] : 0;
                            $image = trim($product['image'] ?? '');
                            ?>

                            <article class="product-card">
                                <a
                                    href="<?= BASE_URL ?>/index.php?route=product&id=<?= $productId ?>"
                                    class="product-card-link-image"
                                    aria-label="Voir le détail du produit <?= htmlspecialchars($title !== '' ? $title : 'Produit') ?>"
                                >
                                    <?php if ($image !== ''): ?>
                                        <img
                                            src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($image) ?>"
                                            alt="<?= htmlspecialchars($title !== '' ? $title : 'Produit') ?>">
                                    <?php else: ?>
                                        <img
                                            src="<?= BASE_URL ?>/assets/images/services-hero.png"
                                            alt="Image produit par défaut">
                                    <?php endif; ?>
                                </a>

                                <h3>
                                    <a
                                        href="<?= BASE_URL ?>/index.php?route=product&id=<?= $productId ?>"
                                        class="product-title-link"
                                    >
                                        <?= htmlspecialchars($title !== '' ? $title : 'Produit sans titre') ?>
                                    </a>
                                </h3>

                                <?php if ($category !== ''): ?>
                                    <p class="product-category">
                                        <?= htmlspecialchars($category) ?>
                                    </p>
                                <?php endif; ?>

                                <p class="product-description">
                                    <?= htmlspecialchars($description !== '' ? $description : 'Description non disponible.') ?>
                                </p>

                                <p class="product-price">
                                    <?= htmlspecialchars(number_format($price, 2, ',', ' ')) ?> €
                                </p>

                                <div class="product-card-actions">
                                    <a
                                        href="<?= BASE_URL ?>/index.php?route=product&id=<?= $productId ?>"
                                        class="btn btn-secondary"
                                    >
                                        Voir le détail
                                    </a>

                                    <?php if (!empty($_SESSION['user'])): ?>
                                        <form action="<?= BASE_URL ?>/index.php?route=cart_add" method="post" class="add-to-cart-form">
                                            <input type="hidden" name="product_id" value="<?= $productId ?>">
                                            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                                        </form>
                                    <?php else: ?>
                                        <a href="<?= BASE_URL ?>/index.php?route=login" class="btn btn-primary">
                                            Connectez-vous pour réserver
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Appel à l'action -->
        <section class="services-cta">
            <div class="container">
                <h2>Votre événement mérite l'excellence</h2>
                <p>
                    Recevez un devis personnalisé pour la location de votre matériel
                    et la mise en valeur de votre projet.
                </p>
                <a href="<?= BASE_URL ?>/index.php?route=contact" class="btn btn-primary">Demander un devis</a>
            </div>
        </section>

    </main>

    <!-- Pied de page -->
    <footer class="site-footer">
        <div class="container footer-top">

            <div class="footer-column">
                <h2 class="footer-title">Élégance Event</h2>
                <p>
                    L’art de recevoir, avec une sélection rigoureuse et un sens du détail.
                </p>
            </div>

            <div class="footer-column">
                <h2 class="footer-title">L’agence</h2>
                <ul class="footer-links">
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Conditions d’utilisation</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h2 class="footer-title">Aide</h2>
                <ul class="footer-links">
                    <li><a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=services">Services</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=admin-login">Admin</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h2 class="footer-title">Newsletter</h2>
                <form action="#" method="post" class="newsletter-form">
                    <label for="email-newsletter" class="visually-hidden">Adresse e-mail</label>
                    <input type="email" id="email-newsletter" name="email" placeholder="Adresse e-mail">
                    <button type="submit">S’inscrire</button>
                </form>
            </div>

        </div>

        <div class="container footer-bottom">
            <p>&copy; 2026 Élégance Event. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="<?= BASE_URL ?>/assets/js/scrypt.js"></script>
</body>

</html>