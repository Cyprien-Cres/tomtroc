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
        $title = Utils::request("title");
        $author = Utils::request("author");
        $description = Utils::request("description");
        $available = Utils::request("available");
        $newFileName = null;

        // Récupérer l'ancienne photo avant mise à jour
        $booksManager = new BooksManager();
        $oldBook = $booksManager->getBookById($id);
        $oldPhoto = $oldBook->getPhoto();

        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
            $targetDir = "img/books/";
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

        $book = new Books([
            'id' => $id,
            'title' => $title,
            'author' => $author,
            'description' => $description,
            'available' => $available,
            'photo' => $newFileName ?? $oldPhoto
        ]);

        $booksManager->updateBook($book);
        Utils::redirect("account");
    }


    public function showAddBook() : void
    {
        // On redirige vers la page d'administration.
        $view = new View("Ajouter un livre");
        $view->render("addBook");
    }

    public function addBook() : void
    {
        $title = Utils::request("title");
        $author = Utils::request("author");
        $description = Utils::request("description");
        $available = Utils::request("available");
        $uploadedFile = null;
        $newFileName = null; // Initialisé à null

        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
            $targetDir = "img/books/";
            $imageFileType = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));

            // Générer le nom UNE SEULE FOIS ici
            $newFileName = uniqid() . '.' . $imageFileType;
            $targetFile = $targetDir . $newFileName;

            $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
            if ($check !== false) {
                if ($_FILES['fileToUpload']['size'] <= 9000000) {
                    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
                            $uploadedFile = $targetFile;
                        } else {
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

        Utils::redirect("account");
    }

    public function deleteBook() : void
    {
        $id = (int)($_GET['idBook'] ?? 0);

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