<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */
class User extends AbstractEntity
{
    private string $login;
    private string $password;
    private string $nickname;
    private string $user_img;
    private string $date;

    /**
     * Setter pour le login.
     * @param string $login
     */
    public function setLogin(string $login) : void
    {
        $this->login = $login;
    }

    /**
     * Getter pour le login.
     * @return string
     */
    public function getLogin() : string
    {
        return $this->login;
    }

    public function setNickname (string $nickname) : void
    {
        $this->nickname = $nickname;
    }

    public function getNickname () : string
    {
        return $this->nickname;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }
    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    public function setUserImg (string $user_img) : void
    {
        $this->user_img = $user_img;
    }

    public function getUserImg() : string
    {
        return $this->user_img;
    }

    public function setDate(string $date) : void
    {
        $this->date = $date;
    }

    public function getDate() : string
    {
        return $this->date;
    }
}