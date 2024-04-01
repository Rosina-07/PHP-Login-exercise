<?php
session_start();

require_once 'Entities/User.php';
require_once 'Models/userModel.php';
require_once 'connectToDB.php';

$db = connectToDb();

$user = new userModel($db);
$user1 = $user->getUserById(1);

if (isset($_POST['submit'])) {
    $password = $user1->passWord;
    $userName = $user1->userName;
    $inputtedPassword = $_POST['password'];
    $inputtedUserName = $_POST['username'];
    if (($inputtedPassword === $password) && ($inputtedUserName === $userName)) {
        header('Location: account.php');
        $_SESSION['userid'] = $user1->id;
        $_SESSION['username'] = $user1->userName;
        $_SESSION['bio'] = $user1->bio;
    } else {
        echo '<p>Sorry - Username or Password invalid</p>';
    }
}
?>

<form method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" />

    <input type="submit" name="submit" value="Login" />
</form>



