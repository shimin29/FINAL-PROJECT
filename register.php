<?php

$username = isset($_POST['username']) ? $_POST['username'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$db = new PDO("mysql:host=localhost;dbname=final_project", "root");

$query = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";

$stmt = $db->prepare($query);
$stmt->execute(array(
    ':username' => $username,
    ':email' => $email,
    ':password' => password_hash($password, PASSWORD_BCRYPT),
    ':role' => 2
));

?>
<!DOCTYPE html>
<html lang="en">
    <title>Online Gaming Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
    <style type="text/css">
        body {
            background: #f1f1f1;
        }
    </style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User registered</title>
</head>

<body>
    <h1>User has been successfully registered.</h1>
   <div class="d-flex gap-3 align-items-center mx-auto pt-3"><a href="index.php" class="text-decoration-none small"><i class="bi bi-arrow-left-circle"></i> Go back</a>
        <a href="login-form.php" class="text-decoration-none small">Already have an account? Login here <i class="bi bi-arrow-right-circle"></i></a>
        </div>
    </div>
</body>

</html>