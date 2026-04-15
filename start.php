<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if already active
$res = $conn->query("SELECT investment_active FROM users WHERE id='$user_id'");
$user = $res->fetch_assoc();

if ($user['investment_active'] == 1) {
    // Already started → do nothing
    header("Location: dashboard.php");
    exit();
}

// Activate investment
$conn->query("UPDATE users 
              SET investment_active = 1, last_update = NOW() 
              WHERE id='$user_id'");

header("Location: dashboard.php");
exit();
?>
<?php if (!empty($user['investment_active'])): ?>
    <button disabled style="background: gray;">Running...</button>
<?php else: ?>
    <button onclick="window.location.href='start.php'">Start</button>
<?php endif; ?>