<h3>Avis clients</h3>

<?php if (empty($reviews)): ?>
    <p>Aucun avis</p>
<?php else: ?>
    <?php foreach ($reviews as $review): ?>
        <div class="review">
            <strong><?= htmlspecialchars($review['user_name']) ?></strong>
            <p>Note : <?= $review['rating'] ?>/5</p>
            <p><?= htmlspecialchars($review['comment']) ?></p>
            <small><?= $review['created_at'] ?></small>
        </div>
    <?php endforeach; ?>
<?php endif; ?>