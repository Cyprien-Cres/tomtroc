<?php
/**
 * Gestionnaire de l'entité Books.
 */
class BooksManager extends AbstractEntityManager
{
    public function getAllBooks() {
        $sql = "SELECT books.*, users.nickname as nickname
        FROM books 
        JOIN users ON books.user_id = users.id
        ORDER BY id DESC";
        $result = $this->db->query($sql);
        $books = [];
        while ($row = $result->fetch()) {
            $books[] = new Books($row);
        }
        return $books;
    }

    public function getAllBooksForHome(): array
    {
        $sql = "SELECT books.*, users.nickname as nickname
        FROM books 
        JOIN users ON books.user_id = users.id
        ORDER BY id DESC
        LIMIT 4";
        $result = $this->db->query($sql);
        $books = [];
        while ($row = $result->fetch()) {
            $books[] = new Books($row);
        }
        return $books;
    }

    public function getBookById(int $id) {
        $sql = "SELECT books.*, users.nickname as nickname, users.user_img as user_img
        FROM books 
        JOIN users ON books.user_id = users.id
        WHERE books.id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();

        if ($book) {
            return new Books($book);
        }

        return $book;
    }

    public function getAllBooksForAccount(int $user_id): array
    {
        $sql = "SELECT books.* FROM books WHERE books.user_id = :user_id";
        $result = $this->db->query($sql, ['user_id' => $user_id]);
        $books = [];
        while ($row = $result->fetch()) {
            $books[] = new Books($row);
        }
        return $books;
    }

    public function updateBook(Books $book)
    {
        $id = Utils::request("idBook", -1);

        $sql = "UPDATE books 
                SET title = :title,
                    author = :author, 
                    description = :description, 
                    available = :available,
                    photo = :photo
                WHERE id = :id";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'available' => $book->getAvailable(),
            'photo' => $book->getPhoto(),
            'id' => $id
        ]);
    }

    public function addBook(Books $book)
    {
        $sql = "INSERT INTO books (title, author, description, available, photo, user_id)
            VALUES (:title, :author, :description, :available, :photo, :user_id)";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'available' => $book->getAvailable(),
            'photo' => $book->getPhoto(),
            'user_id' => $book->getUserId()
        ]);
    }

    public function deleteBook(int $id) : void
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}