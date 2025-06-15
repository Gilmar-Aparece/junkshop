<?php
include '../db/database.php';
session_start();

$customer_id = $_SESSION['customer_id'];

if(!isset($customer_id)){
    header('location:./login.php');
    exit;
}


$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$customer_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
}
?>

<?php @include("./../header.php")?>
<?php @include("navbar.php")?>
<?php @include("map.php")?>

  

<?php @include("footer.php")?>

