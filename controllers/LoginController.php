<?php

class LoginController
{
    public function showLogin() : void
    {
        $errors = "";
        $errorLogin = "";
        $errorPassword = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = Utils::request("login");
            $password = Utils::request("password");

            if (empty($login)) {
                $errorLogin = "L'identifiant est requis.";
            }
            if (empty($password)) {
                $errorPassword = "Le mot de passe est requis.";
            }

            if (empty($errorLogin) && empty($errorPassword)) {
                try {
                    $this->connectUser($login, $password);
                    Utils::redirect("account");
                    return;
                } catch (Exception $e) {
                    $errors = $e->getMessage();
                }
            }
        }

        $view = new View("Connexion - Tom Troc");
        $view->render("login", [
            'errors' => $errors,
            'errorLogin' => $errorLogin,
            'errorPassword' => $errorPassword
        ]);
    }

    public function connectUser(string $login, string $password) : void
    {
        $loginManager = new LoginManager();
        $user = $loginManager->getUserByLogin($login);

        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new Exception("L'utilisateur ou le mot de passe est incorrect.");
        }

        $_SESSION['user'] = $user;
    }


    public function logout() : void
    {
        // On déconnecte l'utilisateur.
        session_destroy();


        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }
}