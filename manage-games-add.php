<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: login-form.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

// Get categories
$query = "SELECT * FROM categories ORDER BY category_name";
$stmt = $db->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Add Game
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $query = "INSERT INTO games
              (title, developer, release_date, description, category_id, image)
              VALUES
              (:title, :developer, :release_date, :description, :category_id, :image)";

    $stmt = $db->prepare($query);

    $stmt->execute([
        ':title' => $_POST['title'],
        ':developer' => $_POST['developer'],
        ':release_date' => $_POST['release_date'],
        ':description' => $_POST['description'],
        ':category_id' => $_POST['category_id'],
        ':image' => $_POST['image']
    ]);

    header("Location: manage-games.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Game - OGR</title>

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
                Add New Game
            </h2>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Game Title</label>
                    <input type="text"
                        name="title"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Developer</label>
                    <input type="text"
                        name="developer"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Release Date</label>
                    <input type="date"
                        name="release_date"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>

                    <select name="category_id"
                        class="form-select"
                        required>

                        <?php foreach ($categories as $category) { ?>

                            <option value="<?php echo $category['category_id']; ?>">
                                <?php echo $category['category_name']; ?>
                            </option>

                        <?php } ?>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Filename</label>

                    <input type="text"
                        name="image"
                        class="form-control"
                        placeholder="example.jpg"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control"
                        required></textarea>
                </div>

                <button type="submit"
                    class="btn btn-pink">
                    Add Game
                </button>

                <a href="manage-games.php"
                    class="btn btn-outline-dark">
                    Back
                </a>

            </form>

        </div>

    </div>

</body>

</html>