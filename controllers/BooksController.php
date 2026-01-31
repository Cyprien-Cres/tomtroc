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

    public function showBook() : void
    {
        $idBook = Utils::request('idBook', -1);

        $booksManager = new BooksManager();
        $book = $booksManager->getBookById($idBook);

        $view = new View("Edit - Tom Troc");
        $view->render("edit", ['book' => $book]);
    }

    public function showBookDetail() : void
    {
        $idBook = Utils::request('idBook', -1);

        $booksManager = new BooksManager();
        $book = $booksManager->getBookById($idBook);

        $view = new View("Livre - Tom Troc");
        $view->render("detailBook", ['book' => $book]);
    }

    public function updateBook() : void
    {

        $id = Utils::request("idBook", -1);
        $author = Utils::request("author");
        $description = Utils::request("description");
        $available = Utils::request("available");

        $book = new Books([
            'id' => $id,
            'author' => $author,
            'description' => $description,
            'available' => $available
        ]);

        $bookManager = new BooksManager();
        $bookManager->updateBook($book);

        // On redirige vers la page d'administration.
        Utils::redirect("account");
    }

    public function showAddBook() : void
    {
        // On redirige vers la page d'administration.
        $view = new View("Ajouter un livre");
        $view->render("addBook");
    }

    public function showDetailBook() : void
    {
        // On redirige vers la page d'administration.
        $view = new View("Ajouter un livre");
        $view->render("detailBook");
    }

    public function addBook() : void
    {
        $title = Utils::request("title");
        $author = Utils::request("author");
        $description = Utils::request("description");
        $available = Utils::request("available");
        $photo = Utils::request("fileToUpload");

        $book = new Books([
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'available' => $available,
            'photo' => $photo,
            'user_id' => $_SESSION['user']->getId()
        ]);

        $bookManager = new BooksManager();
        $bookManager->addBook($book);

        // On redirige vers la page d'administration.
        Utils::redirect("account");
    }

    public function deleteBook() : void
    {
        $id = (int)($_GET['idBook'] ?? 0);

        // On supprime l'article.
        $bookManager = new BooksManager();
        $bookManager->deleteBook($id);

        // On redirige vers la page d'administration.
        Utils::redirect("account");
    }
}