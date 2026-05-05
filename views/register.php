<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élégance Event - Inscription</title>
    <meta name="description" content="Créez votre compte Élégance Event pour gérer vos devis et vos événements.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/register.css">
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

        <!-- Section principale -->
        <section class="register-page">
            <div class="container register-layout">

                <!-- Zone visuelle -->
                <aside class="register-visual">
                    <img src="<?= BASE_URL ?>/assets/images/connexion-hero.png" alt="Ambiance élégante d'événement avec décoration raffinée">
                    <div class="register-visual-content">
                        <p class="visual-label">Curated experiences</p>
                        <h1>Rejoignez l’univers Élégance Event</h1>
                        <p>
                            Créez votre compte pour suivre vos demandes, vos échanges
                            et l’organisation de vos événements avec élégance et simplicité.
                        </p>
                    </div>
                </aside>

                <!-- Zone formulaire -->
                <section class="register-form-section">
                    <div class="register-form-wrapper">
                        <h2>Créer un compte</h2>
                        <p class="register-intro">
                            Inscrivez-vous pour accéder à votre espace personnel
                            et gérer plus facilement vos projets d’événements.
                        </p>

                        <!-- Messages -->
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

                        <!-- Formulaire -->
                        <form action="" method="post" class="register-form">

    <div class="form-row">
        <div class="form-group">
            <label for="lastname">Nom <span class="required">*</span></label>
            <input
                type="text"
                id="lastname"
                name="lastname"
                placeholder="Votre nom"
                value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>"
                required>
        </div>

        <div class="form-group">
            <label for="firstname">Prénom <span class="required">*</span></label>
            <input
                type="text"
                id="firstname"
                name="firstname"
                placeholder="Votre prénom"
                value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>"
                required>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Adresse e-mail <span class="required">*</span></label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="nom@exemple.com"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe <span class="required">*</span></label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="********"
            required>
    </div>

    <!-- RGPD -->
    <div class="form-group form-rgpd">
        <label class="checkbox-label">
            <input
                type="checkbox"
                name="rgpd"
                value="1"
                <?= !empty($_POST['rgpd']) ? 'checked' : '' ?>
                required>

            <span>
                J’accepte que mes données personnelles soient collectées et utilisées
                par Élégance Event afin de créer mon compte et gérer mes demandes.
                <br>
                <small>
                    Conformément au RGPD, vous pouvez exercer vos droits d’accès,
                    de modification ou de suppression de vos données à tout moment.
                    <a href="<?= BASE_URL ?>/index.php?route=privacy" target="_blank">
                        En savoir plus
                    </a>
                </small>
            </span>
        </label>
    </div>

    <button type="submit" class="btn btn-primary">
        S’inscrire
    </button>

</form>

                        <p class="login-text">
                            Vous avez déjà un compte ?
                            <a href="<?= BASE_URL ?>/index.php?route=login">Se connecter</a>
                        </p>

                        <!-- Carte citation -->
                        <article class="register-card">
                            <img src="<?= BASE_URL ?>/assets/images/connexion-card.png" alt="Détail élégant en noir et blanc">
                            <div class="register-card-content">
                                <p>
                                    « L’excellence commence par une attention sincère aux détails. »
                                </p>
                            </div>
                        </article>
                    </div>
                </section>

            </div>
        </section>

    </main>

    <!-- Pied de page -->
    <footer class="site-footer">
        <div class="container footer-bottom">
            <p>&copy; 2026 Élégance Event. Tous droits réservés.</p>
            <ul class="footer-links-inline">
               <li><a href="<?= BASE_URL ?>/index.php?route=mentions">Mentions légales</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=privacy">Politique de confidentialité</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=cgu">Conditions d’utilisation</a></li>
                <li><a href="#">Presse</a></li>
            </ul>
        </div>
    </footer>

    <script src="<?= BASE_URL ?>/assets/js/scrypt.js"></script>
</body>

</html>