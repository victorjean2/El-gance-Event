
<h3>Laisser un avis</h3>

<?php if (!empty($_SESSION['errors'])): ?>
    <ul>
        <?php foreach ($_SESSION['errors'] as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['success'])): ?>
    <p><?= htmlspecialchars($_SESSION['success']) ?></p>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/index.php?route=review-store">
    <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

    <label for="rating-<?= (int) $product['id'] ?>">Note :</label>
    <select name="rating" id="rating-<?= (int) $product['id'] ?>" required>
        <option value="">--</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <label for="comment-<?= (int) $product['id'] ?>">Commentaire :</label>
    <textarea name="comment" id="comment-<?= (int) $product['id'] ?>" required></textarea>

    <button type="submit">Envoyer</button>
</form>