<?php
session_start();

if(isset($_GET['logout'])){
    if($_GET['logout'] == "true"){
        unset($_SESSION['user']);
        // header("Location: 11-login-form.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
</head>
<body>
    <h1>You have successfully been logged out.</h1>
    <h2><a href="./login-form.php">Click here to redirect to login page</a></h2>
</body>
</html>