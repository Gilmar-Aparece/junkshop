<?php
require 'db/database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($conn, "SELECT * FROM pickup_requests WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if ($data):
?>
    <div class="receipt">
        <h3>Pickup Receipt</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($data['name']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($data['address']) ?></p>
        <p><strong>Contact:</strong> <?= htmlspecialchars($data['contact_number']) ?></p>
        <p><strong>Junk Type:</strong> <?= htmlspecialchars($data['junk_type']) ?></p>
        <p><strong>Weight (KL):</strong> <?= htmlspecialchars($data['kl']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($data['preferred_date']) ?></p>
    </div>
<?php
else:
    echo "<p>Receipt not found.</p>";
endif;
?>
