<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit - Admin</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin-products.css">
</head>
<body>

<main class="admin-products-page">
    <section class="admin-products-card">
        <h1>Modifier un produit</h1>

        <?php if (!empty($errors)): ?>
            <div class="form-messages">
                <?php foreach ($errors as $error): ?>
                    <p class="error-message"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data" class="admin-product-form">
            <div class="form-group">
                <label for="title">Titre</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="<?= htmlspecialchars($_POST['title'] ?? $product['title']) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    required
                ><?= htmlspecialchars($_POST['description'] ?? $product['description']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Prix</label>
                <input
                    type="text"
                    id="price"
                    name="price"
                    value="<?= htmlspecialchars($_POST['price'] ?? $product['price']) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="category">Catégorie</label>
                <input
                    type="text"
                    id="category"
                    name="category"
                    value="<?= htmlspecialchars($_POST['category'] ?? $product['category']) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="image">Nouvelle image (optionnelle)</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                >
            </div>

            <div class="form-group checkbox-group">
                <label for="is_published">
                    <input
                        type="checkbox"
                        id="is_published"
                        name="is_published"
                        value="1"
                        <?= (!empty($_POST['is_published']) || (!isset($_POST['is_published']) && !empty($product['is_published']))) ? 'checked' : '' ?>
                    >
                    Publier ce produit sur le site
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>

        <p class="back-link">
            <a href="<?= BASE_URL ?>/index.php?route=admin-products">Retour à la liste</a>
        </p>
    </section>
</main>

</body>
</html>