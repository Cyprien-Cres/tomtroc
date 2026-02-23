<?php

class LoginManager extends AbstractEntityManager
{
    /**
     * Récupère un user par son login.
     * @param string $login
     */
    public function getUserByLogin(string $login) : ?User
    {
        $sql = "SELECT * FROM users WHERE login = :login";
        $result = $this->db->query($sql, ['login' => $login]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }
}