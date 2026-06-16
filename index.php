<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Gaming Review</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f5f5;
        }

        .main-content {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }


        .sidebar {
            background: linear-gradient(180deg, #1a1a28 0%, #24243a 100%);
            min-height: 100%;
            padding: 20px;
            border-right: 1px solid #2d2d44;
            font-size: 18px;
        }

        .sidebar-link {
            display: block;
            text-decoration: none;
            color: white;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: #c77dff;
            font-weight: bold;
        }

        .sidebar-link i {
            width: 20px;
            margin-right: 10px;
            font-size: 18px;
        }

        .submenu {
            list-style: none;
            padding-left: 0;
            margin-top: 5px;
        }

        .submenu li a {
            display: block;
            width: 100%;
            padding: 10px 15px 10px 45px;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .submenu li a:hover {
            color: #c77dff;
        }

        .logo-link {
            text-decoration: none;
        }

        .logo-link,
        .logo-link i,
        .logo-link h4 {
            color: #ff69b4;
            transition: 0.3s;
        }

        .logo-link:hover,
        .logo-link:hover i,
        .logo-link:hover h4 {
            color: #ff85c1;
        }

        .arrow {
            transition: transform 0.3s ease;
        }

        .sidebar-link[aria-expanded="true"] .arrow {
            transform: rotate(180deg);
        }

        .topbar {
            background: white;
            border-radius: 16px;
            padding: 15px 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
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

        .card {
            border-radius: 18px;
            overflow: hidden;
            transition: .3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(255, 105, 180, .2);
        }

        .card-body {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 sidebar">

                <a href="index.php" class="logo-link">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-bing fs-2"></i>
                        <h4 class="ms-1 mb-0">OGR</h4>
                    </div>
                </a>

                <a href="index.php" class="sidebar-link active">
                    <i class="bi bi-house me-2"></i>Home
                </a>

                <a class="sidebar-link d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse"
                    href="#gamesMenu"
                    role="button"
                    aria-expanded="false">
                    <span><i class="bi bi-controller me-2"></i>Games</span>
                    <i class="bi bi-chevron-down arrow"></i>
                </a>

                <div class="collapse" id="gamesMenu">
                    <ul class="submenu">
                        <li><a href="games.php">All Games</a></li>
                        <li><a href="games.php?category=1">Action</a></li>
                        <li><a href="games.php?category=2">Adventure</a></li>
                        <li><a href="games.php?category=3">FPS</a></li>
                        <li><a href="games.php?category=4">RPG</a></li>
                        <li><a href="games.php?category=5">Survival</a></li>
                        <li><a href="games.php?category=6">Simulation</a></li>
                        <li><a href="games.php?category=7">Horror</a></li>
                        <li><a href="games.php?category=8">Racing</a></li>
                        <li><a href="games.php?category=9">Strategy</a></li>
                        <li><a href="games.php?category=10">Sports</a></li>
                        <li><a href="games.php?category=11">MOBA</a></li>
                    </ul>
                </div>

                <a class="sidebar-link d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse"
                    href="#reviewsMenu"
                    role="button"
                    aria-expanded="false">
                    <span><i class="bi bi-chat-square-text me-2"></i>Reviews</span>
                    <i class="bi bi-chevron-down arrow"></i>
                </a>

                <div class="collapse" id="reviewsMenu">
                    <ul class="submenu">
                        <li><a href="reviews.php">All Reviews</a></li>
                        <li><a href="write-review.php">Write Review</a></li>
                        <li><a href="my-review.php">My Reviews</a></li>
                    </ul>
                </div>

                <a href="my-favourites.php" class="sidebar-link">
                    <i class="bi bi-heart-fill"></i>
                     Favourites
                </a>

            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4 main-content">

                <div class="topbar d-flex justify-content-between align-items-center mb-4">

                    <h4 class="mb-0 fw-bold">
                        Online Gaming Review
                    </h4>

                    <div class="d-flex gap-2">
                        <?php if (isset($_SESSION['user'])) { ?>

                            <span class="align-self-center">
                                Hi, <?php echo $_SESSION['username']; ?>
                            </span>
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <a href="dashboard.php" class="btn btn-outline-dark">
                                    Dashboard
                                </a>
                            <?php } ?>
                            <a href="logout.php?logout=true" class="btn btn-outline-danger">
                                Logout
                            </a>

                        <?php } else { ?>

                            <a href="login-form.php" class="btn btn-outline-dark">
                                Login
                            </a>

                            <a href="register-form.php" class="btn btn-pink">
                                Sign Up
                            </a>

                        <?php } ?>
                    </div>
                </div>

                <div class="text-center py-5">
                    <h1 class="display-4 fw-bold">
                        🎮 Welcome to OGR
                    </h1>

                    <p class="lead text-muted">
                        Discover, review and explore your favorite games.
                    </p>

                    <div class="mt-4">
                        <a href="games.php" class="btn btn-pink btn-lg me-2">
                            Browse Games
                        </a>

                        <a href="reviews.php" class="btn btn-outline-dark btn-lg">
                            View Reviews
                        </a>
                    </div>

                    <hr class="my-5">

                    <h2 class="fw-bold mb-4 ">
                        Featured Games
                    </h2>

                    <div class="row g-4">

                        <div class="col-md-4">
                            <div class="card shadow border-0 h-100">
                                <img src="image/gta.jpg" class="card-img-top" style="height:220px; object-fit:cover;">

                                <div class="card-body">
                                    <h5 class="fw-bold">Grand Theft Auto V</h5>
                                    <p class="text-muted">
                                        Explore Los Santos in one of the most popular open-world games.
                                    </p>

                                    <a href="game-details.php?id=1" class="btn btn-pink">
                                        View Game
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow border-0 h-100">
                                <img src="image/valorant.jpg" class="card-img-top" style="height:220px; object-fit:cover;">

                                <div class="card-body">
                                    <h5 class="fw-bold">Valorant</h5>
                                    <p class="text-muted">
                                        Tactical FPS from Riot Games with agents and abilities.
                                    </p>

                                    <a href="game-details.php?id=3" class="btn btn-pink">
                                        View Game
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow border-0 h-100">
                                <img src="image/007.jpg" class="card-img-top" style="height:220px; object-fit:cover;">

                                <div class="card-body">
                                    <h5 class="fw-bold">007 First Light</h5>
                                    <p class="text-muted">
                                        An action-adventure spy game featuring James Bond.
                                    </p>

                                    <a href="game-details.php?id=34" class="btn btn-pink">
                                        View Game
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

</body>

</html>