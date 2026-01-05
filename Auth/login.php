<?php
require '../helper/data-base.php';
require '../helper/helper-functions.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود - وبسایت آرمان رجایی</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('assets/style/auth/login.css') ?>">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@200;300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #000000;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <!-- بک‌گراند تمیز و حرفه‌ای -->
    <div class="elegant-background">
        <div class="gradient-overlay"></div>
        <div class="ambient-glow">
            <div class="glow-orb main-glow"></div>
            <div class="glow-orb secondary-glow"></div>
        </div>
        <div class="subtle-particles" id="particleContainer"></div>
    </div>

    <!-- فرم لاگین حرفه‌ای -->
    <div class="form-container">
        <div class="premium-card">
            <div class="premium-accent"></div>
            <div class="inner-texture"></div>

            <div class="form-header">
                <div class="logo-wrapper">
                    <div class="rotating-ring ring-1"></div>
                    <div class="rotating-ring ring-2"></div>
                    <div class="rotating-ring ring-3"></div>
                    <div class="premium-logo">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <h1 class="form-title">خوش آمدید</h1>
                <p class="form-subtitle">برای ورود، اطلاعات خود را وارد کنید</p>
            </div>

            <div class="form-content">
                <form id="loginForm">
                    <div class="input-group">
                        <input type="text" class="premium-input" placeholder="نام کاربری یا ایمیل" required>
                        <i class="fas fa-user input-icon"></i>
                    </div>

                    <div class="input-group">
                        <input type="password" class="premium-input" id="password" placeholder="رمز عبور" required>
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" id="remember">
                            <span class="premium-checkbox"></span>
                            <span class="checkbox-label">مرا به خاطر بسپار</span>
                        </label>
                        <a href="#" class="forgot-link">فراموشی رمز عبور؟</a>
                    </div>

                    <button type="submit" class="premium-button" id="loginBtn">
                        <span class="button-wave"></span>
                        ورود به حساب کاربری
                    </button>
                </form>
            </div>

            <div class="form-divider">
                <span>یا ورود با</span>
            </div>

            <div class="social-section">
                <div class="social-buttons">
                    <a href="#" class="social-btn google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-btn telegram">
                        <i class="fab fa-telegram"></i>
                    </a>
                    <a href="#" class="social-btn instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <div class="register-section">
                <p class="register-text">
                    حساب کاربری ندارید؟
                    <a href="#" class="register-link">ثبت‌نام کنید</a>
                </p>
            </div>
        </div>
    </div>
    <script src="<?= asset('assets/js/auth/login.js') ?>"></script>">

</body>

</html>