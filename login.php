<?php

session_start();

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new PDO("mysql:host=localhost;dbname=final_project", "root" , "");

    $query = "SELECT * FROM users WHERE username = :username";

    $stmt = $db->prepare($query);

    $stmt->execute([
        ':username' => $username
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        $is_password_match = password_verify($password, $user['password']);

        if ($is_password_match) {

            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: index.php");
            }

            exit();
        } else {
            header("Location: login-form.php?error=1");
            exit();
        }
    } else {
        header("Location: login-form.php?error=1");
        exit();
    }
} else {
    header("Location: login-form.php");
    exit();
}

?>