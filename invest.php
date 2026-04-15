<?php
include "config.php";

if (isset($_POST['amount'])) {
    $amount = (float)$_POST['amount'];
    $user_id = $_SESSION['user_id'];

    // get current balance
    $result = $conn->query("SELECT main_balance, profit_balance FROM users WHERE id='$user_id'");
    $user = $result->fetch_assoc();

    $main = $user['main_balance'];
    $profit = $user['profit_balance'];

    if ($amount > 0 && $amount <= $main) {

        $newMain = $main - $amount;
        $gain = $amount * 0.1;
        $newProfit = $profit + $gain;

        $sql = "UPDATE users SET 
                main_balance = $newMain,
                profit_balance = $newProfit
                WHERE id = '$user_id'";

        $conn->query($sql);

    } else {
        echo "Insufficient balance";
        exit();
    }
}

header("Location: dashboard.php");
exit();
?>