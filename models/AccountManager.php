<?php

class AccountManager extends AbstractEntityManager
{
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