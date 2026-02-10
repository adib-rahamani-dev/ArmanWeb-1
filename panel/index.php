<?php
session_start();
require '../helper/data-base.php';
require '../helper/helper-functions.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری | آرمان رجایی</title>
    <!-- استفاده از فونت آیکون‌ها همانطور که در کد اصلی شما بود -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../assets/style/panel/style.css" />
    <link rel="stylesheet" href="../assets/style/main.css" />

    <style>

    </style>
</head>

<body>

    <!-- هدر موبایل -->
    <div class="mobile-header">
        <div class="logo">آرمان رجایی</div>
        <div class="menu-toggle" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>

    <!-- سایدبار -->
    <aside class="sidebar" id="sidebar">
        <div class="user-profile-summary">
            <!-- عکس پروفایل تصادفی -->
            <img src="https://picsum.photos/seed/user1/200/200" alt="پروفایل" class="user-avatar">
            <h2 class="user-name"><?= $_SESSION['first_name'] . " ". $_SESSION['last_name'] ?></h2>
            <p class="user-role"><?=  $_SESSION['role']  ?></p>
        </div>

        <ul class="nav-links">
            <li><a href="#" class="active"><i class="fa-solid fa-house"></i> داشبورد</a></li>
            <li><a href="#"><i class="fa-solid fa-cart-shopping"></i> سبد خرید <span style="background:var(--primary); padding:2px 6px; border-radius:10px; font-size:10px; margin-right:auto;">2</span></a></li>
            <li><a href="#"><i class="fa-solid fa-box-open"></i> سفارش‌های من</a></li>
            <li><a href="#"><i class="fa-solid fa-heart"></i> علاقه‌مندی‌ها</a></li>
            <li><a href="#"><i class="fa-regular fa-id-card"></i> پروفایل من</a></li>
            <li><a href="#"><i class="fa-solid fa-headset"></i> پشتیبانی</a></li>
        </ul>

        <button class="logout-btn" onclick="alert('خروج با موفقیت انجام شد')">
            <i class="fa-solid fa-right-from-bracket"></i> خروج از حساب
        </button>
    </aside>

    <!-- محتوای اصلی -->
    <main class="main-content">
        <!-- کارت‌های آمار -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                <div class="stat-info">
                    <h3>5</h3>
                    <p>سفارش موفق</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-wallet"></i></div>
                <div class="stat-info">
                    <h3>2,500,000</h3>
                    <p>کل خرید (تومان)</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-gift"></i></div>
                <div class="stat-info">
                    <h3>3</h3>
                    <p>امتیاز وفاداری</p>
                </div>
            </div>
        </section>

        <!-- بخش سبد خرید فعال -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title"><i class="fa-solid fa-cart-shopping"></i> سبد خرید فعلی</h2>
                <a href="#" class="view-all-btn">مشاهده کامل سبد <i class="fa-solid fa-angle-left"></i></a>
            </div>

            <div class="cart-items">
                <!-- آیتم 1 -->
                <div class="cart-item">
                    <img src="https://picsum.photos/seed/prod1/100/100" alt="محصول">
                    <div class="cart-details">
                        <h3 class="cart-title">پکیج پوشش ریلز حرفه‌ای</h3>
                        <p class="cart-price">450,000 تومان</p>
                    </div>
                    <button class="cart-action">تسویه حساب</button>
                </div>
                <!-- آیتم 2 -->
                <div class="cart-item">
                    <img src="https://picsum.photos/seed/prod2/100/100" alt="محصول">
                    <div class="cart-details">
                        <h3 class="cart-title">مشاوره پیج اینستاگرام</h3>
                        <p class="cart-price">200,000 تومان</p>
                    </div>
                    <button class="cart-action">تسویه حساب</button>
                </div>
            </div>
        </section>

        <!-- بخش سفارش‌های اخیر -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title"><i class="fa-solid fa-clock-rotate-left"></i> تاریخچه سفارشات</h2>
                <a href="#" class="view-all-btn">مشاهده همه <i class="fa-solid fa-angle-left"></i></a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>شماره سفارش</th>
                            <th>تاریخ</th>
                            <th>مبلغ کل</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-1024</td>
                            <td>1403/08/10</td>
                            <td>150,000 تومان</td>
                            <td><span class="status status-success">تکمیل شده</span></td>
                            <td><button class="action-btn">جزئیات</button></td>
                        </tr>
                        <tr>
                            <td>#ORD-1023</td>
                            <td>1403/08/05</td>
                            <td>850,000 تومان</td>
                            <td><span class="status status-success">تکمیل شده</span></td>
                            <td><button class="action-btn">جزئیات</button></td>
                        </tr>
                        <tr>
                            <td>#ORD-1020</td>
                            <td>1403/07/28</td>
                            <td>1,200,000 تومان</td>
                            <td><span class="status status-pending">در حال پردازش</span></td>
                            <td><button class="action-btn">پیگیری</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        // اسکریپت ساده برای باز و بسته کردن منو در موبایل
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // بستن منو وقتی روی محتوای اصلی کلیک شد (در حالت موبایل)
        document.querySelector('.main-content').addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('active');
            }
        });
    </script>
</body>

</html>