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

    $query = "UPDATE users
              SET username = :username,
                  email = :email,
                  role = :role
              WHERE user_id = :user_id";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':username' => $_POST['username'],
        ':email' => $_POST['email'],
        ':role' => $_POST['role'],
        ':user_id' => $id
    ]);

    header("Location: manage-users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User - OGR</title>
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
        <h2 class="fw-bold mb-4">Edit User</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control"
                    value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>

            <button class="btn btn-pink">Update User</button>
            <a href="manage-users.php" class="btn btn-outline-dark">Back</a>
        </form>
    </div>

</body>

</html>