<?php
/**
 * Gestionnaire de l'entité Books.
 */
class BooksManager extends AbstractEntityManager
{
    public function getAllBooks() {
        $sql = "SELECT * FROM books ORDER BY id DESC";
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
}