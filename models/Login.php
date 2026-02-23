<?php

class Login extends AbstractEntity
{
    private string $login;
    private string $password;

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
}