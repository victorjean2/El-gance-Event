<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande - Élégance Event</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/cart.css">
</head>

<body>
    <main class="container" style="padding: 40px 0;">
        <h1>Commande confirmée</h1>

        <p>Merci, votre demande de location a bien été enregistrée.</p>

        <p><strong>Commande n°<?= (int) $order['id'] ?></strong></p>
        <p>Statut : <?= htmlspecialchars($order['status']) ?></p>
        <p>Total : <?= number_format((float) $order['total_amount'], 2, ',', ' ') ?> €</p>

        <h2>Produits commandés</h2>

        <?php if (empty($orderItems)): ?>
            <p>Aucun article trouvé.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($orderItems as $item): ?>
                    <li>
                        <?= htmlspecialchars($item['product_title']) ?>
                        - Quantité : <?= (int) $item['quantity'] ?>
                        - Sous-total : <?= number_format((float) $item['line_total'], 2, ',', ' ') ?> €
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <p style="margin-top: 20px;">
            <a href="<?= BASE_URL ?>/index.php?route=orders" class="btn">Voir mes commandes</a>
        </p>
    </main>
</body>

</html>