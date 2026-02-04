<?php

class UserManager extends AbstractEntityManager
{
    public function updateUser(User $user) : void
    {
        $sql = "UPDATE users SET login = :login, password = :password, nickname = :nickname, user_img = :user_img WHERE id = :id";
        $this->db->query($sql, [
            ':login' => $_POST['login'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hasher le mot de passe
            ':nickname' => $_POST['nickname'],
            ':user_img' => $_POST['user_img'] ?? $user->getUserImg(), // Utiliser la valeur existante si non fournie
            ':id' => $user->getId()
        ]);
    }
}

