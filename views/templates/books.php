<section class="books_page">
    <div class="books_header">
        <h1>Nos livres à l'échange</h1>
        <form role="form" aria-label="Rechercher un livre" method="get" action="filterBooks">
            <input type="hidden" name="action" value="books" />
            <img src="img/books/search_logo.svg" alt="Icône de recherche" class="search_icon"/>
            <label class="hidden_label"  for="search_input">Rechercher un livre</label>
            <input class="filter_button" id="search_input" type="search" placeholder="Rechercher un livre" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"/>
        </form>
    </div>
    <div class="books_card_container">
        <?php foreach($books as $book) { ?>
            <a class="a_home" href="./index.php?action=detailBook&idBook=<?= htmlspecialchars($book->getId() ?? '');?>">
                <article class="book_card">
                    <?php if ($book->getAvailable() === false): ?>
                        <p class="not_available">non dispo.</p>
                    <?php endif; ?>
                    <img src="img/books/<?= htmlspecialchars($book->getPhoto()) ?>"
                         alt="Couverture du livre <?= htmlspecialchars($book->getTitle()) ?>" class="book_card_img"/>
                    <h2 class="book_card_title"><?= htmlspecialchars($book->getTitle()) ?></h2>
                    <p class="book_card_author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                    <p class="book_card_nickname">Vendu par : <?= htmlspecialchars($book->getNickname()) ?></p>
                </article>
            </a>
        <?php } ?>
    </div>
</section>
