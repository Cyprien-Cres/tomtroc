<?php
/**
 * Entité Books : un book est défini par son id, un title, un author, une description, une photo, available= 1 ou 0 et un user_id.
 */
class Account extends AbstractEntity
{
    protected int $id;
    private string $username;
    private string $login;
    private string $date;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setEmail(string $login): void
    {
        $this->email = $login;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}