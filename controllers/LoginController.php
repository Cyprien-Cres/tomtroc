<?php

class LoginController
{
    public function showLogin() : void
    {
        $view = new View("Login - Tom Troc");
        $view->render("login");
    }

    public function connectUser() : void
    {
        // On récupère les données du formulaire.
        $login = Utils::request("login");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($login) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $loginManager = new LoginManager();
        $user = $loginManager->getUserByLogin($login);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['login'] = $user->getLogin();
        $_SESSION['nickname'] = $user->getNickname();


        // On redirige vers la page home.
        Utils::redirect("home");
    }

    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    public function logout() : void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }
}