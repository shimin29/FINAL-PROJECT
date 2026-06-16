<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

// Delete review + rating
if (isset($_GET['delete'])) {
    $review_id = $_GET['delete'];

    $query = "SELECT user_id, game_id FROM reviews WHERE review_id = :review_id";
    $stmt = $db->prepare($query);
    $stmt->execute([':review_id' => $review_id]);
    $review = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($review) {
        $query = "DELETE FROM ratings WHERE user_id = :user_id AND game_id = :game_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':user_id' => $review['user_id'],
            ':game_id' => $review['game_id']
        ]);

        $query = "DELETE FROM reviews WHERE review_id = :review_id";
        $stmt = $db->prepare($query);
        $stmt->execute([':review_id' => $review_id]);
    }

    header("Location: manage-review.php");
    exit();
}

$query = "SELECT reviews.*, ratings.rating_value, games.title, users.username
          FROM reviews
          LEFT JOIN ratings 
          ON reviews.user_id = ratings.user_id 
          AND reviews.game_id = ratings.game_id
          LEFT JOIN games ON reviews.game_id = games.game_id
          LEFT JOIN users ON reviews.user_id = users.user_id
          ORDER BY reviews.review_id DESC";

$stmt = $db->prepare($query);
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Reviews - OGR</title>

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

        .stars {
            color: #ff69b4;
            font-size: 18px;
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

    <div class="container my-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">
                <i class="bi bi-chat-square-text"></i>
                Manage Reviews
            </h1>

            <a href="dashboard.php" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>

        <div class="box">

            <?php if (count($reviews) == 0) { ?>
                <div class="alert alert-light text-center">
                    No reviews yet.
                </div>
            <?php } else { ?>

                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Game</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($reviews as $review) { ?>
                            <tr>
                                <td><?php echo $review['review_id']; ?></td>
                                <td><?php echo $review['username']; ?></td>
                                <td><?php echo $review['title']; ?></td>

                                <td class="stars">
                                    <?php echo str_repeat("★", $review['rating_value']); ?>
                                    <?php echo str_repeat("☆", 5 - $review['rating_value']); ?>
                                </td>

                                <td><?php echo $review['review_text']; ?></td>
                                <td><?php echo $review['review_date']; ?></td>

                                <td class="text-end">
                                    <a href="manage-review.php?delete=<?php echo $review['review_id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this review?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            <?php } ?>

        </div>

    </div>

</body>

</html>