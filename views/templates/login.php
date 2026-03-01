<?php ?>

<section class="login_container">
    <div class="register">
        <div class="div_form" role="form" aria-label="Form de connexion">
            <h1>Connexion</h1>
            <form method="post">
                <div>
                    <label for="login">Adresse email</label>
                    <input type="email" id="login" name="login" class="<?php echo !empty($errorLogin) ? 'input_error' : ''; ?>">
                    <?php if (!empty($errorLogin)) : ?>
                        <div class="error_message" role="alert">
                            <?php echo htmlspecialchars($errorLogin); ?>
                        </div>
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
                <?php if (!empty($errors)) : ?>
                    <p class="error_message errors" role="alert">
                        <?php echo htmlspecialchars($errors); ?>
                    </p>
                <?php endif; ?>

                <button type="submit" class="button_form">Se connecter</button>
            </form>
        </div>
        <div class="register_img">
            <img src="img/register/register.png" alt="Photo d'une bibliothèque">
        </div>
    </div>
</section>
