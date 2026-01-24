<?php

class UserManager extends AbstractEntityManager
{
    /**
     * Récupère tous les utilisateurs.
     * @return array Tableau d'objets User.
     */
    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        $users = [];
        while ($row = $result->fetch()) {
            $users[] = new User($row);
        }
        return $users;
    }
}

