<?php

class Messaging extends AbstractEntity
{
    protected int $id;
    private int $user_sender;
    private int $user_recipient;
    private string $content;
    private string $created_at;
    private string $nickname;
    private ?string $user_img;

    public function setUserSender(int $user_sender): void
    {
        $this->user_sender = $user_sender;
    }

    public function getUserSender(): int
    {
        return $this->user_sender;
    }

    public function setUserRecipient(int $user_recipient): void
    {
        $this->user_recipient = $user_recipient;
    }

    public function getUserRecipient(): int
    {
        return $this->user_recipient;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }


    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setUserImg(?string $user_img): void
    {
        $this->user_img = $user_img;
    }

    public function getUserImg(): ?string
    {
        return $this->user_img;
    }
}
