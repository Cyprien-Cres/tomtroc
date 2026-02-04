<?php

class AccountManager extends AbstractEntityManager
{
    public function getAllBooksForAccount(int $user_id): array
    {
        $sql = "SELECT books.*, 
            (SELECT COUNT(*) FROM books WHERE user_id = :user_id) as total_books
            FROM books
            WHERE books.user_id = :user_id";
        $result = $this->db->query($sql, ['user_id' => $user_id]);
        $books = $result->fetchAll();

        return [
            'books' => $books,
            'count' => !empty($books) ? (int) $books[0]['total_books'] : 0
        ];
    }

    public function getUserById(int $user_id): ?User
    {
        $sql = "SELECT id, nickname, user_img, `date` FROM users WHERE id = :user_id";
        $result = $this->db->query($sql, ['user_id' => $user_id]);
        $user = $result->fetch();

        if ($user) {
            return new User($user);
        }
        return null;
    }
}