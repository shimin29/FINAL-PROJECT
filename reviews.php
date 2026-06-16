<?php
session_start();

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$query = "SELECT reviews.*, ratings.rating_value, games.title, users.username FROM reviews  LEFT JOIN ratings   ON reviews.user_id = ratings.user_id 
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
    <title>All Reviews - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f5f5;
        }

        .review-card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            margin-bottom: 20px;
        }

        .stars {
            color: #ff69b4;
            font-size: 22px;
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
                All Reviews
            </h1>

            <div class="d-flex gap-2">
                <a href="write-review.php" class="btn btn-pink">
                    <i class="bi bi-pencil-square"></i>
                    Write Review
                </a>

                <a href="index.php" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left"></i>
                    Back Home
                </a>
            </div>
        </div>

        <?php if (count($reviews) == 0) { ?>

            <div class="alert alert-light text-center">
                No reviews yet.
            </div>

        <?php } ?>

        <?php foreach ($reviews as $review) { ?>

            <div class="review-card">

                <h4 class="fw-bold mb-1">
                    <?php echo $review['title']; ?>
                </h4>

                <div class="stars mb-2">
                    <?php echo str_repeat("★", $review['rating_value']); ?>
                    <?php echo str_repeat("☆", 5 - $review['rating_value']); ?>
                </div>

                <p class="mb-3">
                    <?php echo $review['review_text']; ?>
                </p>

                <small class="text-muted">
                    By <?php echo $review['username']; ?>
                    |
                    <?php echo $review['review_date']; ?>
                </small>

            </div>

        <?php } ?>

    </div>

</body>

</html>