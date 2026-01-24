<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.
 *
 * Les variables qui doivent impérativement être définie sont :
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page.
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header role="banner">
    <img src="img/header/logo_tomtroc.png" class="logo" alt="Logo de Tomtroc">
    <nav role="navigation" aria-label="Main navigation">
        <ul class="nav-left">
            <li>
                <a href="./index.php?action=home">
                    <p>Acceuil</p>
                </a>
            </li>
            <li>
                <a href="./index.php?page=items">
                    <p>Nos livres à l'échange</p>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <?php if (isset($_SESSION['user'])): ?>
                <li>
                    <a href="./index.php?action=messenger">
                        <img src="img/header/icon_messenger.svg" class="icon">
                        <p>Messagerie</p>
                        <p class="notif_number">1</p>
                    </a>
                </li>
                <li>
                    <a href="./index.php?action=account">
                        <img src="img/header/icon_account.svg" class="icon">
                        <p>Mon Compte</p>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=logout">Déconnexion</a>
                </li>
            <?php else: ?>
            <li>
                <a href="./index.php?action=register">
                    <p>Connexion</p>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main role="main">
    <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
</main>

<footer role="contentinfo">
    <nav role="navigation" aria-label="Footer navigation">
        <ul class="nav-footer">
            <li>
                <a href="./index.php?action=">
                    <p>Politique de confidentialité</p>
                </a>
            </li>
            <li>
                <a href="./index.php?action=">
                    <p>Mentions légales</p>
                </a>
            </li>
            <li>
                <p>Tom Troc©</p>
            </li>
            <li>
                <img src="img/footer/icon_footer.svg" class="icon_footer">
            </li>
        </ul>
    </nav>
</footer>

</body>
</html>