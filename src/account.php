<?php

session_start();

if (!isset($_SESSION['userid'])){
    header('Location: login.php');
} else {
//    echo $_SESSION['username'] . $_SESSION['bio'];
}

?>

<h1>logged in</h1>
<a href="logout.php">Logout</a>


