<?php

class BooksController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showBooks() : void
    {
        $userManager = new UserManager();
        $users = $userManager->getAllBooks();

        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }
}