<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion administrateur - Élégance Event</title>
    <meta name="description" content="Connexion administrateur Élégance Event.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
</head>

<body>

    <main class="admin-login-page">
        <section class="admin-login-card">
            <p class="admin-label">Administration</p>
            <h1>Connexion administrateur</h1>
            <p class="admin-intro">
                Connectez-vous pour accéder au tableau de bord d’administration.
            </p>

            <?php if (!empty($errors)): ?>
                <div class="form-messages">
                    <?php foreach ($errors as $error): ?>
                        <p class="error-message"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" class="admin-form">
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="admin@exemple.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="********"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

            <p class="back-link">
                <a href="<?= BASE_URL ?>/index.php">Retour au site</a>
            </p>
        </section>
    </main>

</body>

</html>