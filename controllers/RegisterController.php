<?php

class RegisterController
{
    /**
     * Affiche la page d'inscription.
     * @return void
     */
    public function showRegister() : void
    {
        $errors = "";
        $errorNickname = "";
        $errorLogin = "";
        $errorPassword = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nickname = Utils::request("nickname");
            $login = Utils::request("login");
            $password = Utils::request("password");

            if (empty($nickname)) {
                $errorNickname = "Le pseudo est requis.";
            }
            if (empty($login)) {
                $errorLogin = "L'identifiant est requis.";
            }
            if (empty($password)) {
                $errorPassword = "Le mot de passe est requis.";
            }

            if (empty($errorLogin)) {
                $registerManager = new RegisterManager();
                if ($registerManager->isLoginExists($login)) {
                    $errorLogin = "Cet email est déjà utilisé.";
                }
            }

            if (empty($errorNickname)) {
                $registerManager = new RegisterManager();
                if ($registerManager->isNicknameExists($nickname)) {
                    $errorNickname = "Ce pseudo est déjà utilisé.";
                }
            }

            if (empty($errorNickname) && empty($errorLogin) && empty($errorPassword)) {
                try {
                    $this->addNewUser($nickname, $login, $password);

                    Utils::redirect("login");
                    return;
                } catch (Exception $e) {
                    $errors = $e->getMessage();
                }
            }
        }

        $view = new View("Inscription - Tom Troc");

        $view->render("register", [
            'errors' => $errors,
            'errorNickname' => $errorNickname,
            'errorLogin' => $errorLogin,
            'errorPassword' => $errorPassword
        ]);
    }

    /**
     * Ajoute un nouvel utilisateur.
     * @return void
     * @throws Exception
     */
    public function addNewUser(string $nickname, string $login, string $password) : void
    {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $newUser = new Register([
            'nickname' => $nickname,
            'login' => $login,
            'password' => $hashedPassword
        ]);

        $registerManager = new RegisterManager();
        $result = $registerManager->addNewUser($newUser);

        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'inscription.");
        }
    }
}