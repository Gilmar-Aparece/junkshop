<h4 class="mt-4">Loan Applications</h4>
<table class="table">
  <thead>
    <tr>
      <th>Ref No</th>
      <th>Loan Type</th>
      <th>Borrower</th>
      <th>Purpose</th>
      <th>Amount</th>
      <th>Loan Plan</th>
      <th>Status</th>
      <th>Date Released</th>
      <th>Date Created</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT loan.*, 
                    lt.ltype_name, 
                    lp.lplan_month, lp.lplan_interest, lp.lplan_penalty,
                    u.first_name, u.last_name
              FROM loan
              JOIN loan_type lt ON loan.ltype_id = lt.ltype_id
              JOIN loan_plan lp ON loan.lplan_id = lp.lplan_id
              JOIN borrower b ON loan.borrower_id = b.borrower_id
              JOIN users u ON b.collector_id = u.id
              ORDER BY loan.date_created DESC";
    
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$row['ref_no']}</td>";
            echo "<td>{$row['ltype_name']}</td>";
            echo "<td>{$row['first_name']} {$row['last_name']}</td>";
            echo "<td>{$row['purpose']}</td>";
            echo "<td>₱" . number_format($row['amount'], 2) . "</td>";
            echo "<td>{$row['lplan_month']} months</td>";
            echo "<td>" . ($row['status'] == 0 ? 'Pending' : 'Approved') . "</td>";
            echo "<td>{$row['date_released']}</td>";
            echo "<td>{$row['date_created']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9' style='text-align:center;'>No loan records found.</td></tr>";
    }
    ?>
  </tbody>
</table>
