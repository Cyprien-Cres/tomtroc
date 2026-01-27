<?php
/**
 * Affichage de la page Home.
 */
?>
<section class="home_page">
    <section class="first_section">
        <div class="text_first_section">
            <h1>Rejoignez nos lecteurs passionnés</h1>
            <p>
                Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture.
                Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
            </p>
            <a href="./index.php?action=books">
                <button type="submit">Découvrir</button>
            </a>
        </div>
        <div class="img_first_section">
            <img class="men_books" src="img/home/hamza.png" alt="Hommes assis au milieu de livres" />
            <p>Hamza</p>
        </div>
    </section>
    <section class="second_section">
        <h2>Les derniers livres ajoutés</h2>
        <div class="books_card_container">
            <?php foreach($books as $book) { ?>
                <article class="book_card">
                    <?php if ($book->getAvailable() === 0): ?>
                    <p class="not_available">non dispo.</p>
                    <?php endif; ?>
                    <img src="img/books/<?= htmlspecialchars($book->getPhoto()) ?>.png" alt="Couverture du livre <?= htmlspecialchars($book->getTitle()) ?>" class="book_card_img"/>
                    <h3 class="book_card_title"><?= htmlspecialchars($book->getTitle()) ?></h3>
                    <p class="book_card_author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                    <p class="book_card_nickname">Vendu par : <?= htmlspecialchars($book->getNickname()) ?></p>
                </article>
            <?php } ?>
        </div>
        <a href="./index.php?action=books">
            <button type="submit">Voir tous les livres</button>
        </a>
    </section>
    <section class="third_section">
        <h2>Comment ça marche ?</h2>
        <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
        <div class="steps_container">
            <div class="step">
                <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            </div>
            <div class="step">
                <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            </div>
            <div class="step">
                <p>Parcourez les livres disponibles chez d'autres membres.</p>
            </div>
            <div class="step">
                <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
            </div>
        </div>
        <button type="submit">Voir tous les livres</button>
    </section>
    <section class="fourth_section">
        <img src="img/home/banner.png" alt="Bannière représentant une personne dans une bibliothèque" />
    </section>
    <section class="fifth_section">
        <h2>Nos Valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté.
            Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs.
            Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
        </p>
        <p>
            Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.
        </p>
        <p>
            Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter,
            de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
        </p>
        <div>
            <p>L'équipe Tom Troc</p>
            <img src="img/home/hearth.svg" alt="Photo de l'équipe Tom Troc" />
        </div>
    </section>
</section>