<?php
class AccountController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showAccount() : void
    {
        $this->checkIfUserIsConnected();

        $id = $_SESSION['user']->getId();

        $accountManager = new AccountManager();
        $result = $accountManager->getAllBooksForAccount($id);

        $books = $result['books'];

        $count = $result['count'];

        $view = new View("Mon Compte - Tom Troc");
        $view->render("account", ['books' => $books] + ['count' => $count]);
    }

    public function showAccountPublic() : void
    {
        $id = Utils::request("idUser", -1);

        $accountManager = new AccountManager();
        $resultUser = $accountManager->getUserById($id);

        $accountManager = new AccountManager();
        $resultBook = $accountManager->getAllBooksForAccount($id);

        $books = $resultBook['books'];
        $count = $resultBook['count'];
        $user = $resultUser['user'];

        $view = new View("Mon Compte - Tom Troc");
        $view->render("publicAccount", ['books' => $books] + ['count' => $count] + ['user' => $user]);

    }

    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }
    }

    public function updateUser() : void
    {
        $this->checkIfUserIsConnected();


        $id = Utils::request("id", -1);
        $login = Utils::request("login");
        $password = Utils::request("password");
        $nickname = Utils::request("nickname");

        $user = new User([
            'id' => $id,
            'login' => $login,
            'password' => $password,
            'nickname' => $nickname
        ]);

        $userManager = new UserManager();
        $userManager->updateUser($user);

        $_SESSION['login'] = $_POST['login'];
        $_SESSION['nickname'] = $_POST['nickname'];

        // On redirige vers la page d'administration.
        Utils::redirect("account");
    }

    public function updateUserImg() : void {
        $this->checkIfUserIsConnected();

        if (isset($_FILES['img']) && $_FILES['user_img']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'books/';
            $fileName = uniqid() . '_' . basename($_FILES['user_img']['name']);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['user_img']['tmp_name'], $uploadFile)) {
                $accountManager = new AccountManager();
                $user = $_SESSION['user'];
                $user->setUserImg($uploadFile); // Supposez un setter pour user_img
                $accountManager->updateUserImg($user);
            }
        }

        Utils::redirect("account");
    }
}


