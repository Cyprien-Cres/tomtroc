<section class="register_container">
    <div class="register">
        <div class="div_form" role="form" aria-label="Formulaire d'inscription">
            <h1>Inscription</h1>
            <form method="post">
                <div>
                    <label for="nickname">Pseudo</label>
                    <input type="text" id="nickname" name="nickname" class="<?php echo !empty($errorNickname) ? 'input_error' : ''; ?>">
                    <?php if (!empty($errorNickname)) : ?>
                        <p class="error_message" role="alert">
                            <?php echo htmlspecialchars($errorNickname); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="login">Adresse email</label>
                    <input type="email" id="login" name="login" class="<?php echo !empty($errorLogin) ? 'input_error' : ''; ?>">
                    <?php if (!empty($errorLogin)) : ?>
                        <p class="error_message" role="alert">
                            <?php echo htmlspecialchars($errorLogin); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="<?php echo !empty($errorPassword) ? 'input_error' : ''; ?>">
                    <?php if (!empty($errorPassword)) : ?>
                        <p class="error_message" role="alert">
                            <?php echo htmlspecialchars($errorPassword); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="button_form">S'inscrire</button>

                <p class="link">Déjà inscrit ? <a href="./index.php?action=login">Connectez-vous</a></p>
            </form>
        </div>
        <div class="register_img">
            <img src="img/register/register.png" alt="Photo d'une bibliothèque">
        </div>
    </div>
</section>
