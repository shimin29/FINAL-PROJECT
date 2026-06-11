<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Gaming Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    /* Body */
    body {
        background: #f5f5f5;
    }
    /* Sidebar */
    .sidebar {
        background: linear-gradient(180deg,
                #1a1a28 0%,
                #24243a 100%);
        min-height: 100vh;
        padding: 20px;
        border-right: 1px solid #2d2d44;
        font-size: 18px;
    }

    /* Main Menu */
    .sidebar-link {
        display: block;
        text-decoration: none;
        color: white;
        padding: 12px 15px;
        margin-bottom: 8px;
        border-radius: 8px;
        transition: 0.3s;
    }

    /* Hover */
    .sidebar-link:hover {
        color: #c77dff;
    }

    /* Active Page */
    .sidebar-link.active {
        color: #c77dff;
        font-weight: bold;
    }

    /* Icon */
    .sidebar-link i {
        width: 20px;
        margin-right: 10px;
        font-size: 18px;
    }

    /* Submenu */
    .submenu {
        list-style: none;
        padding-left: 0;
        margin-top: 5px;
    }

    .submenu li {
        margin-bottom: 5px;
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

    .submenu li a.active {
        color: #c77dff;
        font-weight: bold;
    }

    /* Logo */
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

    /* sidebar arrow moving */
    .arrow {
        transition: transform 0.3s ease;
    }

    .sidebar-link[aria-expanded="true"] .arrow {
        transform: rotate(180deg);
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar ">
                <!-- title name -->
                <a href="index.php" class="logo-link">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-bing fs-2"></i>
                        <h4 class="ms-1 mb-0 ">OGR</h4>
                    </div>
                </a>

                <!-- sidebar home -->
                <a href="index.php" class="sidebar-link">
                    <i class="bi bi-house me-2"></i>Home</a>

                <!-- sidebar game -->
                <a class="sidebar-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#gamesMenu" role="button"
                    aria-expanded="false">

                    <span><i class="bi bi-controller me-2"></i>Games</span><i class="bi bi-chevron-down arrow"></i></a>

                <div class="collapse" id="gamesMenu">
                    <ul class="submenu">
                        <li><a href="games.php">All Games</a></li>
                        <li><a href="games.php">Xbox/PlayStation</a></li>
                        <li><a href="games.php">Nnitendo</a></li>
                        <li><a href="games.php">PC</a></li>
                        <li><a href="games.php">Mobile Games</a></li>


                    </ul>
                </div>
                </a>

                <!-- sidebar review -->
                <a class="sidebar-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#reviewsMenu" role="button"
                    aria-expanded="false">
                    <span>
                        <i class="bi bi-chat-square-text me-2"></i>Reviews</span><i class="bi bi-chevron-down arrow"></i></a>

                <div class="collapse" id="reviewsMenu">
                    <ul class="submenu">
                        <li><a href="reviews.php">All Reviews</a></li>
                        <li><a href="manage-review.php">Write Review</a></li>
                        <li><a href="my-reviews.php">My Reviews</a></li>
                    </ul>
                </div>
                </a>

                <!-- sidebar setting -->
                <a class="sidebar-link d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse"
                    href="#settingMenu"
                    role="button"
                    aria-expanded="false">

                    <span>
                        <i class="bi bi-gear me-2"></i> Setting
                    </span>
                    <i class="bi bi-chevron-down arrow"></i></a>
                <div class="collapse" id="settingMenu">
                    <ul class="submenu">
                        <li><a href="manage-users.php/admin.php">Profile</a></li>
                        <li><a href="login-form.php">Login</a></li>
                        <li><a href="register-form.php">Register</a></li>
                    </ul>
                </div>
                </a>

                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="reviews.php" class="sidebar-link">My Reviews</a>
                <?php } ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <h1>Game Reviews Hub</h1>

                <!-- 游戏卡片放这里 -->
            </div>

        </div>
    </div>
</body>

</html>