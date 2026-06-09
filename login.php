<?php

session_start();

$username = isset($_POST['username'])
    ? $_POST['username']: null;

$password = isset($_POST['password'])
    ? $_POST['password']: null;

if (isset($_POST['username'])) {
    $db = new PDO(
        "mysql:host=localhost;dbname=final_project","root");

    $query = "SELECT * FROM users WHERE username=:username";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':username' => $username
    ]);

    $user = $stmt->fetchAll();

    if (count($user) > 0) {
        $is_password_match = password_verify(
            $password,
            $user[0]['password']
        );

        if ($is_password_match) {
            $_SESSION['user'] = $user[0];

            if ($user[0]['role'] == 'admin') {
                header("Location:dashboard.php");
            } else {
                header("Location: games.php");
            }

            exit();
        } else {
            echo "<h1>Wrong Password!</h1>";
            echo "<a href='login-form.php'>Try Again</a>";
        }
    } else {
        echo "<h1>User Not Found!</h1>";
        echo "<a href='login-form.php'>Try Again</a>";
    }
}
?>