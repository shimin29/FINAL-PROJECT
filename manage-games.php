<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

// Delete game
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = "DELETE FROM games WHERE game_id = :game_id";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':game_id' => $id
    ]);

    header("Location: manage-games.php");
    exit();
}

$query = "SELECT games.*, categories.category_name
          FROM games
          LEFT JOIN categories ON games.category_id = categories.category_id
          ORDER BY games.game_id DESC";

$stmt = $db->prepare($query);
$stmt->execute();
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Games - OGR</title>

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

        .game-img {
            width: 80px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">
                <i class="bi bi-controller"></i>
                Manage Games
            </h1>

            <div class="d-flex gap-2">
                <a href="manage-games-add.php" class="btn btn-pink">
                    <i class="bi bi-plus-circle"></i>
                    Add Game
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
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Developer</th>
                        <th>Release Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($games as $game) { ?>

                        <tr>
                            <td><?php echo $game['game_id']; ?></td>

                            <td>
                                <img src="image/<?php echo $game['image']; ?>" class="game-img">
                            </td>

                            <td><?php echo $game['title']; ?></td>

                            <td>
                                <span class="badge bg-dark">
                                    <?php echo $game['category_name']; ?>
                                </span>
                            </td>

                            <td><?php echo $game['developer']; ?></td>

                            <td><?php echo $game['release_date']; ?></td>

                            <td class="text-end">
                                <a href="manage-games-edit.php?id=<?php echo $game['game_id']; ?>"
                                    class="btn btn-success btn-sm me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="manage-games.php?delete=<?php echo $game['game_id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this game?');">
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