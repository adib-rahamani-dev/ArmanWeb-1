<?php
require '../helper/data-base.php';
require '../helper/helper-functions.php';
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام - وبسایت آرمان رجایی</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('assets/style/auth/register.css') ?>">
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Vazirmatn:wght@200;300;400;500;600;700;800;900&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Vazirmatn", sans-serif;
        background: #000000;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
</style>

<body>
    <!-- بک‌گراند -->
    <div class="elegant-background">
        <div class="gradient-overlay"></div>
        <div class="ambient-glow">
            <div class="glow-orb main-glow"></div>
            <div class="glow-orb secondary-glow"></div>
        </div>
        <div class="subtle-particles" id="particleContainer"></div>
    </div>

    <!-- فرم ثبت‌نام -->
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
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
                <h1 class="form-title">ثبت‌نام</h1>
                <p class="form-subtitle">برای ایجاد حساب کاربری، اطلاعات خود را وارد کنید</p>
            </div>

            <!-- نشانگر مراحل -->
            <div class="step-indicators">
                <div class="step active" id="step1Indicator">
                    <div class="step-number">1</div>
                    <div class="step-title">اطلاعات شخصی</div>
                </div>
                <div class="step" id="step2Indicator">
                    <div class="step-number">2</div>
                    <div class="step-title">اطلاعات حساب</div>
                </div>
                <div class="step" id="step3Indicator">
                    <div class="step-number">3</div>
                    <div class="step-title">رمز عبور</div>
                </div>
            </div>

            <div class="form-content">
                <form id="registerForm">
                    <!-- مرحله ۱: اطلاعات شخصی -->
                    <div class="form-step active" id="step1">
                        <div class="input-group">
                            <input type="text" class="premium-input" id="firstName" placeholder="نام" required>
                            <i class="fas fa-user input-icon"></i>
                        </div>

                        <div class="input-group">
                            <input type="text" class="premium-input" id="lastName" placeholder="نام خانوادگی" required>
                            <i class="fas fa-user input-icon"></i>
                        </div>

                        <div class="input-group">
                            <input type="tel" class="premium-input" id="phoneNumber" placeholder="شماره تماس" required>
                            <i class="fas fa-phone input-icon"></i>
                        </div>
                    </div>

                    <!-- مرحله ۲: اطلاعات حساب کاربری -->
                    <div class="form-step" id="step2">
                        <div class="input-group">
                            <input type="text" class="premium-input" id="username" placeholder="نام کاربری" required>
                            <i class="fas fa-user-circle input-icon"></i>
                        </div>

                        <div class="input-group">
                            <input type="email" class="premium-input" id="email" placeholder="ایمیل" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                    </div>

                    <!-- مرحله ۳: رمز عبور -->
                    <div class="form-step" id="step3">
                        <div class="input-group password-group">
                            <input type="password" class="premium-input password-input" id="password" placeholder="رمز عبور" required aria-describedby="passwordStrengthText">
                            <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                            <button type="button" class="password-toggle" id="togglePassword" aria-label="نمایش یا مخفی کردن رمز">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- strength bar kept visually connected and compact -->
                            <div class="password-strength" aria-hidden="true">
                                <div class="strength-meter"></div>
                            </div>
                            <div class="strength-text" id="passwordStrengthText">قدرت رمز: <span class="strength-label">—</span></div>
                        </div>

                        <div class="input-group password-group">
                            <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                            <input type="password" class="premium-input password-input" id="confirmPassword" placeholder="تکرار رمز عبور" required aria-label="تکرار رمز عبور">
                            <button type="button" class="password-toggle" id="toggleConfirmPassword" aria-label="نمایش یا مخفی کردن تکرار رمز">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        <div class="form-options">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" id="terms">
                                <span class="premium-checkbox"></span>
                                <span class="checkbox-label">با <a href="#" id="termsLink">قوانین و مقررات</a> موافقم</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn-nav btn-prev" id="prevBtn" style="display: none;">
                            <i class="fas fa-arrow-right"></i> مرحله قبل
                        </button>
                        <button type="button" class="btn-nav btn-next" id="nextBtn">
                            مرحله بعد <i class="fas fa-arrow-left"></i>
                        </button>
                        <button type="submit" class="btn-nav btn-submit" id="submitBtn" style="display: none;">
                            <i class="fas fa-check"></i> ثبت‌نام
                        </button>
                    </div>
                </form>
            </div>

            <div class="form-divider">
                <span>یا ثبت‌نام با</span>
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

            <div class="login-section">
                <p class="login-text">
                    قبلاً ثبت‌نام کرده‌اید؟
                    <a href="#" class="login-link">ورود به حساب</a>
                </p>
            </div>
        </div>
    </div>

    <!-- مودال قوانین و مقررات -->
    <div class="modal-overlay" id="termsModal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">قوانین و مقررات</h2>
                <button class="modal-close" id="modalClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-content">
                <p>به وبسایت آرمان رجایی خوش آمدید. با استفاده از این وبسایت، شما با شرایط زیر موافقت می‌کنید:</p>

                <h3>۱. شرایط استفاده</h3>
                <ul>
                    <li>کاربران باید حداقل ۱۸ سال سن داشته باشند</li>
                    <li>ارائه اطلاعات صحیح و دقیق الزامی است</li>
                    <li>هر کاربر مجاز به ایجاد تنها یک حساب کاربری است</li>
                    <li>مسئولیت حفظ امنیت حساب کاربری بر عهده کاربر است</li>
                </ul>

                <h3>۲. حریم خصوصی</h3>
                <ul>
                    <li>ما اطلاعات شخصی شما را محرمانه نگه می‌داریم</li>
                    <li>اطلاعات شما به اشخاص ثالث فروخته نمی‌شود</li>
                    <li>شما می‌توانید اطلاعات خود را در هر زمان ویرایش کنید</li>
                </ul>

                <h3>۳. محتوای ممنوعه</h3>
                <ul>
                    <li>ارسال محتوای غیرقانونی، توهین‌آمیز یا نامناسب ممنوع است</li>
                    <li>نقض حقوق مالکیت معنوی مجاز نیست</li>
                    <li>هرگونه فعالیت کلاهبرداری شدیداً ممنوع است</li>
                </ul>

                <h3>۴. تغییرات در قوانین</h3>
                <p>ما حق داریم این قوانین را در هر زمان تغییر دهیم. تغییرات در این صفحه اعمال خواهد شد و ادامه استفاده از وبسایت به معنای پذیرش تغییرات است.</p>

                <h3>۵. تماس با ما</h3>
                <p>در صورت داشتن هرگونه سوال در مورد این قوانین، می‌توانید از طریق بخش تماس با ما با ارتباط برقرار کنید.</p>
            </div>
        </div>
    </div>

    <script src="<?= asset('assets/js/auth/register.js') ?>"></script>">
</body>

</html>