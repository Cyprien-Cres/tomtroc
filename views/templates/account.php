<?php
/**
 * Affichage de la page Mon compte.
 */
?>
<section class="account">
    <h1>Mon compte</h1>
    <div class="account_detail">
        <form role="form" aria-label="Modifier utilisateur" method="post" enctype="multipart/form-data">
            <div class="account_info">
                <img class="user_img"
                     src="img/users/<?php echo htmlspecialchars($_SESSION['user']->getUserImg())?>"
                     alt="Icône utilisateur">
                <div class="account_link">
                    <label for="fileToUpload">Modifier</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
                </div>
                <div class="separator"></div>
                <p class="nickname_account"><?php echo htmlspecialchars($_SESSION['user']->getNickname());?></p>
                <p class="date_create_account">
                    Membre depuis
                    <?php
                    $dateDay = new DateTime();
                    $dateCreation = new DateTime($_SESSION['user']->getDate());
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
                    <img aria-hidden="true" src="img/account/book_logo.svg" alt="Logo de livre">
                    <?php echo count($books) ?? 0;?>
                    livre<?php echo (count($books) > 1) ? 's' : ''; ?>
                </p>
            </div>
            <div class="account_form div_form">
                <h2>Vos informations personnelles</h2>
                <div>
                    <label for="login">Adresse email</label>
                    <input type="email" id="login" name="login" value="<?php echo htmlspecialchars($_SESSION['user']->getLogin());?>" required>
                </div>
                <div>
                    <label for="password" value="">Mot de passe</label>
                    <input type="password" id="password" name="password" value="password" required>
                </div>
                <div>
                    <label for="nickname" value="">Pseudo</label>
                    <input type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($_SESSION['user']->getNickname());?>" required>
                </div>
                <input type="hidden" name="id" value="<?= htmlspecialchars($_SESSION['user_id'] ?? '');?>">
                <input type="hidden" name="action" value="updateUser">
                <button type="submit" class="button_account_form">Enregistrer</button>
            </div>
        </form>
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
                    <th class="th_img"><img src="img/books/<?php echo htmlspecialchars($book->getPhoto()); ?>" alt="Couverture du livre <?php echo $book->getTitle(); ?>"></th>
                    <th class="th_row change_weight"><?php echo htmlspecialchars($book->getTitle()); ?></th>
                    <th class="th_row change_weight"><?php echo htmlspecialchars($book->getAuthor()); ?></th>
                    <th class="description_truncate th_row change_weight"><?php echo htmlspecialchars($book->getDescription()); ?></th>
                    <th class="available_container th_row">
                        <?php if ($book->getAvailable() === 0): ?>
                            <p class="not_available">non dispo.</p>
                        <?php else: ?>
                            <p class="available">disponible</p>
                        <?php endif; ?>
                    </th>
                    <th class="th_row form_container">
                        <a class="a_edition" href="./index.php?action=edit&idBook=<?= htmlspecialchars($book->getId() ?? '');?>">Éditer</a>
                        <form>
                            <input type="hidden" name="idBook" value="<?= htmlspecialchars($book->getId() ?? '');?>">
                            <input type="hidden" name="action" value="delete">
                            <button class="button_delete" type="submit">Supprimer</button>
                        </form>
                    </th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a class="a_add_book" href="./index.php?action=showAddBook">
        <button class="button_add_book" type="submit">
            Ajouter un livre
        </button>
    </a>
</section>

<script>
    document.getElementById('fileToUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const userImg = document.querySelector('.user_img');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                userImg.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>