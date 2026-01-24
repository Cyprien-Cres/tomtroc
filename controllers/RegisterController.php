<?php

class RegisterController
{
    /**
     * Affiche la page d'inscription.
     * @return void
     */
    public function showRegister() : void
    {
        $view = new View("Inscription - Tom Troc");
        $view->render("register");
    }

    /**
     * Ajoute un nouvel utilisateur.
     * @return void
     * @throws Exception
     */
    public function addNewUser() : void
    {
        // Récupération des données du formulaire.
        $nickname = Utils::request("nickname");
        $login = Utils::request("login");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($nickname) || empty($login) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        //Hashage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // On crée l'objet User.
        $newUser = new Register([
            'nickname' => $nickname,
            'login' => $login,
            'password' => $hashedPassword
        ]);

        // On vérifie que l'article existe.
        $registerManager = new RegisterManager();
        $newUser = $registerManager->addNewUser($newUser);
        if (!$newUser) {
            throw new Exception("Une erreur est survenue lors de l'inscription.");
        }

        // On redirige vers la page de Home.
        Utils::redirect("home");
    }
}