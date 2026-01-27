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

        $id = $_SESSION['user_id'];

        $accountManager = new AccountManager();
        $result = $accountManager->getAllBooksForAccount($id);

        $books = $result['books'];

        $count = $result['count'];

        $view = new View("Mon Compte - Tom Troc");
        $view->render("account", ['books' => $books] + ['count' => $count]);
    }

    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }
    }
}
