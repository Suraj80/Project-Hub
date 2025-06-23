<?php
session_start();

// FIXED: Corrected typo in dashboard filename
if(isset($_SESSION['admin_id'])){
    header('location: dashboard1.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/login_style.css">
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/scss/login_style.scss">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Admin Login - AJAX Authentication</title>
</head>
<body>

<!-- Message container for AJAX responses -->
<div id="message-container"></div>

<div class="login">
    <div class="login__content">
        <div class="login__img">
            <img src="assets/images/img-login.svg" alt="Login Illustration">
        </div>

        <div class="login__forms">
            <!-- Login Form -->
            <form id="login-form" class="login__registre" method="post">
                <h1 class="login__title">Sign In</h1>

                <div class="login__box">
                    <i class='bx bx-user login__icon'></i>
                    <input type="text" placeholder="Username" class="login__input" name="username" id="username" required> 
                </div>

                <div class="login__box">
                    <i class='bx bx-lock-alt login__icon'></i>
                    <input type="password" placeholder="Password" class="login__input" name="password" id="password" required>
                </div>

                <a href="#" class="login__forgot">Forgot password?</a>

                <button type="submit" class="login__button" id="login-btn">
                    <span class="btn-text">Sign In</span>
                    <span class="btn-loading" style="display: none;">
                        <i class='bx bx-loader-alt bx-spin'></i> Signing In...
                    </span>
                </button>

                <div>
                    <span class="login__account">Don't have an Account?</span>
                    <span class="login__signup" id="sign-up">Sign Up</span>
                </div>
            </form>

            <!-- Registration Form -->
            <form id="register-form" class="login__create none" method="post">
                <h1 class="login__title">Create Account</h1>

                <div class="login__box">
                    <i class='bx bx-user login__icon'></i>
                    <input type="text" placeholder="Username" class="login__input" name="reg_username" id="reg_username">
                </div>

                <div class="login__box">
                    <i class='bx bx-at login__icon'></i>
                    <input type="email" placeholder="Email" class="login__input" name="reg_email" id="reg_email">
                </div>

                <div class="login__box">
                    <i class='bx bx-lock-alt login__icon'></i>
                    <input type="password" placeholder="Password" class="login__input" name="reg_password" id="reg_password">
                </div>

                <button type="submit" class="login__button">Sign Up</button>

                <div>
                    <span class="login__account">Already have an Account?</span>
                    <span class="login__signup" id="sign-in">Sign In</span>
                </div>

                <div class="login__social">
                    <a href="#" class="login__social-icon"><i class='bx bxl-facebook'></i></a>
                    <a href="#" class="login__social-icon"><i class='bx bxl-twitter'></i></a>
                    <a href="#" class="login__social-icon"><i class='bx bxl-google'></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--===== MAIN JS =====-->
<script src="assets/js/login.js"></script>
</body>
</html>