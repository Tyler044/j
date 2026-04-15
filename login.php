<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Get user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? OR username=?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {

            // Save session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $user['username'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "❌ Incorrect email and password!";
        }

    } else {
        $error = "❌ User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>

<header id="nav-header">
    <nav>
        <div class="logo">
            <div class="logo-hold">
                <img src="images/logo.jpg" alt="LTE">
            </div>
        </div>
        <ol class="nav-link">
            <li><a href="index.php">Home</a></li>
        </ol>
    </nav>
</header>

<main class="login-container">
    <form class="login-form" method="POST">
        <h1>Welcome Back</h2>

        <?php if (!empty($error)) : ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <input type="email" placeholder="email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        
        <button type="submit">Login</button>
        
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</main>

<footer>
    <div class="container">
        <p>© <?php echo date("Y"); ?> LTE Global. All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>