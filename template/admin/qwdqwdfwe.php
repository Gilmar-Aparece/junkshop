<table class="table">
  <thead>
  <tr>
            <th>#</th>
            <th>Borrower</th>
            <th>Loan Detail</th>
            <th>Payment Detail</th>
            <th>Status</th>
            <th>Action</th>
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
        // Calculate totals
        $total_payable = $row['amount'] + ($row['amount'] * ($row['lplan_interest'] / 100));
        $monthly_payable = $total_payable / $row['lplan_month'];
        $overdue_amount = isset($row['overdue_amount']) ? $row['overdue_amount'] : 0;

        echo '<tr>';
        echo '<td></td>';
        echo '<td>
                <p><small>Name: <strong>' . htmlspecialchars($row['lname'] . ', ' . $row['fname']) . '</strong></small></p>
                <p><small>Contact: <strong>' . htmlspecialchars($row['contact_no']) . '</strong></small></p>
                <p><small>Address: <strong>' . htmlspecialchars($row['address']) . '</strong></small></p>
              </td>';
        echo '<td>
                <p><small>Reference no: <strong>' . htmlspecialchars($row['ref_no']) . '</strong></small></p>
                <p><small>Loan Type: <strong>' . htmlspecialchars($row['ltype_name']) . '</strong></small></p>
                <p><small>Loan Plan: <strong>' . $row['lplan_month'] . ' months [' . $row['lplan_interest'] . '%, ' . $row['lplan_penalty'] . '%]</strong> interest, penalty</small></p>
              </td>';
        echo '<td>
                <p><small>Amount: <strong>&#8369; ' . number_format($row['amount'], 2) . '</strong></small></p>
                <p><small>Total Payable Amount: <strong>&#8369; ' . number_format($total_payable, 2) . '</strong></small></p>
                <p><small>Monthly Payable Amount: <strong>&#8369; ' . number_format($monthly_payable, 2) . '</strong></small></p>
                <p><small>Overdue Payable Amount: <strong>&#8369; ' . number_format($overdue_amount, 2) . '</strong></small></p>
              </td>';
        echo '<td><span style="font-weight: bold; color: green;">' . ucfirst($row['status']) . '</span></td>';
        echo '<td>
                <button style="padding: 5px 10px;">View</button>
                <button style="padding: 5px 10px; background-color: red; color: white;">Delete</button>
              </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6">No loan records found.</td></tr>';
}
?>
</tbody>

</table>