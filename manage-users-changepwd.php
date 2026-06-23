<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->execute([
    ':user_id' => $id
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['password'] != $_POST['confirm_password']) {
        $error = "Password and Confirm Password do not match.";
    } else {
        $query = "UPDATE users SET password = :password WHERE user_id = :user_id";

        $stmt = $db->prepare($query);
        $stmt->execute([
            ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            ':user_id' => $id
        ]);

        header("Location: manage-users.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password - OGR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
        }

        .box {
            max-width: 700px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
        }

        .btn-pink {
            background: #ff69b4;
            color: white;
            border: none;
        }

        .btn-pink:hover {
            background: #ff4fa3;
            color: white;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2 class="fw-bold mb-2">Change Password</h2>
        <p class="text-muted mb-4">
            User: <?php echo $user['username']; ?>
        </p>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>

            <button class="btn btn-pink">Change Password</button>
            <a href="manage-users.php" class="btn btn-outline-dark">Back</a>
        </form>
    </div>

</body>

</html>