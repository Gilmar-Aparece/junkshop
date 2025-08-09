<?php
session_start();
include './db/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
 //   $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT);


    $password = mysqli_real_escape_string($conn, $_POST['password']);
 
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
   

    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $image_size = $_FILES['image']['size'];


    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/' . $image;
    $verification_code = rand(100000, 999999);


    $message = [];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'User already exists!';
    }


    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'User already exists!';
    }
    // First letter uppercase validation for first and last name
    if (!preg_match('/^[A-Z][a-zA-Z]*$/', $first_name)) {
        $message[] = 'First name must start with a capital letter and contain only letters!';
    }

    if (!preg_match('/^[A-Z][a-zA-Z]*$/', $last_name)) {
        $message[] = 'Last name must start with a capital letter and contain only letters!';
    }

    // Phone number validation
    if (!preg_match('/^09\d{9}$/', $number)) {
        $message[] = 'Phone number must be exactly 11 digits and start with 09!';
    }




    // Password strength validation
    $password_errors = [];
    if (strlen($password) < 8) {
        $password_errors[] = 'at least 8 characters';
    }
    // if (!preg_match('/[A-Z]/', $password)) {
    //     $password_errors[] = 'one uppercase letter';
    // }
    // if (!preg_match('/[a-z]/', $password)) {
    //     $password_errors[] = 'one lowercase letter';
    // }
    if (!preg_match('/\d/', $password)) {
        $password_errors[] = 'one number';
    }
    if (!preg_match('/[\W_]/', $password)) {
        $password_errors[] = 'one special character (e.g. @, $, *, &, #)';
    }
    
    // Final password error output
    if (!empty($password_errors)) {
        $message[] = 'Password must contain: ' . implode(', ', $password_errors) . '!';
        $message[] = 'Example: <strong>junkshop$*@2024</strong>';
    }

    
    if ($password !== $cpassword) {
        $message[] = 'Confirm password does not match!';
    }

    if ($image_size > 500000000) {
        $message[] = 'Image size is too large!';
    }

    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Email already registered.'); window.location.href='registration.php';</script>";
        exit();
    }

    // Proceed only if no errors
    if (empty($message)) {
       // $password = password_hash($raw_password, PASSWORD_DEFAULT);
        
        $insert_query = "INSERT INTO users (first_name, last_name, email, address, number, password, image, user_type, verification_code, is_verified, status)
            VALUES ('$first_name', '$last_name', '$email', '$address', '$number', '$password', '$image', '$user_type', '$verification_code', 0, 'deactivate')";

        if (mysqli_query($conn, $insert_query)) {
            move_uploaded_file($image_tmp_name, $image_folder);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tiktoksexiest99@gmail.com';
            $mail->Password = 'ymlk gudu rxdd zfto';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('tiktoksexiest99@gmail.com', 'Junk Shop');
            $mail->addAddress($email);
            $mail->isHTML(true);
$mail->Subject = 'Email Verification Code';

$mail->Body = '
<div style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 500px; margin: auto; background-color: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        
        <div style="text-align: center;">
            <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg" alt="Junk Shop Logo" style="width: 100px; margin-bottom: 20px;">
            <h2 style="color: #2c3e50;">Welcome to Junk Shop!</h2>
        </div>

        <p style="font-size: 16px; color: #333;">
            Thank you for registering with <strong>Junk Shop</strong>. To complete your registration, please use the verification code below:
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <span style="display: inline-block; font-size: 24px; background-color: #2ecc71; color: #fff; padding: 15px 30px; border-radius: 5px; font-weight: bold;">
                ' . $verification_code . '
            </span>
        </div>

        <p style="font-size: 14px; color: #777;">
            If you did not request this, you can safely ignore this email.
        </p>

        <div style="text-align: center; margin-top: 30px;">
            <p style="font-size: 13px; color: #aaa;">&copy; ' . date("Y") . ' Junk Shop. All rights reserved.</p>
        </div>
    </div>
</div>';

            $mail->send();

            $_SESSION['verify_email'] = $email;
            echo "<script>alert('Registered successfully. Please verify your email.'); window.location.href='verify.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Mail error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('Registration failed.');</script>";
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="newcss/styles.css">
    <style>
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            z-index: 1;
        }

        .div {
            position: relative;
        }

        #address_results {
            background: white;
            border: 1px solid #ccc;
            text-align: start;
            max-height: 200px;
            top: 51px;
            overflow-y: auto;
            position: absolute;
            width: 109%;
            left: -24px;
            z-index: 999;
            font-size: 14px;
            color: #333;
            padding: 5px;
            border-radius: 5px;
            display: none;
        }

        #address_results div {
            padding: 5px 10px;
            cursor: pointer;
        }

        #address_results div:hover {
            background-color: #f1f1f1;
        }
        .message {
    border: 1px solid red;
    background-color: #ffe6e6; /* light pink background */
    color: red;
    padding: 10px 15px;
    margin: 10px 0;
    border-radius: 5px;
    position: relative;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.message i {
    cursor: pointer;
    font-style: normal;
    font-weight: bold;
    padding-left: 10px;
    color: red;
}
.floating-label {
    position: relative;
    margin-top: 15px;
}

.floating-label input {
    width: 100%;
    padding: 10px 5px 10px 0;
    font-size: 16px;
    border: none;
    border-bottom: 2px solid #ccc;
    background: transparent;
    outline: none;
}

.floating-label label {
    position: absolute;
    top: 10px;
    left: 0;
    color: #999;
    font-size: 16px;
    pointer-events: none;
    transition: 0.3s ease all;
}

.floating-label input:focus + label,
.floating-label input:not(:placeholder-shown) + label {
    top: -15px;
    font-size: 13px;
    color:rgb(0, 0, 0);
}

    </style>
</head>
<body>
    <img class="wave" src="ban.png">
    <div class="container">
        <div class="img">
            <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/bg.svg">
        </div>
        <div class="login-content">
            <form method="post" enctype="multipart/form-data">
                <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
                <h2 class="title">Welcome</h2>

                <?php
                    if (isset($message)) {
                        foreach ($message as $msg) {
                            echo '
                                <div class="message">
                                    <span>' . $msg . '</span>
                                    <i class="fas fa-times" onclick="this.parentElement.remove();">×</i>
                                </div>
                            ';
                        }
                    }
                    ?>


                <div class="input-div one">
                    <div class="i"><i class="fas fa-user"></i></div>
                    <div class="div floating-label">
                  
                        <input type="text" class="input" name="first_name" required placeholder=" ">
                        <label>Firstname</label>
                    </div>
                </div>

                <div class="input-div one">
                    <div class="i"><i class="fas fa-envelope"></i></div>
                    <div class="div floating-label">
                        
                        <input type="text" class="input" name="last_name" required placeholder=" ">
                        <label>Lastname</label>
                    </div>
                </div>

                <div class="input-div one" style="display:none;">
                    <div class="i"><i class="fas fa-user-tag"></i></div>
                    <div class="div floating-label">
                        <select name="user_type" style="width: 311px; outline: none; border: none; font-weight: 700; color: rgba(0,0,0,.4);">
                            <option value="customer" selected>Customer</option>
                        </select>
                    </div>
                </div>

                <div class="input-div one">
                    <div class="i"><i class="fas fa-envelope"></i></div>
                    <div class="div floating-label">
                       
                        <input type="email" class="input" name="email" required placeholder=" ">
                        <label>Email</label>
                    </div>
                </div>

                <div class="input-div one">
                    <div class="i"><i class="fas fa-phone"></i></div>
                    <div class="div floating-label">
                        <label>Phone Number</label>
                        <input type="text" class="input" name="number" required placeholder=" ">
                    </div>
                </div>

                <div class="input-div one">
                    <div class="i"><i class="fas fa-search-location"></i></div>
                    <div class="div floating-label">
                        
                        <input type="text" class="input" id="address_search" name="address">
                        <label>Search Address</label>
                        <div id="address_results"></div>
                    </div>
                </div>

                <div class="input-div pass">
                    <div class="i"><i class="fas fa-lock"></i></div>
                    <div class="div floating-label">
                        
                        <input type="password" class="input password-field" name="password" required placeholder=" ">
                        <label>Password</label>
                        <span class="toggle-password">
            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path class="eye" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                <circle class="pupil" cx="12" cy="12" r="3"/>
            </svg>
        </span>
                
                    </div>
                </div>

                <div class="input-div pass">
                    <div class="i"><i class="fas fa-lock"></i></div>
                    <div class="div floating-label">
                     
                        <input type="password" class="input password-field" name="cpassword" required placeholder=" ">
                        <label>Confirm Password</label>
                        <span class="toggle-password">
            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path class="eye" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                <circle class="pupil" cx="12" cy="12" r="3"/>
            </svg>
        </span>
                    </div>
                </div>

                <div class="input-div one" style="opacity:0">
                    <div class="i"><i class="fas fa-image"></i></div>
                    <div class="div floating-label">
                     
                        <input type="file" class="input" name="image">
                        <label>Image</label>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn">Register</button>

                <p style="text-align: center; margin-top: 10px; display: flex; align-items: center; justify-content: center;">
                    Already have an account?
                    <a href="login.php" style="margin-left:5px; color:rgb(74, 231, 87); text-decoration: none; font-weight: bold;">Login</a>
                </p>
            </form>
        </div>
    </div>
    <script>
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input');
            const eye = this.querySelector('.eye');
            const pupil = this.querySelector('.pupil');

            if (input.type === 'password') {
                input.type = 'text';
                eye.setAttribute('opacity', '0.4');
                pupil.setAttribute('opacity', '0.2');
            } else {
                input.type = 'password';
                eye.setAttribute('opacity', '1');
                pupil.setAttribute('opacity', '1');
            }
        });
    });
