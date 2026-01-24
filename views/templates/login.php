<?php ?>

<section class="register">
    <div class="register_form">
        <h1>Connexion</h1>
        <form method="post" action="action=books">
            <div>
                <label for="login">Adresse email</label>
                <input type="email" id="login" name="login" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <input type="hidden" name="action" value="connectUser">
            <button type="submit">Se connecter</button>
        </form>
    </div>
    <div class="register_img">
        <img src="img/register/register.png" alt="Photo d'une bibliothèque">
    </div>
</section>
