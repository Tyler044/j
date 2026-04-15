<?php
include "db.php";

$id = $_GET['id'];

// get deposit
$res = $conn->query("SELECT * FROM deposits WHERE id='$id'");
$data = $res->fetch_assoc();

$user_id = $data['user_id'];
$amount = $data['amount'];

// update user balance
$conn->query("UPDATE users 
              SET main_balance = main_balance + $amount 
              WHERE id='$user_id'");

// mark approved
$conn->query("UPDATE deposits SET status='approved' WHERE id='$id'");

header("Location: admin.php");
?>