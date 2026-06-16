<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

// Get all games
$query = "SELECT * FROM games ORDER BY title";
$stmt = $db->prepare($query);
$stmt->execute();
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Submit review
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Insert review text
    $query = "INSERT INTO reviews (user_id, game_id, review_text, review_date)
              VALUES (:user_id, :game_id, :review_text, NOW())";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':user_id' => $_SESSION['user_id'],
        ':game_id' => $_POST['game_id'],
        ':review_text' => $_POST['review_text']
    ]);

    // Insert rating
    $query = "INSERT INTO ratings (user_id, game_id, rating_value, rating_date)
              VALUES (:user_id, :game_id, :rating_value, NOW())";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':user_id' => $_SESSION['user_id'],
        ':game_id' => $_POST['game_id'],
        ':rating_value' => $_POST['rating_value']
    ]);

    header("Location: my-review.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Write Review - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f5f5;
        }

        .review-box {
            max-width: 800px;
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

    <div class="container">

        <div class="review-box">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Write Review
                </h2>

                <a href="reviews.php" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
            </div>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Select Game</label>

                    <select name="game_id" class="form-select" required>
                        <?php foreach ($games as $game) { ?>
                            <option value="<?php echo $game['game_id']; ?>">
                                <?php echo $game['title']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating</label>

                    <select name="rating_value" class="form-select" required>
                        <option value="5">★★★★★ 5</option>
                        <option value="4">★★★★☆ 4</option>
                        <option value="3">★★★☆☆ 3</option>
                        <option value="2">★★☆☆☆ 2</option>
                        <option value="1">★☆☆☆☆ 1</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Review</label>

                    <textarea
                        name="review_text"
                        class="form-control"
                        rows="5"
                        placeholder="Write your review here..."
                        required></textarea>
                </div>

                <button type="submit" class="btn btn-pink">
                    <i class="bi bi-send"></i>
                    Submit Review
                </button>

            </form>

        </div>

    </div>

</body>

</html>