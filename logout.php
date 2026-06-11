<?php
session_start();

if (isset($_GET['logout'])) {
    if ($_GET['logout'] == "true") {
        unset($_SESSION['user']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg,
                    #1a1a28,
                    #2d1b45);
            min-height: 100vh;
        }

        .logout-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
        }

        .logo {
            color: #ff69b4;
            font-weight: bold;
        }

        .logout-icon {
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
    </style>
</head>

<body>

    <div class="container vh-100 d-flex justify-content-center align-items-center">

        <div class="logout-card text-center">

            <h2 class="logo mb-4">
                <i class="bi bi-bing"></i> OGR
            </h2>

            <i class="bi bi-box-arrow-right logout-icon"></i>

            <h1 class="fw-bold mt-4">
                Logged Out Successfully
            </h1>

            <p class="text-muted mt-3">
                You have been logged out of your account.
                Thank you for visiting Online Gaming Review.
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">

                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-house"></i>
                    Home
                </a>

                <a href="login-form.php" class="btn btn-login">
                    Login Again
                    <i class="bi bi-arrow-right-circle"></i>
                </a>

            </div>

        </div>

    </div>

</body>

</html>