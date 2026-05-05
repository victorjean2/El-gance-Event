<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions légales - Élégance Event</title>
    <meta name="description" content="Mentions légales du site Élégance Event">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/legal.css">
</head>

<body>

    <header>
        <nav>
            <a href="<?= BASE_URL ?>/index.php">Accueil</a>
            <a href="<?= BASE_URL ?>/index.php?route=services">Services</a>
            <a href="<?= BASE_URL ?>/index.php?route=contact">Contact</a>
        </nav>
    </header>

    <main class="legal-page container">
        <h1>Mentions légales</h1>

        <section>
            <h2>Éditeur du site</h2>
            <p>Le présent site, <strong>Élégance Event</strong>, est édité par :</p>
            <p>
                <strong>Nom / Raison sociale :</strong> [À compléter]<br>
                <strong>Statut juridique :</strong> [À compléter]<br>
                <strong>Adresse :</strong> [À compléter]<br>
                <strong>Téléphone :</strong> [À compléter]<br>
                <strong>Email :</strong> [À compléter]<br>
                <strong>SIREN / SIRET :</strong> [À compléter]<br>
                <strong>Numéro RCS :</strong> [À compléter si applicable]<br>
                <strong>TVA intracommunautaire :</strong> [À compléter si applicable]
            </p>
            <p><strong>Directeur de la publication :</strong> [À compléter]</p>
        </section>

        <section>
            <h2>Hébergement</h2>
            <p>
                <strong>Nom de l’hébergeur :</strong> [À compléter]<br>
                <strong>Adresse :</strong> [À compléter]<br>
                <strong>Téléphone :</strong> [À compléter]<br>
                <strong>Site web :</strong> [À compléter]
            </p>
        </section>

        <section>
            <h2>Création et développement</h2>
            <p>
                Le site Élégance Event a été conçu et développé dans le cadre d’un projet DWWM.<br>
                <strong>Technologies utilisées :</strong> PHP, MySQL, PDO, HTML, CSS, JavaScript.
            </p>
        </section>

        <section>
            <h2>Propriété intellectuelle</h2>
            <p>
                L’ensemble du contenu du site (textes, images, graphismes, logo, icônes, structure)
                est protégé par le droit de la propriété intellectuelle.
            </p>
            <p>
                Toute reproduction, représentation, modification ou exploitation, totale ou partielle,
                sans autorisation préalable, est interdite.
            </p>
        </section>

        <section>
            <h2>Responsabilité</h2>
            <p>
                L’éditeur du site s’efforce de fournir des informations aussi précises que possible.
                Toutefois, il ne pourra être tenu responsable des omissions, inexactitudes
                ou défauts de mise à jour.
            </p>
        </section>

        <section>
            <h2>Données personnelles</h2>
            <p>
                Le site peut collecter des données personnelles via :
            </p>
            <ul>
                <li>le formulaire de contact ;</li>
                <li>l’inscription utilisateur ;</li>
                <li>la connexion ;</li>
                <li>l’espace administrateur.</li>
            </ul>
            <p>
                Pour en savoir plus, consultez la
                <a href="<?= BASE_URL ?>/index.php?route=privacy">politique de confidentialité</a>.
            </p>
        </section>

        <section>
            <h2>Cookies</h2>
            <p>
                Le site peut utiliser des cookies nécessaires à son bon fonctionnement
                ainsi que, le cas échéant, des cookies de mesure d’audience ou de services tiers.
            </p>
        </section>

        <section>
            <h2>Droit applicable</h2>
            <p>
                Les présentes mentions légales sont soumises au droit français.
            </p>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Élégance Event</p>
        <a href="<?= BASE_URL ?>/index.php?route=mentions">Mentions légales</a>
        <a href="<?= BASE_URL ?>/index.php?route=privacy">Politique de confidentialité</a>
    </footer>

</body>
</html>