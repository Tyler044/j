<?php
session_start();
include "db.php";

// Protect dashboard
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user safely
$result = $conn->query("SELECT * FROM users WHERE id='$user_id'");

if (!$result || $result->num_rows == 0) {
    die("User not found");
}

$user = $result->fetch_assoc();

$main = (float)($user['main_balance'] ?? 0);
$profit = (float)($user['profit_balance'] ?? 0);

// =======================
// SAFE HOURLY PROFIT SYSTEM
// =======================
if (!empty($user['investment_active']) && !empty($user['last_update'])) {

    $last = strtotime($user['last_update']);
    $now = time();

    if ($last !== false) {

        $secondsPassed = $now - $last;

        if ($secondsPassed >= 3600) {

            $hours = floor($secondsPassed / 3600);
            $rate = 0.005; // 0.5%

            $profit_gain = $main * $rate * $hours;
            $profit += $profit_gain;

            // Move time forward correctly
            $newLastUpdate = date("Y-m-d H:i:s", $last + ($hours * 3600));

            $stmt = $conn->prepare("UPDATE users SET profit_balance=?, last_update=? WHERE id=?");
            $stmt->bind_param("dsi", $profit, $newLastUpdate, $user_id);
            $stmt->execute();
        }
    }
}

// Fetch deposits
$deposits = $conn->query("SELECT * FROM deposits WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<!-- Top Bar -->
<div class="topbar">
  <button onclick="window.location.href='logout.php'">Logout</button>
</div>

<!-- Balance Card -->
<div class="card">
  <h2>Portfolio</h2>

  <div class="wallet">
    <p>Main Wallet</p>
    <span>$<?php echo $main; ?></span>
  </div>

  <div class="wallet">
    <p>Profit Wallet</p>
    <span>$<?php echo $profit; ?></span>
  </div>
</div>

<!-- Actions -->
<div class="actions">

  <!-- Start Investment -->
 <?php if (!empty($user['investment_active'])): ?>
    <button disabled>Progress...</button>
<?php else: ?>
    <button onclick="window.location.href='start.php'">Start</button>
<?php endif; ?>

  <!-- Deposit Form -->
  <form action="deposit.php" method="POST" enctype="multipart/form-data">
    <input type="number" name="amount" placeholder="Amount" required>
    <input type="file" name="receipt" required>
    <button type="submit">Deposit</button>
  </form>

</div>

<!-- Deposit History -->
<div class="card">
  <h3>Deposit History</h3>

  <?php
  if ($deposits && $deposits->num_rows > 0) {
      while ($d = $deposits->fetch_assoc()) {
          echo "Amount: $" . $d['amount'] . " - Status: " . $d['status'] . "<br>";
      }
  } else {
      echo "No deposits yet.";
  }
  ?>
</div>
<footer>
  <div class="container">
    <p>© <?php echo date("Y"); ?> LTE Global. All Rights Reserved.</p>
  </div>
</footer>

</body>
</html>