<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login-form.php");
    exit();
}

?>

<h1>
Welcome <?= $_SESSION['user']['username']; ?>
</h1>

<h2>User Page</h2>

<a href="logout.php">
Logout
</a>