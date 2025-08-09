<?php
session_start();
include './db/database.php';

if (!isset($_SESSION['verify_email'])) {
    echo "<script>window.location.href='registration.php';</script>";
    exit();
}

$email = $_SESSION['verify_email'];
$message = [];

if (isset($_POST['verify'])) {
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND verification_code = '$code'");

    if (mysqli_num_rows($query) > 0) {
        mysqli_query($conn, "UPDATE users SET is_verified = 1, status = 'active' WHERE email = '$email'");
        unset($_SESSION['verify_email']);
        echo "<script>alert('Email verified successfully.'); window.location.href='login.php';</script>";
    } else {
        $message[] = "Incorrect verification code. Please try again.";
    }
}

// Place after session_start();
if (!isset($_SESSION['resend_timer'])) {
    $_SESSION['resend_timer'] = 0;
}

$current_time = time();
$cooldown_seconds = 30; // cooldown in seconds

$remaining_time = max(0, $_SESSION['resend_timer'] - $current_time);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="newcss/styles.css">
    <style>
        .message {
            border: 1px solid red;
            background-color: #ffe6e6;
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
            <form method="post">
                <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
                <h2 class="title">Email Verification</h2>

                <?php
                if (!empty($message)) {
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

<p style="text-align:center; font-weight:bold; color:#333; margin-bottom:10px;">
    Verifying email: <span style="color: #1e90ff;"><?php echo htmlspecialchars($email); ?></span>
</p>


                <div class="input-div one">
                    <div class="i"><i class="fas fa-key"></i></div>
                    <div class="div floating-label">
                        
                       
                        <input type="text" class="input" name="code" required placeholder=" ">
                        <label>Enter Verification Code</label>
                    </div>
                </div>

                <button type="submit" name="verify" class="btn">Verify</button>

                <p style="text-align:center; margin-top: 10px;">
                    Didn't get the code? <?php if ($remaining_time == 0): ?>
    <a href="resend.php" id="resendLink" style="color: rgb(74, 231, 87); font-weight: bold; text-decoration: none;  margin: -22px 0 0 0;">Resend</a>
<?php else: ?>
    <span id="resendTimer" style="color: gray;">Resend available in <span id="countdown"><?= $remaining_time ?></span>s</span>
<?php endif; ?>

                </p>
                
            </form>
        </div>
    </div>


    <script>
    let timeLeft = <?= $remaining_time ?>;
    const countdown = document.getElementById('countdown');

    if (timeLeft > 0) {
        const interval = setInterval(() => {
            timeLeft--;
            countdown.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(interval);
                location.reload(); // Reload to enable the Resend link
            }
        }, 1000);
    }
</script>

</body>
</html>
