<?php

class HomeController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $booksManager = new BooksManager();
        $books = $booksManager->getAllBooksForHome();

        $view = new View("Accueil - Tom Troc");
        $view->render("home", ['books' => $books]);
    }
}
