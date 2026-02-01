<?php
/**
 * Affichage de la page Mon compte.
 */
?>
<section class="public_account">
    <div class="account_detail">
        <div class="account_info">
            <img class="user_img"
                 src="img/users/<?php echo htmlspecialchars($user['user_img'])?>"
                 alt="Icône utilisateur">
            <div class="separator"></div>
            <p class="nickname_account"><?php echo htmlspecialchars($user['nickname']);?></p>
            <p class="date_create_account">
                Membre depuis
                <?php
                $dateDay = new DateTime();
                $dateCreation = new DateTime($user['date']);
                $interval = $dateDay->diff($dateCreation);
                if ($interval->y > 0) {
                    echo $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
                } elseif ($interval->m > 0) {
                    echo $interval->m . ' mois';
                } elseif ($interval->d > 0) {
                    echo $interval->d . ' jour' . ($interval->d > 1 ? 's' : '');
                } else {
                    echo 'aujourd\'hui';
                }
                ?>
            </p>
            <p class="mini_title">BIBLIOTHEQUE</p>
            <p class="book_number">
                <img src="img/account/book_logo.svg">
                <?php echo $count;?>
                livre<?php echo ($count > 1) ? 's' : ''; ?>
            </p>
            <a href="./index.php?action=<?php echo (isset($_SESSION['user'])) ? 'message' : 'register'; ?>">
                <button type="submit" class="button_account_form public_account_button">Écrire un message</button>
            </a>
        </div>
    </div>
    <div class="public_account_books">
        <table class="table_public_account_books">
            <thead>
            <tr class="radius_top">
                <th class="th_img">PHOTO</th>
                <th class="th_row">TITRE</th>
                <th class="th_row">AUTEUR</th>
                <th class="th_row">DESCRIPTION</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr class="table_row radius_bottom">
                    <th class="th_img"><img src="img/books/<?php echo htmlspecialchars($book['photo']); ?>" alt="Couverture du livre <?php echo $book['title']; ?>"></th>
                    <th class="th_row change_weight"><?php echo htmlspecialchars($book['title']); ?></th>
                    <th class="th_row change_weight"><?php echo htmlspecialchars($book['author']); ?></th>
                    <th class="description_truncate th_row change_weight"><?php echo htmlspecialchars($book['description']); ?></th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
