<?php

class RegisterManager extends AbstractEntityManager
{
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