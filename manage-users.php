<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$query = "SELECT * FROM users ORDER BY user_id DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':user_id' => $id
    ]);

    header("Location: manage-users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Users - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f5f5;
        }

        .box {
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

        .badge-admin {
            background: #ff69b4;
        }

        .badge-user {
            background: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">
                <i class="bi bi-people"></i>
                Manage Users
            </h1>

            <div class="d-flex gap-2">

                <a href="manage-users-add.php" class="btn btn-pink">
                    <i class="bi bi-person-plus"></i>
                    Add User
                </a>

                <a href="dashboard.php" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left"></i>
                    Back to Dashboard
                </a>

            </div>
        </div>

        <div class="box">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user) { ?>

                        <tr>
                            <td><?php echo $user['user_id']; ?></td>

                            <td><?php echo $user['username']; ?></td>

                            <td><?php echo $user['email']; ?></td>

                            <td>
                                <?php if ($user['role'] == 'admin') { ?>
                                    <span class="badge badge-admin">Admin</span>
                                <?php } else { ?>
                                    <span class="badge badge-user">User</span>
                                <?php } ?>
                            </td>

                            <td class="text-end">

                                <a href="manage-users-edit.php?id=<?php echo $user['user_id']; ?>"
                                    class="btn btn-success btn-sm me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="manage-users-changepwd.php?id=<?php echo $user['user_id']; ?>"
                                    class="btn btn-warning btn-sm me-2">
                                    <i class="bi bi-key"></i>
                                </a>

                                <a href="manage-users.php?delete=<?php echo $user['user_id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

</body>

</html>