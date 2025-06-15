<?php

@include ("../db/database.php"); // Make sure this contains your DB connection code
session_start();

$customer_id = $_SESSION['customer_id'];


if(!isset($customer_id)){
    header('location:./login.php');
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $junk_type = $_POST['junk_type'];
    $description = $_POST['description'];
    $preferred_date = $_POST['preferred_date'];

    $insert = "INSERT INTO pickup_requests (name, address, contact_number, junk_type, description, preferred_date) 
               VALUES ('$name', '$address', '$contact', '$junk_type', '$description', '$preferred_date')";
    mysqli_query($conn, $insert) or die(mysqli_error($conn));
    header("Location: customer_requests.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM pickup_requests WHERE id=$id");
    header("Location: customer_requests.php");
    exit();
}


$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$customer_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
}
?>
<?php
@include("header.php");
@include("navbar.php");

?>
<div class="container mt-5" style="text-align: center;
    position: absolute;
    left: 22%;
    top: 28%;">
    <h3>📦 Junk Pick-up Request Form</h3>
    <form method="POST" class="row g-3 mt-3">
        <div class="col-md-6">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($fetch['first_name']); ?>" disabled>
        </div>
        <div class="col-md-6">
            <label>Contact Number</label>
            <input type="text" name="contact" required class="form-control">
        </div>
        <div class="col-md-12">
            <label>Address</label>
            <input type="text" name="address" required class="form-control" value="<?php echo htmlspecialchars($fetch['address']); ?>" disabled>
        </div>
        <div class="col-md-6">
            <label>Junk Type</label>
            <input type="text" name="junk_type" required class="form-control">
        </div>
        <div class="col-md-6">
            <label>Preferred Date</label>
            <input type="date" name="preferred_date" required class="form-control">
        </div>
        <div class="col-md-12">
            <label>Description</label>
            <textarea name="description" rows="3" class="form-control"></textarea>
        </div>
        <div class="col-12">
            <button name="submit" class="btn btn-primary">Submit Request</button>
        </div>
    </form>

    <hr class="my-5">

    <h4>📋 My Requests</h4>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Junk Type</th>
                <th>Description</th>
                <th>Preferred Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $get_requests = mysqli_query($conn, "SELECT * FROM pickup_requests WHERE customer_id='$customer_id' ORDER BY created_at DESC");
        while ($row = mysqli_fetch_assoc($get_requests)) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['junk_type']}</td>
                <td>{$row['description']}</td>
                <td>{$row['preferred_date']}</td>
                <td>
                    <span class='badge bg-".(
                        $row['status'] === 'Pending' ? 'warning text-dark' :
                        ($row['status'] === 'Approved' ? 'success' : 'danger')
                    )."'>{$row['status']}</span>
                </td>
                <td>
                    <a href='customer_requests.php?delete={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Delete this request?')\">Delete</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php @include("footer.php"); ?>