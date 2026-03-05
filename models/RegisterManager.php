<?php

class RegisterManager extends AbstractEntityManager
{
    public function isLoginExists(string $login) : bool
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE login = :login";
        $result = $this->db->query($sql, ['login' => $login]);
        $row = $result->fetch();
        return $row['count'] > 0;
    }

    public function isNicknameExists(string $nickname) : bool
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE nickname = :nickname";
        $result = $this->db->query($sql, ['nickname' => $nickname]);
        $row = $result->fetch();
        return $row['count'] > 0;
    }

    public function addNewUser(Register $newUser) : bool
    {
        $sql = "INSERT INTO users (nickname, login, password) VALUES (:nickname, :login, :password)";
        $result = $this->db->query($sql, [
            'nickname' => $newUser->getNickname(),
            'login' => $newUser->getLogin(),
            'password' => $newUser->getPassword()
        ]);
        return $result->rowCount() > 0;
    }
}