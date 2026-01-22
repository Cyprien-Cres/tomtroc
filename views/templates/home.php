<?php
/**
 * Affichage des Users pour le test.
 */
?>

<section>
    <div class="userList">
        <?php foreach($users as $user) { ?>
            <div class="user">
                <h2><?= $user->getNickname() ?></h2>
                <p>Email: <?= $user->getLogin() ?></p>
            </div>
        <?php } ?>
    </div>
</section>