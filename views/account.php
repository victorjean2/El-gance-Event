<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte - Élégance Event</title>
    <meta name="description" content="Consultez votre espace personnel Élégance Event.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/account.css">
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
                        <li><a href="<?= BASE_URL ?>/index.php?route=cart">Panier</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=account">Mon compte</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=logout">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="account-page">
        <div class="container">

            <!-- HERO -->
            <section class="account-hero" aria-labelledby="account-title">
                <p class="account-label">Espace personnel</p>
                <h1 id="account-title">
                    Bonjour <?= htmlspecialchars($_SESSION['user']['firstname'] ?? '') ?>
                </h1>
                <p class="account-intro">
                    Bienvenue dans votre tableau de bord. Retrouvez ici vos informations,
                    vos accès rapides et le suivi de vos échanges avec Élégance Event.
                </p>
            </section>

            <!-- STATISTIQUES -->
            <section class="stats-grid" aria-label="Résumé du compte">
                <article class="stat-card">
                    <span class="stat-number">1</span>
                    <p class="stat-label">Compte actif</p>
                </article>

                <article class="stat-card">
                    <span class="stat-number">0</span>
                    <p class="stat-label">Demande de devis</p>
                </article>

                <article class="stat-card">
                    <span class="stat-number">0</span>
                    <p class="stat-label">Message enregistré</p>
                </article>
            </section>

            <!-- GRILLE PRINCIPALE -->
            <section class="dashboard-grid">

                <!-- PROFIL -->
                <article class="account-card profile-card" aria-labelledby="profile-title">
                    <h2 id="profile-title">Mes informations</h2>

                    <div class="profile-row">
                        <span class="profile-label">Nom</span>
                        <p class="profile-value"><?= htmlspecialchars($_SESSION['user']['lastname'] ?? '') ?></p>
                    </div>

                    <div class="profile-row">
                        <span class="profile-label">Prénom</span>
                        <p class="profile-value"><?= htmlspecialchars($_SESSION['user']['firstname'] ?? '') ?></p>
                    </div>

                    <div class="profile-row">
                        <span class="profile-label">Adresse e-mail</span>
                        <p class="profile-value"><?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></p>
                    </div>
                </article>

                <!-- ACTIONS RAPIDES -->
                <article class="account-card actions-card" aria-labelledby="actions-title">
                    <h2 id="actions-title">Actions rapides</h2>

                    <div class="actions-list">
                        <a class="action-link" href="<?= BASE_URL ?>/index.php?route=contact">
                            Envoyer un message
                        </a>

                        <a class="action-link" href="<?= BASE_URL ?>/index.php?route=services">
                            Découvrir les services
                        </a>

                        <a class="action-link" href="<?= BASE_URL ?>/index.php?route=cart">
                            Voir mon panier
                        </a>

                        <a class="action-link" href="#">
                            Faire une demande de devis
                        </a>

                        <a class="action-link logout-link" href="<?= BASE_URL ?>/index.php?route=logout">
                            Se déconnecter
                        </a>
                    </div>
                </article>

                <!-- SUIVI -->
                <article class="account-card timeline-card" aria-labelledby="timeline-title">
                    <h2 id="timeline-title">Suivi de mon espace</h2>

                    <ul class="timeline-list">
                        <li class="timeline-item">
                            <span class="timeline-dot"></span>
                            <div>
                                <h3>Compte créé</h3>
                                <p>Votre espace personnel est actif et prêt à être utilisé.</p>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <span class="timeline-dot"></span>
                            <div>
                                <h3>Prochaine étape</h3>
                                <p>Vous pourrez bientôt suivre vos demandes de contact et vos devis ici.</p>
                            </div>
                        </li>
                    </ul>
                </article>

                <!-- ESPACE CLIENT -->
                <article class="account-card info-card" aria-labelledby="space-title">
                    <h2 id="space-title">Mon espace client</h2>
                    <p>
                        Cet espace a été conçu pour centraliser vos échanges avec Élégance Event
                        et faciliter le suivi de vos projets.
                    </p>
                    <p>
                        À terme, vous pourrez y retrouver vos demandes de devis, l’historique
                        de vos messages, ainsi que les informations utiles à l’organisation
                        de vos événements.
                    </p>
                </article>

            </section>
        </div>
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