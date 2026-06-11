<!DOCTYPE html>
<html>

<head>
    <title>Online Gaming Review</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg,
                    #1a1a28,
                    #2d1b45);
            min-height: 100vh;
        }

        .register-card {
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

        .btn-signup {
            background: #ff69b4;
            border: none;
            color: white;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
        }

        .btn-signup:hover {
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

        .card-subtitle {
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h1 class="logo"><i class="bi bi-bing"></i>OGR</h1>
                    <h2 class="page-title">Create Your Account</h2>
                </div>

                <div class="card register-card p-4">
                    <div class="text-center mb-4">
                        <h4>Sign Up</h4>
                        <p class="card-subtitle">Join OGR and start sharing your game reviews.</p>
                    </div>

                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label class="form-label">Username</label>

                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"> Email Address </label>

                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"> Password </label>

                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label"> Confirm Password </label>

                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-signup">
                                <i class="bi bi-person-plus"></i> Sign Up
                            </button>
                        </div>
                    </form>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="index.php" class="bottom-link">
                        <i class="bi bi-arrow-left-circle"></i> Go Back
                    </a>

                    <a href="login-form.php" class="bottom-link">
                        Already have an account? Login Here
                        <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>