<?php

readonly class User {

    public int $id;
    public string $userName;

    public string $passWord;

    public string $bio;

    public function __construct(int $id, string $userName, string $passWord, string $bio)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->bio = $bio;
    }

}