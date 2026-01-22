<?php

class HomeController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $userManager = new UserManager();
        $users = $userManager->getAllUsers();

        $view = new View("Accueil");
        $view->render("home", ['users' => $users]);
    }
}
