<?php
// Start the session to store login status
session_start();

// Include the database connection
include('assets/php/dbconn.php');

// Check if the user is already logged in, if yes, redirect to index.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

$errorMessage = ""; // Initialize error message

// Handle the login process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve login credentials from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare the SQL query to check if the credentials exist
    $query = "SELECT * FROM login WHERE uname = :uname";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':uname', $username);
    $stmt->execute();

    // Check if the user exists
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verify the entered password with the hashed password
        if (password_verify($password, $user['pass'])) {
            // Set session variables upon successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Redirect to index.php
            header("Location: index.php");
            exit;
        } else {
            $errorMessage = "Invalid password!";
        }
    } else {
        $errorMessage = "Invalid username!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJMSOM Office Portal - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Center the logo and make it larger */
        .logo {
            max-width: 200px; /* Adjust this value to your preferred size */
            display: block;
            margin: 0 auto 20px auto;
        }
    </style>

</head>
<body>
    <div class="container mt-5">
    <div class="row">
            <!-- Top bar with logo centered -->
            <div class="col-12 text-center">
                <!-- Logo centered and larger -->
                <img src="assets/logos/SOM-IITB.png" alt="Logo" class="logo">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h4 mb-0">SJMSOM Inward/Outward Portal</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($errorMessage)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($errorMessage) ?>
                            </div>
                        <?php endif; ?>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="/" class="btn btn-link">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
