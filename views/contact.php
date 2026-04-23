<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élégance Event - Contact</title>
    <meta name="description" content="Contactez Élégance Event pour échanger autour de votre projet d'événement et demander un accompagnement sur mesure.">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/contact.css?v=<?= time() ?>">
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
                    <li><a href="<?= BASE_URL ?>/index.php?route=contact" aria-current="page">Contact</a></li>

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

    <main>

        <!-- Introduction -->
        <section class="contact-intro">
            <div class="container">
                <h1>Contact</h1>
                <p>
                    Échangeons autour de votre projet. Nous vous accompagnons avec une approche
                    simple, soignée et adaptée à l’univers de votre événement.
                </p>
            </div>
        </section>

        <!-- Section principale -->
        <section class="contact-main">
            <div class="container contact-layout">

                <!-- Formulaire -->
                <section class="contact-form-section">
                    <div class="contact-form-wrapper">
                        <h2>Parlons de votre projet</h2>
                        <p class="contact-form-intro">
                            Remplissez ce formulaire et nous reviendrons vers vous pour mieux
                            comprendre vos besoins et vous proposer une réponse adaptée.
                        </p>

                        <p class="required-note">
                            <span class="required">*</span> Champs obligatoires
                        </p>

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

                        <form action="" method="post" class="contact-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input
                                        type="text"
                                        id="nom"
                                        name="nom"
                                        placeholder="Votre nom"
                                        value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input
                                        type="text"
                                        id="prenom"
                                        name="prenom"
                                        placeholder="Votre prénom"
                                        value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-row">
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
                                    <label for="telephone">Téléphone</label>
                                    <input
                                        type="tel"
                                        id="telephone"
                                        name="telephone"
                                        placeholder="+33 6 00 00 00 00"
                                        value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sujet">Sujet</label>
                                <input
                                    type="text"
                                    id="sujet"
                                    name="sujet"
                                    placeholder="Objet de votre message"
                                    value="<?= htmlspecialchars($_POST['sujet'] ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <label for="message">Message <span class="required">*</span></label>
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="6"
                                    placeholder="Décrivez votre projet, vos envies ou vos besoins..."
                                    required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            </div>

                            <div class="form-group rgpd-group">
                                <label class="rgpd-label">
                                    <input
                                        type="checkbox"
                                        name="rgpd"
                                        value="1"
                                        <?= !empty($_POST['rgpd']) ? 'checked' : '' ?>
                                        required>
                                    J’accepte que mes données soient utilisées pour être recontacté dans le cadre de ma demande.
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Envoyer le message</button>
                        </form>
                    </div>
                </section>

                <!-- Informations / ambiance -->
                <aside class="contact-info-section">
                    <article class="contact-visual-card">
                        <img src="<?= BASE_URL ?>/assets/images/contact-hero.png" alt="Ambiance élégante d'événement avec décoration raffinée">
                        <div class="contact-visual-content">
                            <p class="contact-label">Élégance Event</p>
                            <h2>Un accompagnement pensé avec soin</h2>
                            <p>
                                Chaque projet est abordé avec attention, exigence et sens du détail
                                pour créer une expérience harmonieuse.
                            </p>
                        </div>
                    </article>

                    <article class="contact-details-card">
                        <h2>Informations de contact</h2>
                        <ul class="contact-details-list">
                            <li>
                                <strong>Adresse</strong><br>
                                12 rue de la Paix, 75002 Paris
                            </li>
                            <li>
                                <strong>Téléphone</strong><br>
                                <a href="tel:+33123456789">+33 1 23 45 67 89</a>
                            </li>
                            <li>
                                <strong>E-mail</strong><br>
                                <a href="mailto:contact@elegance-event.fr">contact@elegance-event.fr</a>
                            </li>
                            <li>
                                <strong>Horaires</strong><br>
                                Du lundi au vendredi, de 9h à 18h
                            </li>
                        </ul>
                    </article>

                    <article class="contact-quote-card">
                        <img src="<?= BASE_URL ?>/assets/images/contact-card.png" alt="Détail élégant en noir et blanc">
                        <div class="contact-quote-content">
                            <p>« L’élégance se révèle dans l’attention portée aux détails. »</p>
                        </div>
                    </article>
                </aside>

            </div>
        </section>

        <!-- Informations utiles -->
        <section class="contact-extra">
            <div class="container">
                <h2>Informations utiles</h2>
                <div class="contact-extra-grid">
                    <article class="extra-card">
                        <h3>Délai de réponse</h3>
                        <p>
                            Nous faisons notre possible pour répondre à vos demandes
                            dans un délai de 24 à 48 heures ouvrées.
                        </p>
                    </article>

                    <article class="extra-card">
                        <h3>Accompagnement personnalisé</h3>
                        <p>
                            Chaque demande est étudiée avec attention afin de proposer
                            une solution cohérente avec votre événement.
                        </p>
                    </article>

                    <article class="extra-card">
                        <h3>Devis sur mesure</h3>
                        <p>
                            Nos propositions sont adaptées à vos besoins, à votre style
                            et au niveau de service attendu.
                        </p>
                    </article>
                </div>
            </div>
        </section>

    </main>

    <!-- Pied de page -->
    <footer class="site-footer">
        <div class="container footer-bottom">
            <p>&copy; 2026 Élégance Event. Tous droits réservés.</p>
            <ul class="footer-links-inline">
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Confidentialité</a></li>
                <li><a href="#">Presse</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a></li>
            </ul>
        </div>
    </footer>

    <script src="<?= BASE_URL ?>/assets/js/scrypt.js"></script>
</body>

</html>