</script>

    <script>
      const addressInput = document.getElementById("address_search");
    const resultsDiv = document.getElementById("address_results");

    const buenavistaBarangays = [
        "Anonang", "Asinan", "Bago", "Baluarte", "Bantuan", "Bato", "Bonotbonot", "Bugaong",
        "Cambuhat", "Cambus-oc", "Cangawa", "Cantomugcad", "Cantores", "Cantuba", "Catigbian", "Cawag",
        "Cruz", "Dait", "Eastern Cabul-an", "Hunan", "Lapacan Norte", "Lapacan Sur", "Lubang", "Lusong (Plateau)",
        "Magkaya", "Merryland", "Nueva Granada", "Nueva Montana", "Overland", "Panghagban", "Poblacion",
        "Puting Bato", "Rufo Hill", "Sweetland", "Western Cabul-an"
    ];

    addressInput.addEventListener("input", function () {
        let query = this.value.trim().toLowerCase();
        resultsDiv.innerHTML = "";
        resultsDiv.style.display = "none";

        if (query.length >= 1) {
            // Case 1: User searches "buenavista" or "b"
            if (query === "buenavista" || query === "b") {
                resultsDiv.style.display = "block";
                buenavistaBarangays.forEach(barangay => {
                    const div = document.createElement("div floating-label");
                    div.textContent = barangay + ", Buenavista, Bohol";
                    div.style.padding = "5px";
                    div.style.cursor = "pointer";
                    div.addEventListener("click", function () {
                        addressInput.value = this.textContent;
                        resultsDiv.innerHTML = "";
                        resultsDiv.style.display = "none";
                    });
                    resultsDiv.appendChild(div);
                });
            } else {
                // Case 2: Use OpenStreetMap Nominatim search
                fetch("https://nominatim.openstreetmap.org/search?format=json&q=" + encodeURIComponent(query) + "&addressdetails=1&limit=10&countrycodes=ph")
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            resultsDiv.style.display = "block";
                            data.forEach(result => {
                                const div = document.createElement("div floating-label");
                                div.textContent = result.display_name;
                                div.style.padding = "5px";
                                div.style.cursor = "pointer";
                                div.addEventListener("click", function () {
                                    addressInput.value = this.textContent;
                                    resultsDiv.innerHTML = "";
                                    resultsDiv.style.display = "none";
                                });
                                resultsDiv.appendChild(div);
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                    });
            }
        }
    });

    // Hide results if clicking outside
    document.addEventListener("click", function (event) {
        if (!addressInput.contains(event.target) && !resultsDiv.contains(event.target)) {
            resultsDiv.style.display = "none";
        }
    });

    // Input animation (optional)
    const inputs = document.querySelectorAll(".input");
    inputs.forEach(input => {
        input.addEventListener("focus", () => input.parentNode.parentNode.classList.add("focus"));
        input.addEventListener("blur", () => {
            if (input.value === "") input.parentNode.parentNode.classList.remove("focus");
        });
    });

  
</script>

</body>
</html>