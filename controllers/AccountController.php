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

        $booksManager = new BooksManager();
        $books = $booksManager->getAllBooksForAccount($id);

        $view = new View("Mon Compte - Tom Troc");
        $view->render("account", ['books' => $books]);
    }

    public function showAccountPublic() : void
    {
        $id = Utils::request("idUser", -1);

        $accountManager = new AccountManager();
        $user = $accountManager->getUserById($id);

        $booksManager = new BooksManager();
        $books = $booksManager->getAllBooksForAccount($id);

        $view = new View("Mon Compte - Tom Troc");
        $view->render("publicAccount", ['books' => $books] + ['user' => $user]);

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
        $user_id = $_SESSION['user']->getId();
        $login = Utils::request("login");
        $password = Utils::request("password");
        $nickname = Utils::request("nickname");
        $newFileName = null;

        // Récupérer l'ancienne photo avant mise à jour
        $accountManager = new AccountManager();
        $currentUser = $accountManager->getUserById($user_id);
        $oldPhoto = $currentUser->getUserImg();

        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
            $targetDir = "img/users/";
            $imageFileType = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));

            $newFileName = uniqid() . '.' . $imageFileType;
            $targetFile = $targetDir . $newFileName;

            $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
            if ($check !== false) {
                if ($_FILES['fileToUpload']['size'] <= 9000000) {
                    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
                            // Supprimer l'ancienne photo si elle existe
                            if ($oldPhoto && file_exists($targetDir . $oldPhoto)) {
                                unlink($targetDir . $oldPhoto);
                            }} else {
                            $newFileName = null;
                        }
                    } else {
                        $newFileName = null;
                    }
                } else {
                    $newFileName = null;
                }
            } else {
                $newFileName = null;
            }
        }

        $user = new User([
            'id' => $user_id,
            'login' => $login,
            'password' => $password,
            'nickname' => $nickname,
            'user_img' => $newFileName ?? $oldPhoto,
            'date' => $currentUser->getDate()
        ]);

        $userManager = new UserManager();
        $userManager->updateUser($user);

        $_SESSION['user'] = $user;

        Utils::redirect("account");
    }
}


