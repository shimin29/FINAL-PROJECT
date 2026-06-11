<?php

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($username && $email && $password) {

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
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg,
                    #1a1a28,
                    #2d1b45);
            min-height: 100vh;
        }

        .success-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .success-icon {
            font-size: 80px;
            color: #ff69b4;
        }

        .btn-login {
            background: #ff69b4;
            color: white;
            border: none;
        }

        .btn-login:hover {
            background: #ff4fa3;
            color: white;
        }

        .logo {
            color: #ff69b4;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container vh-100 d-flex justify-content-center align-items-center">

        <div class="success-card text-center">

            <h3 class="logo mb-4">
                <i class="bi bi-controller"></i> OGR
            </h3>

            <i class="bi bi-check-circle-fill success-icon"></i>

            <h1 class="fw-bold mt-4">
                Registration Successful!
            </h1>

            <p class="text-muted mt-3">
                Your account has been created successfully.
                You can now login and start reviewing your favorite games.
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">

                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-house"></i>
                    Home
                </a>

                <a href="login-form.php" class="btn btn-login">
                    Login Now
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>
    </div>
</body>

</html>