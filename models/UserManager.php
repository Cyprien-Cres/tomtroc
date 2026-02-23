<?php
class UserManager extends AbstractEntityManager
{
    public function updateUser(User $user) : ?User
    {
        // Construire la requête en fonction de la présence d'un nouveau mot de passe
        if (!empty($_POST['password']) && $_POST['password'] !== '********') {
            $sql = "UPDATE users SET login = :login, password = :password, nickname = :nickname, user_img = :user_img WHERE id = :id";
            $result = $this->db->query($sql, [
                ':login' => $_POST['login'],
                ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ':nickname' => $_POST['nickname'],
                ':user_img' => $_POST['user_img'] ?? $user->getUserImg(),
                ':id' => $user->getId()
            ]);
            $user = $result->fetch();
        } else {
            $sql = "UPDATE users SET login = :login, nickname = :nickname, user_img = :user_img WHERE id = :id";
            $result = $this->db->query($sql, [
                ':login' => $_POST['login'],
                ':nickname' => $_POST['nickname'],
                ':user_img' => $_POST['user_img'] ?? $user->getUserImg(),
                ':id' => $user->getId()
            ]);
            $user = $result->fetch();
        }

        if ($user) {
            return new User($user);
        }
        return null;
    }
}
