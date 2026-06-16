<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$query = "SELECT favorites.*, games.*, categories.category_name
          FROM favorites
          LEFT JOIN games ON favorites.game_id = games.game_id
          LEFT JOIN categories ON games.category_id = categories.category_id
          WHERE favorites.user_id = :user_id
          ORDER BY favorites.favorite_id DESC";

$stmt = $db->prepare($query);
$stmt->execute([
    ':user_id' => $_SESSION['user_id']
]);

$favourites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Favourites - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }

        .game-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            overflow: hidden;
            height: 100%;
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .badge-category {
            background: #ff69b4;
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
            <h1 class="fw-bold">❤️ My Favourites</h1>

            <a href="index.php" class="btn btn-outline-dark">
                Back Home
            </a>
        </div>

        <?php if (count($favourites) == 0) { ?>
            <div class="alert alert-light text-center">
                You have no favourite games yet.
            </div>
        <?php } ?>

        <div class="row g-4">

            <?php foreach ($favourites as $game) { ?>

                <div class="col-md-4">
                    <div class="card game-card">

                        <img src="image/<?php echo $game['image']; ?>" class="card-img-top">

                        <div class="card-body">

                            <span class="badge badge-category mb-3">
                                <?php echo $game['category_name']; ?>
                            </span>

                            <h4 class="fw-bold">
                                <?php echo $game['title']; ?>
                            </h4>

                            <p class="text-muted mb-1">
                                <strong>Developer:</strong>
                                <?php echo $game['developer']; ?>
                            </p>

                            <p class="text-muted mb-3">
                                <strong>Release:</strong>
                                <?php echo $game['release_date']; ?>
                            </p>

                            <a href="game-details.php?id=<?php echo $game['game_id']; ?>" class="btn btn-pink">
                                View Details
                            </a>

                        </div>

                    </div>
                </div>

            <?php } ?>

        </div>

    </div>

</body>

</html>