<section class="register_container">
    <div class="register">
        <div class="div_form" role="form" aria-label="Formulaire d'inscription">
            <h1>Inscription</h1>
            <form method="post" action="action=books">
                <div>
                    <label for="nickname">Pseudo</label>
                    <input type="text" id="nickname" name="nickname" required>
                </div>
                <div>
                    <label for="login">Adresse email</label>
                    <input type="email" id="login" name="login" required>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="action" value="addNewUser">
                <button type="submit" class="button_form">S'inscrire</button>

                <p class="link">Déjà inscrit ? <a href="./index.php?action=login">Connectez-vous</a></p>
            </form>
        </div>
        <div class="register_img">
            <img src="img/register/register.png" alt="Photo d'une bibliothèque">
        </div>
    </div>
</section>
