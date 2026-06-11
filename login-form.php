<?php
session_start();

if (isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Online Gaming Review</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #1a1a28, #2d1b45);
      min-height: 100vh;
    }

    .login-card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
    }

    .logo {
      color: #ff69b4;
      font-weight: bold;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px;
    }

    .form-control:focus {
      border-color: #ff69b4;
      box-shadow: 0 0 0 0.2rem rgba(255, 105, 180, .25);
    }

    .btn-login {
      background: #ff69b4;
      border: none;
      color: white;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
    }

    .btn-login:hover {
      background: #ff4fa3;
      color: white;
    }

    .bottom-link {
      color: #ff69b4;
      text-decoration: none;
    }

    .bottom-link:hover {
      color: #ff85c1;
    }

    .page-title {
      color: white;
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-md-5">

        <div class="text-center mb-4">
          <h1 class="logo">
            <i class="bi bi-bing"></i> OGR
          </h1>

          <h2 class="page-title">
            Game Review Login
          </h2>
        </div>

        <div class="card login-card p-4">

          <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
              Invalid username or password.
            </div>
          <?php } ?>

          <form method="POST" action="login.php">

            <div class="mb-3">
              <label for="username" class="form-label">
                Username
              </label>

              <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="Enter username"
                required>
            </div>

            <div class="mb-4">
              <label for="password" class="form-label">
                Password
              </label>

              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Enter password"
                required>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Login
              </button>
            </div>

          </form>

        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">

          <a href="index.php" class="bottom-link">
            <i class="bi bi-arrow-left-circle"></i>
            Go Back
          </a>

          <a href="register-form.php" class="bottom-link">
            Don't have an account? Sign up here
            <i class="bi bi-arrow-right-circle"></i>
          </a>

        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>