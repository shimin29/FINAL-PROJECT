<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$id = $_GET['id'];

$stmt = $db->prepare("SELECT * FROM games WHERE game_id = :game_id");
$stmt->execute([':game_id' => $id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM categories ORDER BY category_name");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $query = "UPDATE games
              SET title = :title,
                  developer = :developer,
                  release_date = :release_date,
                  description = :description,
                  category_id = :category_id,
                  image = :image
              WHERE game_id = :game_id";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':title' => $_POST['title'],
        ':developer' => $_POST['developer'],
        ':release_date' => $_POST['release_date'],
        ':description' => $_POST['description'],
        ':category_id' => $_POST['category_id'],
        ':image' => $_POST['image'],
        ':game_id' => $id
    ]);

    header("Location: manage-games.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Game - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }

        .box {
            max-width: 800px;
            margin: 50px auto;
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

        <div class="box">

            <h2 class="fw-bold mb-4">
                Edit Game
            </h2>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Game Title</label>
                    <input type="text" name="title" class="form-control"
                        value="<?php echo $game['title']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Developer</label>
                    <input type="text" name="developer" class="form-control"
                        value="<?php echo $game['developer']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Release Date</label>
                    <input type="date" name="release_date" class="form-control"
                        value="<?php echo $game['release_date']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>

                    <select name="category_id" class="form-select" required>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['category_id']; ?>"
                                <?php if ($game['category_id'] == $category['category_id']) echo 'selected'; ?>>
                                <?php echo $category['category_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Filename</label>
                    <input type="text" name="image" class="form-control"
                        value="<?php echo $game['image']; ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5" class="form-control" required><?php echo $game['description']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-pink">
                    Update Game
                </button>

                <a href="manage-games.php" class="btn btn-outline-dark">
                    Back
                </a>

            </form>

        </div>

    </div>

</body>

</html>