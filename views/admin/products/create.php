<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit - Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin-products.css">
</head>
<body>

    <!-- HEADER ADMIN -->
    <header class="admin-header">
        <div class="container admin-header-content">
            <a href="<?= BASE_URL ?>/index.php?route=admin-dashboard" class="admin-logo">
                Élégance Event Admin
            </a>

            <nav class="admin-nav" aria-label="Navigation administration">
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
                            Ajouter un produit
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

    <main class="admin-products-page">
        <section class="admin-products-card">
            <div class="admin-page-top">
                <div>
                    <p class="admin-section-label">Administration</p>
                    <h1>Ajouter un produit</h1>
                </div>

                <a href="<?= BASE_URL ?>/index.php?route=admin-products" class="btn btn-secondary">
                    Retour à la liste
                </a>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="form-messages">
                    <?php foreach ($errors as $error): ?>
                        <p class="error-message"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="form-messages">
                    <p class="success-message"><?= htmlspecialchars($success) ?></p>
                </div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data" class="admin-product-form">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Prix</label>
                    <input
                        type="text"
                        id="price"
                        name="price"
                        value="<?= htmlspecialchars($_POST['price'] ?? '') ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        placeholder="mobilier, décoration..."
                        value="<?= htmlspecialchars($_POST['category'] ?? '') ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp">
                </div>

                <div class="form-group checkbox-group">
                    <label for="is_published">
                        <input
                            type="checkbox"
                            id="is_published"
                            name="is_published"
                            value="1"
                            <?= !empty($_POST['is_published']) ? 'checked' : '' ?>>
                        Publier ce produit sur le site
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter le produit</button>
                    <a href="<?= BASE_URL ?>/index.php?route=admin-products" class="btn btn-secondary">
                        Annuler
                    </a>
                </div>
            </form>
        </section>
    </main>

</body>
</html>