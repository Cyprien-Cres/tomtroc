<?php

class BooksController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showBooks() : void
    {
        $booksManager = new BooksManager();
        $books = $booksManager->getAllBooks();

        $view = new View("Livres - Tom Troc");
        $view->render("books", ['books' => $books]);
    }
}