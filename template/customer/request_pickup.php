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

if(isset($_POST['submit_review'])){
    $customer_id = $_SESSION['customer_id'];
    $request_id = $_POST['request_id'];
    $collector_id = $_POST['collector_id'];
    $rating = (int)$_POST['rating'];
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);

    $insert = "INSERT INTO reviews (request_id, customer_id, collector_id, rating, review_text) 
               VALUES ('$request_id', '$customer_id', '$collector_id', '$rating', '$review_text')";
    mysqli_query($conn, $insert) or die(mysqli_error($conn));

   
    exit();
}


// Pagination + Search
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$offset = ($page - 1) * $limit;

// Count total
$count_query = "SELECT COUNT(*) AS total FROM pickup_requests 
                WHERE customer_id = '$customer_id' 
                AND (junk_type LIKE '%$search%' OR description LIKE '%$search%')";
$count_result = mysqli_query($conn, $count_query);
$total = mysqli_fetch_assoc($count_result)['total'];
$pages = ceil($total / $limit);

// Fetch paginated requests
$get_requests = mysqli_query($conn, 
    "SELECT pr.*, u.first_name, u.last_name 
     FROM pickup_requests pr
     LEFT JOIN users u ON pr.collector_id = u.id
     WHERE pr.customer_id = '$customer_id' 
     AND (pr.junk_type LIKE '%$search%' OR pr.description LIKE '%$search%') 
     ORDER BY pr.created_at DESC 
     LIMIT $limit OFFSET $offset");


$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$customer_id'") or die('Query failed');
$fetch = mysqli_fetch_assoc($select);
?>
<?php @include("header.php"); ?>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <?php @include("navbar.php");?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php @include("sidebar.php");?>

    
        <div class="main-panel">
          <div class="content-wrapper" style="    margin-top: 51px;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple icon-sm text-white align-middle"></i>

                </span> My Request
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-information-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
<!-- Search and Entries Form -->
<form method="GET" class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        Show 
        <select name="limit" onchange="this.form.submit()">
            <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
            <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
        </select>
        entries
    </div>
    <div style="display:flex; gap:10px;">
        <input type="text" name="search" placeholder="Search Junk Type / Description..." class="form-control" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-sm btn-primary">Search</button>
    </div>
</form>

   
    <table class="table table-bordered">
    <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Junk Type</th>
        <th>Description</th>
        <th>Preferred Date</th>
        <th>Status</th>
        <th><strong>Collector</strong></th>
        <th>Actions</th>
    </tr>
</thead>

<tbody>
<?php
if (mysqli_num_rows($get_requests) > 0) {
    while ($row = mysqli_fetch_assoc($get_requests)) {
        $collector_name = !empty($row['first_name']) ? $row['first_name'] . ' ' . $row['last_name'] : 'Unassigned';
        $requestId = $row['id'];
        $collectorId = $row['collector_id'];

        echo "<tr>
    <td>{$requestId}</td>
    <td>{$row['junk_type']}</td>
    <td>{$row['description']}</td>
    <td>" . date('M d, h:i A', strtotime($row['preferred_date'])) . "</td>
    <td>
        <span class='badge bg-".(
            $row['status'] === 'Pending' ? 'warning text-dark' :
            ($row['status'] === 'Approved' ? 'success' : 'danger')
        )."'>{$row['status']}</span>
    </td>
    <td>{$collector_name}</td>
    <td>
        <a href='customer_requests.php?delete={$requestId}' class='btn btn-sm btn-danger' onclick=\"return confirm('Delete this request?')\">Delete</a>
";

if ($row['status'] === 'Pending') {
    echo "<button class='btn btn-sm btn-secondary' disabled>Add Review</button>";
} else {
    echo "<button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#reviewModal{$requestId}'>Add Review</button>";
}
echo " <button class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#viewReviewsModal{$requestId}'>View Reviews</button>";

echo "</td></tr>";

// Fetch reviews for this request
$reviews_query = mysqli_query($conn, "
    SELECT r.*, u.first_name, u.last_name 
    FROM reviews r 
    JOIN users u ON r.customer_id = u.id 
    WHERE r.request_id = '{$requestId}'
");

echo "
<div class='modal fade' id='viewReviewsModal{$requestId}' tabindex='-1'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Reviews for Request #{$requestId}</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>";

if (mysqli_num_rows($reviews_query) > 0) {
    while ($rev = mysqli_fetch_assoc($reviews_query)) {
        echo "<div class='border p-2 mb-2'>
                <strong>{$rev['first_name']} {$rev['last_name']}</strong> 
                <span class='text-warning'>" . str_repeat("&#9733;", $rev['rating']) . "</span>
                <p>{$rev['review_text']}</p>
                <small class='text-muted'>".date('M d, Y h:i A', strtotime($rev['created_at']))."</small>
              </div>";
    }
} else {
    echo "<p class='text-muted'>No reviews yet.</p>";
}

echo "   </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
      </div>
    </div>
  </div>
</div>";

        // ✅ Individual Modal for this request
        echo "
        <div class='modal fade' id='reviewModal{$requestId}' tabindex='-1'>
          <div class='modal-dialog'>
            <form method='POST'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title'>Add Review for Request #{$requestId}</h5>
                  <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                  <input type='hidden' name='request_id' value='{$requestId}'>
                  <input type='hidden' name='collector_id' value='{$collectorId}'>

                  <div class='mb-3'>
                    <label class='form-label'>Rating</label><br>
                    <div class='star-rating' id='stars-{$requestId}'>
                      <span data-value='1'>&#9733;</span>
                      <span data-value='2'>&#9733;</span>
                      <span data-value='3'>&#9733;</span>
                      <span data-value='4'>&#9733;</span>
                      <span data-value='5'>&#9733;</span>
                    </div>
                    <input type='hidden' name='rating' id='rating-{$requestId}' required>
                  </div>

                  <div class='mb-3'>
                    <label class='form-label'>Review</label>
                    <textarea class='form-control' name='review_text' rows='3' required></textarea>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' name='submit_review' class='btn btn-success'>Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>No requests found.</td></tr>";
}
?>
</tbody>


</table>
<!-- Review Modal -->


    <!-- Pagination -->
<nav class="mt-3">
        <ul class="pagination">
            <?php if($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?search=<?= $search ?>&limit=<?= $limit ?>&page=<?= $page - 1 ?>">Previous</a></li>
            <?php endif; ?>
            
            <?php for($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?search=<?= $search ?>&limit=<?= $limit ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            
            <?php if($page < $pages): ?>
                <li class="page-item"><a class="page-link" href="?search=<?= $search ?>&limit=<?= $limit ?>&page=<?= $page + 1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<script>
document.querySelectorAll('.star-rating').forEach(function(starGroup) {
  let stars = starGroup.querySelectorAll('span');
  let inputId = starGroup.id.replace('stars-', 'rating-');

  stars.forEach(function(star, index) {
    star.addEventListener('click', function() {
      let value = this.getAttribute('data-value');
      document.getElementById(inputId).value = value;

      // reset stars
      stars.forEach(s => s.style.color = 'black');
      // highlight selected
      for (let i = 0; i < value; i++) {
        stars[i].style.color = 'gold';
      }
    });
  });
});
</script>


<?php @include("footer.php"); ?>