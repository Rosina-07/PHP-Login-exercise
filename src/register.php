<?php

session_start();

require_once 'connectToDB.php';
require_once 'Models/userModel.php';
require_once 'Entities/User.php';

$db = connectToDb();
$users = new userModel($db);

if (isset($_POST['submit'])) {
    $trialUserName = $_POST['username'];
    $query= $db->prepare('SELECT `username` FROM `users` WHERE `username` = :username');
    $query->execute([
        ':username' => $trialUserName
        ]);
    $data = $query->fetch();
        if ($data === false) {
            $query1 = $this->$db->prepare('INSERT INTO `users` (`username`,`password`,`bio`) VALUES (:username, :password, :bio)');
            $query1->execute([
                    ':username' => $_POST['username'],
                    ':password' => $_POST['password'],
                    ':bio' => $_POST['bio']
                    ]);
            $data1 = $query1->fetch();
            var_dump($data1);
            $_SESSION['userid'] = 1;
            echo header('Location: account.php');
        } else {
            echo 'Sorry - that username is already taken';
        }
}


?>

<h1>Register Now:</h1>
<form method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" />

    <label for="bio">Bio:</label>
    <input type="text" id="bio" name="bio" />

    <input type="submit" name="submit" value="Sign Up" />
</form>




