<?php
include '../db/database.php';
session_start();

$customer_id = $_SESSION['customer_id'];

if (!isset($customer_id)) {
    header('location:./login.php');
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$customer_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
}

$notifications_query = mysqli_query($conn, "
  SELECT n.*, a.first_name AS collector_name, a.image AS collector_image
  FROM `collector_notification` n
  LEFT JOIN `users` a ON n.admin_id = a.id
  WHERE n.customer_id = '$customer_id'
  ORDER BY n.created_at DESC
") or die('Query failed');




// Get the notification count (now excluding the "pickup request from customer")
$notification_count = mysqli_num_rows($notifications_query);

// Fetch unread count
$unread_query = mysqli_query($conn, "SELECT COUNT(*) AS unread_count FROM collector_notification WHERE customer_id = '$customer_id' AND status = 0");

$unread_data = mysqli_fetch_assoc($unread_query);
$unread_count = $unread_data['unread_count'];


?>


<style>
  /* Google fonts import link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
  transition: all 0.3s ease;
}
:root{
  --white: #fff;
  --black: #24292d;
  --nav-main: #4070f4;
  --switchers-main: #0b3cc1;
  --light-bg: #F0F8FF;
}
nav{
  /* position: fixed; */
  height: 70px;
  width: 100%;
  background: var(--nav-main);
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
 
}
nav .navbar{
  display: flex;
  align-items: center;
  height: 100%;
  max-width: 1300px;
  margin: auto;
  padding: 0 30px;
  justify-content: space-between;
  

}
nav .navbar a{
  font-size: 30px;
  font-weight: 500;
  color: var(--white);
  text-decoration: none;
}
 .navbar .nav-links{
   display: flex;
 }
 .navbar .nav-links li{
 
   list-style: none;
   display: flex;
 }
 .navbar .nav-links a{
   font-size: 18px;
   font-weight: 400;
   opacity: 1;
   margin: .5rem;
 }
  .navbar .nav-links a:hover{
    opacity: 1;
  }
 .navbar .appearance{
   display: flex;
   align-items: center;
 }
 .appearance .light-dark,
 .appearance .icons{
  height: 50px;
  width: 50px;
  border-radius: 6px;
  line-height: 50px;
  text-align: center;
  color: var(--white);
  font-size: 20px;
  background: var(--switchers-main);
  cursor: pointer;
}
.appearance .light-dark i,
.appearance .icons i{
  opacity: 1;
}
.appearance .light-dark:hover i,
.appearance .icons:hover i{
  opacity: 1;
}
.appearance .light-dark:hover{
  box-shadow: 0 5px 10px rgba(0,0,0,0.1)
}
.appearance .light-dark i{
  height: 100%;
  width: 100%;
}
 .appearance .color-icon{
   position: relative;
 }
 .appearance .icons{
   width: 70px;
   height: 50px;
   margin-left: 14px;
 }
 .appearance .color-box{
   position: absolute;
   bottom: -133px;
   right: 0;
   min-height: 100px;
   background: var(--white);
   padding: 16px 20px 20px 20px;
   border-radius: 6px;
   box-shadow: 0 5px 10px rgba(0,0,0,0.2);
   opacity: 0;
   pointer-events: none;
 }
 .color-box::before{
   content: '';
   position: absolute;
   top: -10px;
   right: 20px;
   height: 30px;
   width: 30px;
   border-radius: 50%;
   background: var(--white);
   transform: rotate(45deg);
 }
 .color-icon.open .color-box{
   opacity: 1;
   pointer-events: auto;
 }
  .color-icon.open .arrow{
    transform: rotate(-180deg);
  }
 .appearance .color-box h3{
   font-size: 16px;
   font-weight: 600;
   display: block;
   color: var(--nav-main);
   text-align: left;
   white-space: nowrap;
   margin-bottom: 10px;
 }
.appearance .color-box .color-switchers{
   display: flex;
}
.color-box .color-switchers .btn{
  display: inline-block;
  height: 40px;
  width: 40px;
  border: none;
  outline: none;
  border-radius: 50%;
  margin: 0 5px;
  cursor: pointer;
  background: #4070F4;

}
.color-switchers .btn.blue.active{
  box-shadow: 0 0 0 2px #fff,
              0 0 0 4px #4070F4;
}
.color-switchers .btn.orange{
  background: #F79F1F;
}
.color-switchers .btn.orange.active{
  box-shadow: 0 0 0 2px #fff,
              0 0 0 4px #F79F1F;
}
.color-switchers .btn.purple{
  background: #8e44ad;
}
.color-switchers .btn.purple.active{
  box-shadow: 0 0 0 2px #fff,
              0 0 0 4px #8e44Ad;
}
.color-switchers .btn.green{
  background: #3A9943;
}
.color-switchers .btn.green.active{
  box-shadow: 0 0 0 2px #fff,
              0 0 0 4px #3A9943;
}
.home-content{
  height: 100vh;
  width: 100%;
  background: var(--light-bg);
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 0 60px;
}
.home-content h2{
  color: var(--black);
  font-size: 50px;
}
.home-content h3{
  color: var(--black);
  font-size: 42px;
  margin-top: -8px;
}
.home-content h3 span{
  color: var(--nav-main);
}
.home-content h3 span.darkMode{
  color: var(--black);
}
.home-content p{
  color: var(--black);
  font-size: 16px;
  width: 45%;
  text-align: justify;
  margin: 4px 0 30px 0;
}
.home-content a{
  color: #fff;
  font-size: 20px;
  padding: 12px 24px;
  border-radius: 6px;
  text-decoration: none;
  background: var(--nav-main);
}
.home-content a i{
  transform: rotate(45deg);
  font-size: 16px;
}
.home-content a:hover{
  background: var(--switchers-main);
}
@media (max-width: 1050px) {
  .home-content p{
    width: 70%;
  }
}

