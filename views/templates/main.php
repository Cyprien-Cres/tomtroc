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
                    <p class="<?= (!isset($_GET['action']) || $_GET['action'] === 'home') ? 'active' : '' ?>">Accueil</p>
                </a>
            </li>
            <li>
                <a href="./index.php?action=books">
                    <p class="<?= isset($_GET['action']) && $_GET['action'] === 'books' ? 'active' : '' ?>">Nos livres à l'échange</p>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <?php if (isset($_SESSION['user'])): ?>
                <li>
                    <a href="./index.php?action=messaging&userRecipient=<?= isset($_SESSION['lastConversationUserId']) ? '&userRecipient=' . $_SESSION['lastConversationUserId'] : '' ?>">
                        <?php if ($_GET['action'] === 'messaging'): ?>
                        <img src="img/header/icon_messenger_bold.svg" class="icon">
                        <?php else: ?>
                        <img src="img/header/icon_messenger.svg" class="icon">
                        <?php endif; ?>
                        <p class="<?= $_GET['action'] === 'messaging' ? 'active' : '' ?>">Messagerie</p>
                        <p class="<?php echo (isset($_SESSION['unreadCounter']) && $_SESSION['unreadCounter'] > 0) ? 'notif_number' : 'all_read'?>"><?php echo $_SESSION['unreadCounter']?></p>
                    </a>
                </li>
                <li>
                    <a href="./index.php?action=account">
                        <img src="img/header/icon_account.svg" class="icon">
                        <p class="<?= $_GET['action'] === 'account' ? 'active' : '' ?>">Mon Compte</p>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=logout">
                        <p>Déconnexion</p>
                    </a>
                </li>
            <?php else: ?>
            <li>
                <a href="./index.php?action=register">
                    <p class="<?= isset($_GET['action']) && $_GET['action'] === 'register'
                    || isset($_GET['action']) && $_GET['action'] === 'login' ? 'active' : '' ?>">Connexion</p>
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