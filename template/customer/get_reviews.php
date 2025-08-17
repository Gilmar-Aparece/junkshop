<?php
include '../db/database.php';

if (isset($_GET['collector_id'])) {
    $collector_id = intval($_GET['collector_id']);

    $sql = "SELECT r.rating, r.review_text, r.created_at, u.first_name 
            FROM reviews r
            JOIN users u ON r.customer_id = u.id
            WHERE r.collector_id = $collector_id
            ORDER BY r.created_at DESC";

    $result = mysqli_query($conn, $sql);
    $reviews = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }

    echo json_encode($reviews);
}
?>