/* profile menu */
.container {
        text-align: center;
      }
      .d-flex {
        display: flex;
        align-items: center;
        justify-content: center;
      }
     #menu {
              left: 69%;
          text-decoration: none;
          display: flex;
          align-items: center;
          padding: 5.5px 20px;
          border-radius: 8px;
          transition: 0.3s ease;
          color: #000;
          background: #fff;
          position: absolute;
          top: 1%;
          transform: translate(63px, 3px);
         
      }
      #menu:hover {
        background: #e4f0fc;
      }
      .drop-btn {
        cursor: pointer;
        font-size: 18px;
        color: #b0b3b8;
      }
      .tooltip {
        position: absolute;
        right: 20px;
        top: 50px;
        height: 15px;
        width: 15px;
        display: none;
        background: #242526;
        transform: rotate(45deg);
      }
     
      .wrapper {
        position: absolute;
        top: 70px;
        right: 0;
        z-index: 9090;
        width: 300px;
        border-radius: 8px;
        transform: translateY(-10px);
        opacity: 0;
        transition: all 0.3s ease;
        visibility: hidden;
      }
      .wrapper.show {
        opacity: 1;
        transform: translateY(0);
        visibility: visible;
      }
      .wrapper ul {
        list-style: none;
        
      }
      .wrapper ul li {
        padding: 13px 15px;
        border-radius: 6px;
        transition: 0.3s;
      }
      .wrapper ul li:hover {
        background: #e4f0fc;
      }
      .wrapper ul li a {
        display: flex;
        align-items: center;
        color: #000;
        font-size: 14px;
        text-decoration: none;
      }
      .profile-picture {
        cursor: pointer;
        border-radius: 50%;
        object-fit: cover;
        width: 36px;
        height: 36px;
        margin-left: 10px;
      }
      .menu-bar{
    background-color: #fff;
    position: relative;
    left: -51%;
    border-radius: 8px;
    top: 12px;
    border: 1px solid #ccc;
      }
      .menu_name{
        margin-left: .5rem;
      }
      .notification-wrapper {
  position: relative;
  margin-left: 20px;
}

.notification-bell {
  font-size: 20px;
  cursor: pointer;
  position: relative;
  color: #333;
}

.notif-count {
  position: absolute;
  top: -5px;
  right: -8px;
  background: red;
  color: white;
  border-radius: 50%;
  padding: 3px 6px;
  font-size: 12px;
}

.notification-dropdown {
  display: none;
  position: absolute;
  right: 0;
  top: 30px;
  width: 320px;
  max-height: 400px;
  overflow-y: auto;
  background: #fff;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  border-radius: 8px;
  z-index: 9999;
}

.notification-dropdown .notification {
  padding: 10px;
  border-bottom: 1px solid #eee;
}

.notification-header {
  display: flex;
  align-items: center;
  gap: 10px;
}

