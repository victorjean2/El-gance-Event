<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon panier - Élégance Event</title>
    <meta name="description" content="Consultez votre panier et validez votre commande sur Élégance Event.">
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
                        <li><a href="<?= BASE_URL ?>/index.php?route=cart" aria-current="page">Panier</a></li>
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

    <main class="container">

        <section class="cart-page-header">
            <h1>Mon panier</h1>
            <p class="cart-page-intro">
                Vérifiez vos produits, ajustez les quantités puis validez votre demande de location.
            </p>
        </section>

        <?php if (!empty($_SESSION['cart_error'])): ?>
            <div class="form-messages">
                <p class="error-message"><?= htmlspecialchars($_SESSION['cart_error']) ?></p>
            </div>
            <?php unset($_SESSION['cart_error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['cart_success'])): ?>
            <div class="form-messages">
                <p class="success-message"><?= htmlspecialchars($_SESSION['cart_success']) ?></p>
            </div>
            <?php unset($_SESSION['cart_success']); ?>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <section class="cart-empty-state">
                <p>Votre panier est vide.</p>
                <p>
                    <a href="<?= BASE_URL ?>/index.php?route=services" class="btn">
                        Voir les services
                    </a>
                </p>
            </section>

        <?php else: ?>

            <div class="cart-list">
                <?php foreach ($cartItems as $item): ?>
                    <?php
                    $image = trim($item['image'] ?? '');
                    $title = trim($item['title'] ?? '');
                    $description = trim($item['description'] ?? '');
                    $price = isset($item['price']) ? (float) $item['price'] : 0;
                    $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 1;
                    $lineTotal = $price * $quantity;
                    ?>

                    <article
                        class="cart-item cart-row"
                        data-price="<?= htmlspecialchars((string) $price) ?>"
                    >
                        <?php if ($image !== ''): ?>
                            <img
                                src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($image) ?>"
                                alt="<?= htmlspecialchars($title !== '' ? $title : 'Produit') ?>"
                                width="120">
                        <?php else: ?>
                            <img
                                src="<?= BASE_URL ?>/assets/images/services-hero.png"
                                alt="Image produit par défaut"
                                width="120">
                        <?php endif; ?>

                        <div class="cart-item-content">
                            <h2><?= htmlspecialchars($title !== '' ? $title : 'Produit sans titre') ?></h2>

                            <p><?= htmlspecialchars($description !== '' ? $description : 'Description non disponible.') ?></p>

                            <p>
                                Prix unitaire :
                                <strong class="unit-price">
                                    <?= number_format($price, 2, ',', ' ') ?> €
                                </strong>
                            </p>

                            <p>
                                Sous-total :
                                <strong class="line-total" data-line-total>
                                    <?= number_format($lineTotal, 2, ',', ' ') ?> €
                                </strong>
                            </p>

                            <!-- UPDATE -->
                            <form action="<?= BASE_URL ?>/index.php?route=cart_update" method="post" class="cart-form">
                                <input type="hidden" name="cart_item_id" value="<?= (int) $item['id'] ?>">

                                <label for="quantity-<?= (int) $item['id'] ?>">Quantité :</label>
                                <input
                                    type="number"
                                    id="quantity-<?= (int) $item['id'] ?>"
                                    name="quantity"
                                    class="quantity-input"
                                    min="1"
                                    value="<?= $quantity ?>"
                                    data-quantity-input
                                >

                                <button type="submit">Mettre à jour</button>
                            </form>

                            <!-- DELETE -->
                            <form action="<?= BASE_URL ?>/index.php?route=cart_remove" method="post" class="cart-form">
                                <input type="hidden" name="cart_item_id" value="<?= (int) $item['id'] ?>">
                                <button type="submit" class="btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <hr>

            <section class="cart-summary">
                <p class="cart-total">
                    <strong>
                        Total :
                        <span id="cart-grand-total"><?= number_format($total, 2, ',', ' ') ?> €</span>
                    </strong>
                </p>

                <form action="<?= BASE_URL ?>/index.php?route=checkout" method="post" class="rental-form">
                    <div class="rental-grid">
                        <div class="form-group">
                            <label for="event_date">Date de l’événement</label>
                            <input
                                type="date"
                                id="event_date"
                                name="event_date"
                                value="<?= htmlspecialchars($_POST['event_date'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="delivery_datetime">Date et heure de livraison <span class="required">*</span></label>
                            <input
                                type="datetime-local"
                                id="delivery_datetime"
                                name="delivery_datetime"
                                value="<?= htmlspecialchars($_POST['delivery_datetime'] ?? '') ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="return_datetime">Date et heure de retour <span class="required">*</span></label>
                            <input
                                type="datetime-local"
                                id="return_datetime"
                                name="return_datetime"
                                value="<?= htmlspecialchars($_POST['return_datetime'] ?? '') ?>"
                                required>
                        </div>
                    </div>

                    <div class="cart-actions">
                        <button type="submit" class="btn">Valider mon panier</button>

                        <a href="<?= BASE_URL ?>/index.php?route=services" class="btn btn-secondary">
                            Continuer mes achats
                        </a>
                    </div>
                </form>
            </section>

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
    <script src="<?= BASE_URL ?>/assets/js/cart-total.js"></script>

</body>
</html>