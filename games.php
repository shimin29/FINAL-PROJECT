<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$query = "SELECT games.*, categories.category_name
FROM games LEFT JOIN categories ON games.category_id = categories.category_id ";

$stmt = $db->prepare($query);
$stmt->execute();

$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Games - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg,
                    #f8f8fc,
                    #f1f2f9);
        }

        .game-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .game-card:hover {
            transform: translateY(-5px);
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

        .game-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            transition: .3s;
            overflow: hidden;
            height: 100%;
        }

        .game-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(255, 105, 180, .25);
        }

        .card-img-top {
            width: 100%;
            height: 235px;
            object-fit: cover;
            object-position: center;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .game-description {
            min-height: 75px;
        }

        .btn-pink {
            background: #ff69b4;
            color: white;
            border: none;
            margin-top: auto;
        }

        .btn-pink:hover {
            background: #ff4fa3;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container my-5">

        <h1 class="fw-bold">
            <i class="bi bi-controller"></i>
            All Games
        </h1>

        <p class="text-muted mb-4">
            Browse and discover your favorite games.
        </p>

        <div class="row g-4">
            

            <?php foreach ($games as $game) { ?>

                <div class="col-md-4">
                    <div class="card game-card h-100 ">
                        <img src="image/<?php echo $game['image']; ?>"
                            class="card-img-top"
                            alt="<?php echo $game['title']; ?>">

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

                            <p class="game-description">
                                <?php echo $game['description']; ?>
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