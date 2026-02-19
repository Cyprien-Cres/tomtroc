<?php ?>

<section class="register_container">
    <div class="register">
        <div class="div_form" role="form" aria-label="Form de connexion">
            <h1>Connexion</h1>
            <form method="post" action="action=home">
                <div>
                    <label for="login">Adresse email</label>
                    <input type="email" id="login" name="login">
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password">
                </div>

                <input type="hidden" name="action" value="connectUser">
                <button type="submit" class="button_form">Se connecter</button>
            </form>
        </div>
        <div class="register_img">
            <img src="img/register/register.png" alt="Photo d'une bibliothèque">
        </div>
    </div>
</section>
