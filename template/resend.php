<?php
session_start();
include './db/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

if (!isset($_SESSION['verify_email'])) {
    echo "<script>window.location.href='registration.php';</script>";
    exit();
}
$_SESSION['resend_timer'] = time() + 30; // Set cooldown for 30 seconds
$email = $_SESSION['verify_email'];
$new_code = rand(100000, 999999);

// Update the verification code in the database
mysqli_query($conn, "UPDATE users SET verification_code = '$new_code' WHERE email = '$email'");

// Send the new code via email
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
   $mail->Subject = 'Your New Verification Code';

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
                ' . $new_code . '
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

    echo "<script>alert('New verification code sent to your email.'); window.location.href='verify.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Mail error: {$mail->ErrorInfo}'); window.location.href='verify.php';</script>";
}
?>
