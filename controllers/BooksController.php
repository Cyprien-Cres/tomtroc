<?php

class BooksController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showBooks() : void
    {
        $search = Utils::request('search', '');

        $booksManager = new BooksManager();
        $allBooks = $booksManager->getAllBooks();

        if (!empty($search)) {
            $books = array_filter($allBooks, function($book) use ($search) {
                $titleMatch = stripos($book->getTitle(), $search) !== false;
                $authorMatch = stripos($book->getAuthor(), $search) !== false;
                $userMatch = stripos($book->getNickname(), $search) !== false;
                return $titleMatch || $authorMatch || $userMatch;
            });
            $books = array_values($books);
        } else {
            $books = $allBooks;
        }

        $view = new View("Livres - Tom Troc");
        $view->render("books", ['books' => $books]);
    }


    public function showBook() : void
    {
        $id = Utils::request("idBook", -1);

        $booksManager = new BooksManager();
        $book = $booksManager->getBookById($id);
        $oldPhoto = $book->getPhoto();

        $errors = "";
        $errorTitle = "";
        $errorAuthor = "";
        $errorDescription = "";
        $errorFile = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = Utils::request("title");
            $author = Utils::request("author");
            $description = Utils::request("description");
            $available = Utils::request("available");
            $newFileName = null;

            if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
                $targetDir = "img/books/";
                $imageFileType = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $imageFileType;
                $targetFile = $targetDir . $newFileName;

                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
                    if ($oldPhoto && file_exists($targetDir . $oldPhoto)) {
                        unlink($targetDir . $oldPhoto);
                    }
                } else {
                    $newFileName = null;
                }
            }

            if (empty($title)) {
                $errorTitle = "Le titre est requis.";
            }
            if (empty($author)) {
                $errorAuthor = "L'auteur est requis.";
            }
            if (empty($description)) {
                $errorDescription = "La description est requise.";
            }

            if (empty($errorTitle) && empty($errorAuthor) && empty($errorDescription) && empty($errorFile)) {
                try {
                    $this->updateBook($id, $title, $author, $description, $available, $newFileName, $oldPhoto);
                    Utils::redirect("account");
                    return;
                } catch (Exception $e) {
                    $errors = $e->getMessage();
                }
            }
        }

        $view = new View("Edit - Tom Troc");
        $view->render("edit", [
            'book' => $book,
            'errors' => $errors,
            'errorTitle' => $errorTitle,
            'errorAuthor' => $errorAuthor,
            'errorDescription' => $errorDescription,
            'errorFile' => $errorFile,
        ]);
    }

    public function showBookDetail() : void
    {
        $idBook = Utils::request('idBook', -1);

        $booksManager = new BooksManager();
        $book = $booksManager->getBookById($idBook);

        $view = new View("Livre - Tom Troc");
        $view->render("detailBook", ['book' => $book]);
    }

    public function updateBook(int $id, string $title, string $author, string $description, int $available, ?string $newFileName, ?string $oldPhoto) : void
    {
        $book = new Books([
            'id' => $id,
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'available' => $available,
            'photo' => $newFileName ?? $oldPhoto
        ]);

        $booksManager = new BooksManager();
        $booksManager->updateBook($book);
    }


    public function showAddBook() : void
    {
        $errors = "";
        $errorTitle = "";
        $errorAuthor = "";
        $errorDescription = "";
        $errorFile = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = Utils::request("title");
            $author = Utils::request("author");
            $description = Utils::request("description");
            $available = Utils::request("available");
            $newFileName = null;

            if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
                $targetDir = "img/books/";
                $imageFileType = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $imageFileType;
                $targetFile = $targetDir . $newFileName;

                if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
                    $newFileName = null;
                }
            }

            if (empty($title)) {
                $errorTitle = "Le titre est requis.";
            }
            if (empty($author)) {
                $errorAuthor = "L'auteur est requis.";
            }
            if (empty($description)) {
                $errorDescription = "La description est requise.";
            }

            if (empty($errorTitle) && empty($errorAuthor) && empty($errorDescription) && empty($errorFile)) {
                try {
                    $this->addBook($title, $author, $description, $available, $newFileName);
                    Utils::redirect("account");
                    return;
                } catch (Exception $e) {
                    $errors = $e->getMessage();
                }
            }
        }

        $view = new View("Ajouter un livre");
        $view->render("addBook", [
            'errors'           => $errors,
            'errorTitle'       => $errorTitle,
            'errorAuthor'      => $errorAuthor,
            'errorDescription' => $errorDescription,
            'errorFile'    => $errorFile,
        ]);
    }

    public function addBook(string $title, string $author, string $description, int $available, ?string $newFileName) : void
    {
        $book = new Books([
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'available' => $available,
            'photo' => $newFileName,
            'user_id' => $_SESSION['user']->getId()
        ]);

        $bookManager = new BooksManager();
        $bookManager->addBook($book);
    }

    public function deleteBook() : void
    {
        $id = Utils::request("idBook", -1);

        $bookManager = new BooksManager();

        // Récupérer la photo avant suppression
        $book = $bookManager->getBookById($id);
        $photo = $book->getPhoto();

        // Supprimer le livre de la base
        $bookManager->deleteBook($id);

        // Supprimer la photo du dossier si elle existe
        if ($photo && file_exists("img/books/" . $photo)) {
            unlink("img/books/" . $photo);
        }

        Utils::redirect("account");
    }
}