<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin-products.css">
</head>

<body>

<!-- =========================
     HEADER ADMIN
========================= -->
<header class="admin-header">
    <div class="container admin-header-content">
        <a href="<?= BASE_URL ?>/index.php" class="admin-logo">
            Élégance Event
        </a>

        <nav class="admin-nav">
            <ul class="admin-nav-list">
                <li>
                    <a href="<?= BASE_URL ?>/index.php?route=admin-dashboard">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="<?= BASE_URL ?>/index.php?route=admin-products" aria-current="page">
                        Produits
                    </a>
                </li>

                <li>
                    <a href="<?= BASE_URL ?>/index.php?route=admin-product-create">
                        Ajouter produit
                    </a>
                </li>

                <li>
                    <a href="<?= BASE_URL ?>/index.php">
                        Voir le site
                    </a>
                </li>

                <li>
                    <a href="<?= BASE_URL ?>/index.php?route=admin-logout">
                        Déconnexion
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- =========================
     MAIN
========================= -->
<main class="admin-products-page">
    <section class="admin-products-card">
        <h1>Liste des produits</h1>

        <p class="top-action">
            <a href="<?= BASE_URL ?>/index.php?route=admin-product-create" class="btn btn-primary">
                Ajouter un produit
            </a>
        </p>

        <?php if (empty($products)): ?>
            <p class="empty-message">
                Aucun produit enregistré pour le moment.
            </p>
        <?php else: ?>
            <div class="products-list">
                <?php foreach ($products as $product): ?>
                    <article class="product-item">

                        <?php if (!empty($product['image'])): ?>
                            <img
                                src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($product['image']) ?>"
                                alt="<?= htmlspecialchars($product['title']) ?>"
                            >
                        <?php endif; ?>

                        <div class="product-content">
                            <h2><?= htmlspecialchars($product['title']) ?></h2>

                            <p>
                                <strong>Catégorie :</strong>
                                <?= htmlspecialchars($product['category']) ?>
                            </p>

                            <p>
                                <strong>Prix :</strong>
                                <?= htmlspecialchars(number_format((float)$product['price'], 2, ',', ' ')) ?> €
                            </p>

                            <p>
                                <strong>Publié :</strong>
                                <?= !empty($product['is_published']) ? 'Oui' : 'Non' ?>
                            </p>

                            <p><?= htmlspecialchars($product['description']) ?></p>

                            <div class="product-actions">
                                <a href="<?= BASE_URL ?>/index.php?route=admin-product-edit&id=<?= (int)$product['id'] ?>"
                                   class="btn btn-secondary">
                                    Modifier
                                </a>

                                <a href="<?= BASE_URL ?>/index.php?route=admin-product-delete&id=<?= (int)$product['id'] ?>"
                                   class="btn btn-danger"
                                   onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                    Supprimer
                                </a>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

</body>
</html>