<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id == null) {
    header("Location: games.php");
    exit();
}

$query = "SELECT games.*, categories.category_name
          FROM games
          LEFT JOIN categories ON games.category_id = categories.category_id
          WHERE games.game_id = :game_id";

$stmt = $db->prepare($query);
$stmt->execute([
    ':game_id' => $id
]);

$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    echo "Game not found.";
    exit();
}

$query = "SELECT reviews.*, ratings.rating_value, users.username
          FROM reviews
          LEFT JOIN ratings
          ON reviews.user_id = ratings.user_id
          AND reviews.game_id = ratings.game_id
          LEFT JOIN users ON reviews.user_id = users.user_id
          WHERE reviews.game_id = :game_id
          ORDER BY reviews.review_id DESC";

$stmt = $db->prepare($query);
$stmt->execute([
    ':game_id' => $id
]);

$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $game['title']; ?> - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f5f5;
        }

        .game-box,
        .review-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
        }

        .game-img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 18px;
        }

        .badge-category {
            background: #ff69b4;
        }

        .stars {
            color: #ff69b4;
            font-size: 20px;
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
                <i class="bi bi-controller"></i>
                Game Details
            </h1>

            <a href="games.php" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left"></i>
                Back to Games
            </a>
        </div>

        <div class="game-box mb-5">

            <div class="row g-4 align-items-center">

                <div class="col-md-5">
                    <img src="image/<?php echo $game['image']; ?>" class="game-img">
                </div>

                <div class="col-md-7">

                    <span class="badge badge-category mb-3">
                        <?php echo $game['category_name']; ?>
                    </span>

                    <h2 class="fw-bold mb-3">
                        <?php echo $game['title']; ?>
                    </h2>

                    <p class="text-muted mb-2">
                        <strong>Developer:</strong>
                        <?php echo $game['developer']; ?>
                    </p>

                    <p class="text-muted mb-2">
                        <strong>Release Date:</strong>
                        <?php echo $game['release_date']; ?>
                    </p>

                    <p class="mt-4">
                        <?php echo $game['description']; ?>
                    </p>

                    <a href="write-review.php" class="btn btn-pink mt-3">
                        <i class="bi bi-pencil-square"></i>
                        Write Review
                    </a>
                    <a href="add-favorite.php?game_id=<?php echo $game['game_id']; ?>"
                        class="btn btn-outline-danger mt-3 ms-2">

                        <i class="bi bi-heart-fill"></i>
                        Add to Favorites

                    </a>

                </div>

            </div>

        </div>

        <h2 class="fw-bold mb-3">Reviews</h2>

        <?php if (count($reviews) == 0) { ?>
            <div class="alert alert-light text-center">
                No reviews for this game yet.
            </div>
        <?php } ?>

        <?php foreach ($reviews as $review) { ?>

            <div class="review-card mb-3">

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