<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // Check password match
    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {

        // CHECK if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username or Email already exists!";
        } else {

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone, username, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fullname, $email, $phone, $username, $hashed_password);

            if ($stmt->execute()) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Something went wrong. Try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/register.css">
  <title>Investment Portal</title>
</head>

<body>

<header id="nav-header">
  <nav>
    <div class="logo-hold">
      <img src="images/logo.jpg" alt="LTE">
    </div>
    <ol class="nav-link">
      <li><a href="index.php">Home</a></li>
    </ol>
  </nav>
</header>

<main>
  <div class="box">
    <h2>Create Account</h2>

    <?php if (!empty($error)) : ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
      <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form action="register.php" method="POST">
      <input type="text" name="fullname" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm" placeholder="Confirm Password" required>

      <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</main>

<footer>
  <div class="container">
    <p>© <?php echo date("Y"); ?> LTE Global. All Rights Reserved.</p>
  </div>
</footer>

</body>
</html>