<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;

    if ($username && $email && $password && $confirm_password) {

        if ($password == $confirm_password) {

            $db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

            $query = "INSERT INTO users (username, email, password, role)
                      VALUES (:username, :email, :password, :role)";

            $stmt = $db->prepare($query);

            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_BCRYPT),
                ':role' => 'user'
            ]);

            header("Location: login-form.php");
            exit();
        } else {
            echo "<script>
                    alert('Password and Confirm Password do not match!');
                    window.location.href='register-form.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('Please fill in all fields!');
                window.location.href='register-form.php';
              </script>";
        exit();
    }
} else {
    header("Location: register-form.php");
    exit();
}
