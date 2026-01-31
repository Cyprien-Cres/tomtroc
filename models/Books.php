<?php
/**
 * Entité Books : un book est défini par son id, un title, un author, une description, une photo, available= 1 ou 0 et un user_id.
 */
class Books extends AbstractEntity
{
    private string $title;
    private string $author;
    private string $description;
    private string $photo;
    private bool $available;
    private int $user_id;
    private string $nickname = '';
    private string $user_img = '';

    public function setTitle(?string $title) : void
    {
        $this->title = $title ?? '';
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setAuthor(?string $author) : void
    {
        $this->author = $author ?? '';
    }

    public function getAuthor() : string
    {
        return $this->author;
    }

    public function setAvailable(?bool $available) : void
    {
        $this->available = $available ?? true;
    }

    public function getAvailable() : bool
    {
        if ($this->available === true) {
            return 1;
        } else {
            return 0;
        }
    }

    public function setDescription(?string $description) : void
    {
        $this->description = $description ?? '';
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setPhoto(?string $photo) : void
    {
        $this->photo = $photo ?? '';
    }

    public function getPhoto() : string
    {
        return $this->photo;
    }

    public function setUserId(int $user_id) : void
    {
        $this->user_id = $user_id;
    }

    public function getUserId() : int
    {
        return $this->user_id;
    }

    public function setNickname(string $nickname) : void
    {
        $this->nickname = $nickname;
    }

    public function getNickname() : string
    {
        return $this->nickname;
    }

    public function setUserImg(string $user_img) : void
    {
        $this->user_img = $user_img;
    }

    public function getUserImg() : string
    {
        return $this->user_img;
    }
}