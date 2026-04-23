<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élégance Event - Accueil</title>
    <meta name="description"
        content="Élégance Event vous accompagne dans l'organisation de vos événements avec des prestations élégantes et soignées.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

    <header class="site-header">
        <div class="container header-content">
            <a href="<?= BASE_URL ?>/index.php" class="logo">Élégance Event</a>

            <button class="burger" aria-label="Ouvrir le menu">☰</button>

            <nav class="main-nav" aria-label="Navigation principale">
                <ul class="nav-list">
                    <li><a href="<?= BASE_URL ?>/index.php" aria-current="page">Accueil</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=services">Services</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a></li>

                    <?php if (!empty($_SESSION['user'])): ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=cart">Panier</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=account">Mon compte</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=logout">Déconnexion</a></li>

                    <?php elseif (!empty($_SESSION['admin'])): ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=admin-dashboard">Admin</a></li>
                        <li><a href="<?= BASE_URL ?>/index.php?route=admin-logout">Déconnexion</a></li>

                    <?php else: ?>
                        <li><a href="<?= BASE_URL ?>/index.php?route=login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>

        <section class="hero">
            <div class="hero-image">
                <img src="<?= BASE_URL ?>/assets/images/image_accueil_1.png" alt="Décoration élégante">
            </div>

            <div class="hero-content container">

                <h1>Créez un événement inoubliable</h1>
                <p class="hero-text">
                    Élégance Event vous accompagne dans la création d’ambiances soignées.
                </p>
                <a href="<?= BASE_URL ?>/index.php?route=contact" class="btn btn-primary">
                    Demander un devis
                </a>
            </div>
        </section>

        <section class="services">
            <div class="container">
                <p class="section-subtitle">Nos services</p>
                <h2>Nos prestations</h2>

                <div class="services-grid">

                    <article class="service-card">
                        <img src="<?= BASE_URL ?>/assets/images/mobilier.png" alt="Mobilier">
                        <h3>Mobilier</h3>
                        <p>Tables, chaises et équipements élégants.</p>
                        <a href="<?= BASE_URL ?>/index.php?route=services">Voir plus</a>
                    </article>

                    <article class="service-card">
                        <img src="<?= BASE_URL ?>/assets/images/decoration.png" alt="Décoration">
                        <h3>Décoration</h3>
                        <p>Ambiances raffinées et harmonieuses.</p>
                        <a href="<?= BASE_URL ?>/index.php?route=services">Voir plus</a>
                    </article>

                    <article class="service-card">
                        <img src="<?= BASE_URL ?>/assets/images/traiteur.png" alt="Traiteur">
                        <h3>Traiteur</h3>
                        <p>Prestations conviviales et de qualité.</p>
                        <a href="<?= BASE_URL ?>/index.php?route=services">Voir plus</a>
                    </article>

                    <article class="service-card">
                        <img src="<?= BASE_URL ?>/assets/images/planning.png" alt="Planning">
                        <h3>Planning</h3>
                        <p>Organisation simplifiée de votre événement.</p>
                        <a href="<?= BASE_URL ?>/index.php?route=services">Voir plus</a>
                    </article>

                </div>
            </div>
        </section>

        <section class="highlight">
            <div class="highlight-image">
                <img src="<?= BASE_URL ?>/assets/images/citation.png" alt="Citation">
            </div>

            <div class="highlight-content container">
                <blockquote>
                    « L’élégance est la seule beauté qui ne se fane jamais. »
                </blockquote>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>Prêt à sublimer votre projet ?</h2>
                <p>Contactez-nous pour un devis personnalisé.</p>
                <a href="<?= BASE_URL ?>/index.php?route=contact" class="btn btn-primary">
                    Demander un devis
                </a>
            </div>
        </section>

    </main>

    <!-- Pied de page -->
    <footer class="site-footer">
        <div class="container footer-top">

            <div class="footer-column">
                <h2 class="footer-title">Élégance Event</h2>
                <p>
                    L’art de recevoir, avec une sélection rigoureuse et un sens du détail.
                </p>
            </div>

            <div class="footer-column">
                <h2 class="footer-title">L’agence</h2>
                <ul class="footer-links">
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Conditions d’utilisation</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h2 class="footer-title">Aide</h2>
                <ul class="footer-links">
                    <li><a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=services">Services</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?route=admin-login">Admin</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h2 class="footer-title">Newsletter</h2>
                <form action="#" method="post" class="newsletter-form">
                    <label for="email-newsletter" class="visually-hidden">Adresse e-mail</label>
                    <input type="email" id="email-newsletter" name="email" placeholder="Adresse e-mail">
                    <button type="submit">S’inscrire</button>
                </form>
            </div>

        </div>

        <div class="container footer-bottom">
            <p>&copy; 2026 Élégance Event. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="<?= BASE_URL ?>/assets/js/scrypt.js"></script>
</body>

</html>