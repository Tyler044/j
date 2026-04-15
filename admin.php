<?php
include "db.php";

$result = $conn->query("SELECT * FROM deposits WHERE status='pending'");

while ($row = $result->fetch_assoc()) {
    echo $row['amount'] . " 
    <a href='approve.php?id=".$row['id']."'>Approve</a><br>";
}
?>