.collector-image {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.collector-name {
  font-weight: bold;
}

.notification-time {
  font-size: 12px;
  color: gray;
}

.notification-body p {
  margin: 5px 0;
}

.notification-footer a {
  color: #4070f4;
  text-decoration: none;
  font-size: 14px;
}

.no-notif {
  padding: 15px;
  text-align: center;
  color: gray;
}

</style>
<?php @include("./../header.php")?>


<nav style="z-index:3000;">
  <div class="navbar">
    <div class="logo"><a href="#">CodingLab</a></div>
    
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="request_pickup.php">Request Pickup</a></li>
    </ul>

    <div class="appearance">

      <!-- Dark Mode Button -->
      <div class="light-dark">
        <i class="btn fas fa-moon" style="position: relative; top: 29%; left: 30%;"></i>
      </div>

      <!-- Color Palette Dropdown -->
      <div class="color-icon">
        <div class="icons">
          <i class="fas fa-palette"></i>
          <i class="fas fa-sort-down arrow"></i>
        </div>
        <div class="color-box">
          <h3>Color Switcher</h3>
          <div class="color-switchers">
            <button class="btn blue active" data-color="#fff #24292d #4070f4 #0b3cc1 #F0F8FF"></button>
            <button class="btn orange" data-color="#fff #242526 #F79F1F #DD8808 #fef5e6"></button>
            <button class="btn purple" data-color="#fff #242526 #8e44ad #783993 #eadaf1"></button>
            <button class="btn green" data-color="#fff #242526 #3A9943 #2A6F31 #DAF1DC"></button>
          </div>
        </div>
      </div>


 
<!-- Notification Bell Dropdown -->
<div class="notification-wrapper">
    <div class="notification-bell" onclick="toggleNotifications(); markNotificationsAsRead();">
        <i class="fas fa-bell"></i>
        <?php if ($unread_count > 0): ?>
            <span class="notif-count" id="notifCount"><?php echo $unread_count; ?></span>
        <?php endif; ?>
    </div>

    <!-- Dropdown Content -->
    <div class="notification-dropdown" id="notificationDropdown">
        <?php if ($notification_count > 0): ?>
            <?php while ($notification = mysqli_fetch_assoc($notifications_query)): ?>
                <div class="notification">
                    <div class="notification-header">
                        
                        <img src="./../images/<?php echo $notification['sender_image'] ?? '1.png'; ?>" alt="User"  class="collector-image">
                        <div>
                            <span class="collector-name"><?php echo htmlspecialchars($notification['collector_name']); ?></span>
                            <span class="notification-time"><?php echo date('M d h:i A', strtotime($notification['created_at']));?></span>
                        </div>
                    </div>
                    <div class="notification-body">
                        <p><?php echo htmlspecialchars($notification['message']); ?></p>
                    </div>
                    <div class="notification-footer">
                        <a href="view_notification.php?id=<?php echo $notification['id']; ?>">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-notif">No notifications yet.</p>
        <?php endif; ?>
    </div>
</div>


      <!-- Profile Dropdown -->
      <div class="container">
        <div class="d-flex">
          <div id="navdrop" class="btn-light">
            <div class="drop-btn">
              <a id="menu" href="#">
                <p><?php echo htmlspecialchars($fetch['first_name']); ?></p>
                <img src="./../images/<?php echo empty($fetch['image']) ? '1.png' : $fetch['image']; ?> " class="profile-picture">
             
              </a>
            </div>
            <div class="wrapper">
              <ul class="menu-bar">
                <li><a href="#"><span class="material-symbols-outlined">settings_account_box</span><p class="menu_name">Profile Settings</p></a></li>
                <hr>
                <li><a href="profile.php"><span class="material-symbols-outlined">person</span><p class="menu_name">Edit Profile</p></a></li>
                <hr>
                <li><a href="./../logout.php"><span class="material-symbols-outlined">logout</span><p class="menu_name">Sign out</p></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</nav>
<script>
function markNotificationsAsRead() {
    fetch('mark_notifications_read.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const countElem = document.getElementById('notifCount');
                if (countElem) {
                    countElem.style.display = 'none';
                }
            }
        })
        .catch(err => console.error('Error marking notifications:', err));
}
</script>

<script>
  function toggleNotifications() {
    const dropdown = document.getElementById("notificationDropdown");
    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
  }

  // Optional: Hide dropdown when clicking outside
  window.addEventListener('click', function(e) {
    const bell = document.querySelector('.notification-bell');
    const dropdown = document.getElementById("notificationDropdown");
    if (!bell.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = "none";
    }
  });
</script>

  <script>


    
    // Js code to make color box enable or disable
let colorIcons = document.querySelector(".color-icon"),
icons = document.querySelector(".color-icon .icons");

icons.addEventListener("click" , ()=>{
  colorIcons.classList.toggle("open");
})

// getting all .btn elements
let buttons = document.querySelectorAll(".btn");

for (var button of buttons) {
  button.addEventListener("click", (e)=>{ //adding click event to each button
    let target = e.target;

    let open = document.querySelector(".open");
    if(open) open.classList.remove("open");

    document.querySelector(".active").classList.remove("active");
    target.classList.add("active");

    // js code to switch colors (also day night mode)
    let root = document.querySelector(":root");
    let dataColor = target.getAttribute("data-color"); //getting data-color values of clicked button
    let color = dataColor.split(" "); //splitting each color from space and make them array

    //passing particular value to a particular root variable
    root.style.setProperty("--white", color[0]);
    root.style.setProperty("--black", color[1]);
    root.style.setProperty("--nav-main", color[2]);
    root.style.setProperty("--switchers-main", color[3]);
    root.style.setProperty("--light-bg", color[4]);

    let iconName = target.className.split(" ")[2]; //getting the class name of icon

    let coloText = document.querySelector(".home-content span");

    if(target.classList.contains("fa-moon")){ //if icon name is moon
      target.classList.replace(iconName, "fa-sun") //replace it with the sun
      colorIcons.style.display = "none";
      coloText.classList.add("darkMode");
    }else if (target.classList.contains("fa-sun")) { //if icon name is sun
      target.classList.replace("fa-sun", "fa-moon"); //replace it with the sun
      colorIcons.style.display = "block";
      coloText.classList.remove("darkMode");
      document.querySelector(".btn.blue").click();
    }
  });
}
//profile menu
document.querySelector(".drop-btn").addEventListener("click", function() {
        document.querySelector(".wrapper").classList.toggle("show");
        document.querySelector(".tooltip").classList.toggle("show");
      });
  </script>
  <?php @include("footer.php")?>