<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login-form.php");
    exit();
}

if ($_SESSION['user']['role'] != 'admin') {
    header("Location: games.php");
    exit();
}

$db = new PDO("mysql:host=localhost;dbname=final_project", "root", "");

$totalUsers = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalGames = $db->query("SELECT COUNT(*) FROM games")->fetchColumn();
$totalReviews = $db->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
$totalRatings = $db->query("SELECT COUNT(*) FROM ratings")->fetchColumn();
$totalFavorites = $db->query("SELECT COUNT(*) FROM favorites")->fetchColumn();
$totalCategories = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard - OGR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f5f8;
        }

        .top-banner {
            background: linear-gradient(135deg, #1a1a28, #2d1b45);
            color: white;
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 30px;
        }

        .logo {
            color: #ff69b4;
            font-weight: bold;
        }

        .stat-card {
            border: none;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 35px;
            color: #ff69b4;
        }

        .stat-number {
            font-size: 35px;
            font-weight: bold;
        }

        .manage-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .manage-card:hover {
            transform: translateY(-5px);
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

        <div class="top-banner">
            <h2 class="logo">
                <i class="bi bi-bing"></i> OGR
            </h2>

            <h1 class="fw-bold mt-3">
                Admin Dashboard
            </h1>

            <p class="mb-0">
                Welcome back, <?php echo $_SESSION['username']; ?>. Manage your system here.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <i class="bi bi-people-fill stat-icon"></i>
                    <div class="stat-number"><?php echo $totalUsers; ?></div>
                    <p class="text-muted mb-0">Total Users</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <i class="bi bi-controller stat-icon"></i>
                    <div class="stat-number"><?php echo $totalGames; ?></div>
                    <p class="text-muted mb-0">Total Games</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <i class="bi bi-chat-square-text-fill stat-icon"></i>
                    <div class="stat-number"><?php echo $totalReviews; ?></div>
                    <p class="text-muted mb-0">Total Reviews</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <i class="bi bi-star-fill stat-icon"></i>
                    <div class="stat-number"><?php echo $totalRatings; ?></div>
                    <p class="text-muted mb-0">Total Ratings</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <i class="bi bi-heart-fill stat-icon"></i>
                    <div class="stat-number"><?php echo $totalFavorites; ?></div>
                    <p class="text-muted mb-0">Total Favorites</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <i class="bi bi-tags-fill stat-icon"></i>
                    <div class="stat-number"><?php echo $totalCategories; ?></div>
                    <p class="text-muted mb-0">Total Categories</p>
                </div>
            </div>

        </div>

        <h3 class="fw-bold mt-5 mb-3">Management</h3>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card manage-card p-4">
                    <h5><i class="bi bi-people"></i> Manage Users</h5>
                    <p class="text-muted">View and manage registered users.</p>
                    <a href="manage-users.php" class="btn btn-pink">Open</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card manage-card p-4">
                    <h5><i class="bi bi-controller"></i> Manage Games</h5>
                    <p class="text-muted">Add, edit, and delete games.</p>
                    <a href="manage-games.php" class="btn btn-pink">Open</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card manage-card p-4">
                    <h5><i class="bi bi-chat-square-text"></i> Manage Reviews</h5>
                    <p class="text-muted">Check all user game reviews.</p>
                    <a href="manage-review.php" class="btn btn-pink">Open</a>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <a href="index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> View Website
            </a>

            <a href="logout.php" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>

    </div>

</body>

</html>