<?php

require_once 'Entities/User.php';
class userModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        $query = $this->db->prepare('SELECT `id`, `username`, `password`, `bio` FROM `users`;');
        $query->execute();
        $data = $query->fetchAll();

        return $this->hydrateMultipleUsers($data);
    }

    private function hydrateMultipleUsers(array $data): array
    {
        $users = [];
        foreach ($data as $user) {
            $users[] = new User($user['id'], $user['username'], $user['password'], $user['bio']);
        }
        return $users;
    }

    public function getUserById($id)
    {
        $query = $this->db->prepare('SELECT `id`, `username`, `password`, `bio` FROM `users` WHERE `id` = :id');
        $query->execute([
            ':id' => $id
        ]);
        $data = $query->fetch();

        return $this->hydrateSingleUser($data);
    }

    private function hydrateSingleUser(array $data): User
    {
        return new User($data['id'], $data['username'], $data['password'], $data['bio']);
    }

    public function checkUsernameExists()
    {
        $inputtedUsername = $_POST['username'];
        $query= $this->db->prepare('SELECT `username` FROM `users` WHERE `username` = :username');
        $query->execute([
            ':username' => $inputtedUsername
        ]);
        $data = $query->fetch();
        if (!$data === false) {
            echo 'Sorry - that username is already taken';
        }
    }

    public function registerUser()
    {
        $inputtedEmail = $_POST['email'];
        $inputtedPassword = $_POST['password'];

        $query = $this->db->prepare('INSERT INTO `users` (`email-address`,`password`) VALUES (:email, :password)');
        $query->execute([
            ':email' => $_POST['email'],
            ':password' => $_POST['password']
        ]);
        if ($_POST['username'])
        $data = $query->fetch();
        $_SESSION['userid'] = $data->id;
        header('Location: index.php');
    }

}