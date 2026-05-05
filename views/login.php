<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élégance Event - Connexion</title>
    <meta name="description"
        content="Connectez-vous à votre espace Élégance Event pour gérer vos devis et vos événements.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/connexion.css">
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
                        <li><a href="<?= BASE_URL ?>/index.php?route=account">Mon compte</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=logout">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="login-page">
            <div class="container login-layout">

                <aside class="login-visual">
                    <img src="<?= BASE_URL ?>/assets/images/connexion-hero.png"
                        alt="Ambiance élégante d'événement avec décoration raffinée">
                    <div class="login-visual-content">
                        <p class="visual-label">Curated experiences</p>
                        <h1>Bienvenue chez Élégance Event</h1>
                        <p>
                            Retrouvez votre espace personnel pour gérer vos demandes,
                            vos échanges et vos projets d’événements avec simplicité.
                        </p>
                    </div>
                </aside>

                <section class="login-form-section">
                    <div class="login-form-wrapper">
                        <h2>Connexion à votre compte</h2>
                        <p class="login-intro">
                            Connectez-vous pour accéder à votre espace et retrouver vos informations.
                        </p>

                        <?php if (!empty($errors)): ?>
                            <div class="form-messages">
                                <?php foreach ($errors as $error): ?>
                                    <p class="error-message"><?= htmlspecialchars($error) ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="post" class="login-form">
                            <div class="form-group">
                                <label for="email">Adresse e-mail</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="nom@exemple.com"
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="********"
                                    required>
                            </div>

                            <div class="form-options">
                                <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                            </div>

                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>

    
                        <p class="register-text">
                            Vous n’avez pas encore de compte ?
                            <a href="<?= BASE_URL ?>/index.php?route=register">S’inscrire</a>
                        </p>

                        <article class="login-card">
                            <img src="<?= BASE_URL ?>/assets/images/connexion-card.png" alt="Détail élégant en noir et blanc">
                            <div class="login-card-content">
                                <p>
                                    « L’excellence au service de vos instants. »
                                </p>
                            </div>
                        </article>
                    </div>
                </section>

            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-bottom">
            <p>&copy; 2026 Élégance Event. Tous droits réservés.</p>
            <ul class="footer-links-inline">
                <li><a href="<?= BASE_URL ?>/index.php?route=mentions">Mentions légales</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=privacy">Politique de confidentialité</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=cgu">Conditions d’utilisation</a></li>
                <li><a href="#">Presse</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?route=admin-login">Admin</a></li>
            </ul>
        </div>
    </footer>

    <script src="<?= BASE_URL ?>/assets/js/scrypt.js"></script>
</body>

</html>