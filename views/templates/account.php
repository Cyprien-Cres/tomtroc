<?php
/**
 * Affichage de la page Mon compte.
 */
?>
<section class="account">
    <h1>Mon compte</h1>
    <div class="account_detail">
        <div class="account_info">
            <img src="img/users/nathalire.png" alt="Icône utilisateur">
            <a>Modifier</a>
            <div class="separator"></div>
            <p><?php echo htmlspecialchars($_SESSION['nickname']);?></p>
            <p>Membre depuis </p>
            <p>BIBLIOTHEQUE</p>
            <p>
                <img src="img/account/book_logo.svg">
                <?php echo $count;?>
                livre<?php echo ($count > 1) ? 's' : ''; ?>
            </p>
        </div>
        <div class="account_form div_form">
            <h2>Vos informations personnelles</h2>
            <form method="post" action="action=account">
                <div>
                    <label for="login">Adresse email</label>
                    <input type="email" id="login" name="login" value="<?php echo htmlspecialchars($_SESSION['login']);?>" required>
                </div>
                <div>
                    <label for="password" value="">Mot de passe</label>
                    <input type="password" id="password" name="password" value="password" required>
                </div>
                <div>
                    <label for="nickname" value="">Pseudo</label>
                    <input type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($_SESSION['nickname']);?>" required>
                </div>
                <input type="hidden" name="action" value="connectUser">
                <button type="submit" class="button_account_form">Enregistrer</button>
            </form>
        </div>
    </div>
    <div class="account_books">
        <table>
            <thead>
                <tr class="radius_top">
                    <th class="th_img">PHOTO</th>
                    <th class="th_row">TITRE</th>
                    <th class="th_row">AUTEUR</th>
                    <th class="th_row">DESCRIPTION</th>
                    <th class="th_row">DISPONIBILITE</th>
                    <th class="th_row">ACTION</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr class="table_row radius_bottom">
                    <th class="th_img"><img src="img/books/<?php echo htmlspecialchars($book['photo']); ?>.png" alt="Couverture du livre <?php echo $book['title']; ?>"></th>
                    <th class="th_row change_weight"><?php echo htmlspecialchars($book['title']); ?></th>
                    <th class="th_row change_weight"><?php echo htmlspecialchars($book['author']); ?></th>
                    <th class="description_truncate th_row change_weight"><?php echo htmlspecialchars($book['description']); ?></th>
                    <th class="available_container th_row">
                        <?php if ($book['available'] === 0): ?>
                            <p class="not_available">non dispo.</p>
                        <?php else: ?>
                            <p class="available">disponible</p>
                        <?php endif; ?>
                    </th>
                    <th class="th_row form_container">
                        <form action="edition" method="post">
                            <button class="button_edition">
                                Éditer
                            </button>
                        </form>
                        <form action="delete" method="post">
                            <button class="button_delete">
                                Supprimer
                            </button>
                        </form>
                    </th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>