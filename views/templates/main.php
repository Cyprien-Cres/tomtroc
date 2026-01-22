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
    <title>Tomtroc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<header>
    <nav>
    </nav>
    <h1>Tomtroc</h1>
</header>

<main>
    <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
</main>

<footer>
    <p>Copyright © Tomtroc 2026 - Cres Cyprien</p>
</footer>

</body>
</html>