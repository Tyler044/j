<div class="card">
  <h3>Deposit History</h3>

  <?php
  if ($deposits && $deposits->num_rows > 0) {
      while ($d = $deposits->fetch_assoc()) {

          $statusClass = "status-" . $d['status'];

          echo "<p>
                  💰 $" . $d['amount'] . "
                  <span class='$statusClass'>" . strtoupper($d['status']) . "</span>
                </p>";
      }
  } else {
      echo "<p>No deposits yet.</p>";
  }
  ?>
</div>