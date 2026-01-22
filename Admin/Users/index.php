<?php
session_start();
require '../../helper/data-base.php';
require '../../helper/helper-functions.php';
require '../../assets/admin/layouts/sidebar.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت کاربران - پنل مدیریت پیشرفته</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> -->
    <link rel="stylesheet" href="<?= asset('assets/admin/style/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/admin/style/users.css') ?>">
</head>

<body>
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loader">
            <div class="loader-circle"></div>
            <div class="loader-text">در حال بارگذاری...</div>
        </div>
    </div>

    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div>
        <div class="bg-shape shape-3"></div>
        <div class="bg-shape shape-4"></div>
        <div class="bg-shape shape-5"></div>
        <div class="bg-shape shape-6"></div>
    </div>

    <div class="admin-container">
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Header (همان هدر اصلی) -->
            <header class="header">
                <div class="header-left">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="breadcrumb">
                        <span class="breadcrumb-item">خانه</span>
                        <i class="fas fa-chevron-left breadcrumb-separator"></i>
                        <span class="breadcrumb-item">مدیریت</span>
                        <i class="fas fa-chevron-left breadcrumb-separator"></i>
                        <span class="breadcrumb-item active">کاربران</span>
                    </div>
                </div>

                <div class="header-center">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="جستجو در کل سیستم..." id="globalSearch">
                        <kbd class="search-shortcut">Ctrl+K</kbd>
                    </div>
                </div>

                <div class="header-right">
                    <button class="icon-btn" id="quickActionsBtn" title="اقدامات سریع">
                        <i class="fas fa-bolt"></i>
                    </button>
                    <button class="icon-btn" id="themeToggle" title="تغییر تم">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="icon-btn" id="fullscreenToggle" title="تمام صفحه">
                        <i class="fas fa-expand"></i>
                    </button>
                    <div class="notification-dropdown">
                        <button class="icon-btn notification-btn" id="notificationBtn" title="اعلان‌ها">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge pulse">5</span>
                        </button>
                        <div class="notification-dropdown-menu" id="notificationMenu">
                            <div class="notification-header">
                                <span>اعلان‌ها</span>
                                <button class="mark-all-read">همه را خوانده شد</button>
                            </div>
                            <div class="notification-list">
                                <div class="notification-item unread">
                                    <div class="notification-icon success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">کاربر جدید ثبت‌نام کرد</div>
                                        <div class="notification-desc">مریم رضایی در سایت ثبت‌نام کرد</div>
                                        <div class="notification-time">2 دقیقه پیش</div>
                                    </div>
                                    <button class="notification-close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="notification-item unread">
                                    <div class="notification-icon warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">تلاش برای ورود ناموفق</div>
                                        <div class="notification-desc">کاربر با ایمیل user@example.com 5 بار تلاش ناموفق برای ورود داشت</div>
                                        <div class="notification-time">15 دقیقه پیش</div>
                                    </div>
                                    <button class="notification-close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="notification-item">
                                    <div class="notification-icon info">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">به‌روزرسانی سیستم</div>
                                        <div class="notification-desc">نسخه جدید سیستم در دسترس است</div>
                                        <div class="notification-time">1 ساعت پیش</div>
                                    </div>
                                    <button class="notification-close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="notification-footer">
                                <button class="view-all-notifications">مشاهده همه</button>
                            </div>
                        </div>
                    </div>
                    <div class="user-dropdown">
                        <button class="user-profile-btn" id="userProfileBtn">
                            <img src="" alt="کاربر" class="user-avatar">
                            <span class="user-status online"></span>
                        </button>
                        <div class="user-dropdown-menu" id="userMenu">
                            <div class="user-dropdown-header">
                                <img src="" alt="کاربر" class="dropdown-user-avatar">
                                <div class="dropdown-user-info">
                                    <div class="dropdown-user-name">آرمان رجایی</div>
                                    <div class="dropdown-user-email">admin@example.com</div>
                                </div>
                            </div>
                            <div class="user-dropdown-menu-items">
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-user"></i>
                                    <span>پروفایل</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-cog"></i>
                                    <span>تنظیمات</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-moon"></i>
                                    <span>حالت شب</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>خروج</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content (محتوای اختصاصی صفحه کاربران) -->
            <div class="content" id="content">
                <!-- Welcome Section -->
                <div class="welcome-section fade-in">
                    <div class="welcome-content">
                        <h1 class="welcome-title">مدیریت کاربران</h1>
                        <p class="welcome-subtitle">در این بخش می‌توانید کاربران سیستم را مدیریت کنید</p>
                    </div>
                    <div class="welcome-actions">
                        <button class="btn btn-primary" id="addNewUserBtn">
                            <i class="fas fa-plus"></i>
                            <span>افزودن کاربر جدید</span>
                        </button>
                        <button class="btn btn-outline" id="exportUsersBtn">
                            <i class="fas fa-download"></i>
                            <span>خروجی اکسل</span>
                        </button>
                    </div>
                </div>

                <!-- User Stats -->
                <div class="stats-grid">
                    <div class="stat-card primary fade-in" style="animation-delay: 0.1s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">12,543</div>
                            <div class="stat-title">کل کاربران</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>12.5% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>

                    <div class="stat-card success fade-in" style="animation-delay: 0.2s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">8,921</div>
                            <div class="stat-title">کاربران فعال</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>8.3% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="activeUsersChart"></canvas>
                        </div>
                    </div>

                    <div class="stat-card warning fade-in" style="animation-delay: 0.3s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">1,245</div>
                            <div class="stat-title">کاربران جدید (ماه)</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-down"></i>
                                <span>5.4% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="newUsersChart"></canvas>
                        </div>
                    </div>

                    <div class="stat-card info fade-in" style="animation-delay: 0.4s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-user-times"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">234</div>
                            <div class="stat-title">کاربران مسدود شده</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>2.3% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="blockedUsersChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- User Import/Export -->
                <div class="user-import-export fade-in" style="animation-delay: 0.5s;">
                    <button class="import-export-btn" id="importUsersBtn">
                        <i class="fas fa-file-import"></i>
                        <span>وارد کردن کاربران از فایل</span>
                    </button>
                    <button class="import-export-btn" id="exportUsersBtn2">
                        <i class="fas fa-file-export"></i>
                        <span>خروجی گرفتن از کاربران</span>
                    </button>
                    <button class="import-export-btn" id="sendEmailBtn">
                        <i class="fas fa-envelope"></i>
                        <span>ارسال ایمیل گروهی</span>
                    </button>
                </div>

                <!-- Advanced Filters -->
                <div class="user-filters-advanced fade-in" id="userFilters" style="display: none; animation-delay: 0.6s;">
                    <div class="filter-group">
                        <label>نقش:</label>
                        <select class="filter-select" id="roleFilter">
                            <option value="">همه نقش‌ها</option>
                            <option value="admin">مدیر</option>
                            <option value="editor">ویرایشگر</option>
                            <option value="author">نویسنده</option>
                            <option value="subscriber">مشترک</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>وضعیت:</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">همه وضعیت‌ها</option>
                            <option value="active">فعال</option>
                            <option value="inactive">غیرفعال</option>
                            <option value="blocked">مسدود</option>
                            <option value="pending">در انتظار تایید</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>تاریخ ثبت‌نام از:</label>
                        <input type="date" class="filter-input" id="dateFromFilter">
                    </div>
                    <div class="filter-group">
                        <label>تا:</label>
                        <input type="date" class="filter-input" id="dateToFilter">
                    </div>
                    <div class="filter-actions">
                        <button class="filter-btn filter-btn-apply" id="applyFilters">اعمال فیلترها</button>
                        <button class="filter-btn filter-btn-reset" id="resetFilters">بازنشانی</button>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="table-card fade-in" style="animation-delay: 0.7s;">
                    <div class="table-card-header">
                        <div class="table-title-section">
                            <h3 class="table-title">لیست کاربران</h3>
                            <p class="table-subtitle">مدیریت کاربران ثبت‌نام شده در سیستم</p>
                        </div>
                        <div class="table-actions">
                            <button class="table-action-btn" id="filterUsersBtn">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button class="table-action-btn" id="exportUsersBtn3">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="table-action-btn" id="refreshUsersBtn">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="table-checkbox-all">
                                    </th>
                                    <th>کاربر</th>
                                    <th>ایمیل</th>
                                    <th>نقش</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت‌نام</th>
                                    <th>آخرین فعالیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tr>
                                <?php
                                global $pdo;
                                $query = 'SELECT * FROM `users`';
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $users = $statement->fetchAll();
                                ?>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <td><input type="checkbox" class="table-checkbox"></td>
                                        <td>
                                            <div class="customer-cell">
                                                <img src="<?php echo htmlspecialchars($user['avatar'] ?? ''); ?>" alt="کاربر" class="customer-avatar">
                                                <span class="customer-name"><?php echo htmlspecialchars(trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?: ($user['username'] ?? 'کاربر')); ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['email'] ?? '-'); ?></td>
                                        <td>
                                            <?php
                                            $role = $user['role'] ?? 'subscriber';
                                            $roleClassMap = ['admin' => 'primary', 'editor' => 'info', 'author' => 'warning', 'subscriber' => 'secondary'];
                                            $roleLabelMap = ['admin' => 'مدیر', 'editor' => 'ویرایشگر', 'author' => 'نویسنده', 'subscriber' => 'مشترک'];
                                            $roleClass = $roleClassMap[$role] ?? 'secondary';
                                            $roleLabel = $roleLabelMap[$role] ?? htmlspecialchars($role);
                                            ?>
                                            <span class="status-badge <?php echo $roleClass; ?>">
                                                <i class="fas fa-user"></i>
                                                <?php echo $roleLabel; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $status = $user['status'] ?? 'inactive';
                                            $statusClass = ($status == 'active') ? 'success' : (($status == 'blocked') ? 'danger' : (($status == 'pending') ? 'pending' : 'secondary'));
                                            $statusLabel = ($status == 'active') ? 'فعال' : (($status == 'blocked') ? 'مسدود' : (($status == 'pending') ? 'در انتظار تایید' : 'غیرفعال'));
                                            ?>
                                            <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span>
                                        </td>
                                        <td>
                                            <span class="date"><?php echo htmlspecialchars($user['created_at'] ?? '-'); ?></span>
                                        </td>
                                        <td>
                                            <span class="date"><?php echo htmlspecialchars($user['last_login'] ?? '-'); ?></span>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="action-btn view" title="مشاهده" data-user-id="<?php echo (int)($user['id'] ?? 0); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" title="ویرایش" data-user-id="<?php echo (int)($user['id'] ?? 0); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn delete" title="حذف" data-user-id="<?php echo (int)($user['id'] ?? 0); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <button class="action-btn more" title="بیشتر" data-user-id="<?php echo (int)($user['id'] ?? 0); ?>">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <div class="table-info">
                            نمایش 1 تا 5 از 12,543 مورد
                        </div>
                        <div class="pagination">
                            <button class="page-btn" disabled>
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <span class="page-dots">...</span>
                            <button class="page-btn">2509</button>
                            <button class="page-btn">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Detail Modal -->
    <div class="modal" id="userDetailModal">
        <div class="modal-overlay"></div>
        <div class="modal-content user-detail-modal">
            <div class="modal-header">
                <h3 class="modal-title">جزئیات کاربر</h3>
                <button class="modal-close" id="closeUserDetailModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="user-detail-grid">
                    <div class="user-avatar-section">
                        <img src=" alt="کاربر" class="user-avatar-large" id="modalUserAvatar">
                        <h4 id="modalUserName">علی احمدی</h4>
                        <span class="status-badge success" id="modalUserStatus">فعال</span>
                        <div class="user-roles" id="modalUserRoles">
                            <span class="user-role-badge">
                                <i class="fas fa-crown"></i>
                                مدیر
                            </span>
                        </div>
                        <div class="user-status-toggle">
                            <span>وضعیت کاربر:</span>
                            <div class="toggle-switch active" id="userStatusToggle"></div>
                        </div>
                    </div>
                    <div class="user-info-section">
                        <div class="user-info-group">
                            <div class="user-info-label">اطلاعات تماس</div>
                            <div class="user-info-value">
                                <div><i class="fas fa-envelope"></i> ali.ahmadi@example.com</div>
                                <div><i class="fas fa-phone"></i> 09123456789</div>
                            </div>
                        </div>
                        <div class="user-info-group">
                            <div class="user-info-label">اطلاعات حساب کاربری</div>
                            <div class="user-info-value">
                                <div><i class="fas fa-user"></i> نام کاربری: ali.ahmadi</div>
                                <div><i class="fas fa-calendar"></i> تاریخ ثبت‌نام: 1402/01/15</div>
                                <div><i class="fas fa-clock"></i> آخرین ورود: 1402/03/20 - 14:35</div>
                            </div>
                        </div>
                        <div class="user-info-group">
                            <div class="user-info-label">آمار فعالیت</div>
                            <div class="user-info-value">
                                <div><i class="fas fa-sign-in-alt"></i> تعداد ورود: 245 بار</div>
                                <div><i class="fas fa-edit"></i> تعداد ویرایش: 89 مورد</div>
                                <div><i class="fas fa-comment"></i> تعداد نظرات: 34 مورد</div>
                            </div>
                        </div>
                        <div class="user-activity-log">
                            <div class="user-info-label">لاگ فعالیت‌های اخیر</div>
                            <div class="activity-log-item">
                                <div class="activity-log-icon success">
                                    <i class="fas fa-sign-in-alt"></i>
                                </div>
                                <div class="activity-log-content">
                                    <div class="activity-log-title">ورود به سیستم</div>
                                    <div class="activity-log-desc">ورود از آی‌پی 192.168.1.1</div>
                                    <div class="activity-log-time">1402/03/20 - 14:35</div>
                                </div>
                            </div>
                            <div class="activity-log-item">
                                <div class="activity-log-icon info">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="activity-log-content">
                                    <div class="activity-log-title">ویرایش پروفایل</div>
                                    <div class="activity-log-desc">تغییر اطلاعات تماس</div>
                                    <div class="activity-log-time">1402/03/19 - 10:22</div>
                                </div>
                            </div>
                            <div class="activity-log-item">
                                <div class="activity-log-icon warning">
                                    <i class="fas fa-key"></i>
                                </div>
                                <div class="activity-log-content">
                                    <div class="activity-log-title">تغییر رمز عبور</div>
                                    <div class="activity-log-desc">رمز عبور با موفقیت تغییر کرد</div>
                                    <div class="activity-log-time">1402/03/15 - 16:45</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeUserDetailModalBtn">
                    <i class="fas fa-times"></i>
                    <span>بستن</span>
                </button>
                <button class="btn btn-primary" id="editUserBtn">
                    <i class="fas fa-edit"></i>
                    <span>ویرایش کاربر</span>
                </button>
            </div>
        </div>
    </div>

    <?php
    //  creating a new user
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_user') {
        // Basic validation & sanitization
        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = trim($_POST['role'] ?? 'subscriber');
        $status = trim($_POST['status'] ?? 'inactive');
        $bio = trim($_POST['bio'] ?? '');
        $sendWelcome = isset($_POST['sendWelcomeEmail']) ? 1 : 0;

        // Required fields
        if ($username === '' || $email === '') {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'نام کاربری و ایمیل الزامی است'];
            header('Location: index.php');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'ایمیل معتبر وارد کنید'];
            header('Location: index.php');
            exit;
        }

        // Generate a password if none provided
        if (trim($password) === '') {
            $password = bin2hex(random_bytes(6)); // temporary password
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        global $pdo;

        try {
            // Check for existing username or email
            $check = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1');
            $check->execute([$username, $email]);
            if ($check->fetch()) {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'نام کاربری یا ایمیل قبلاً استفاده شده است'];
                header('Location: index.php');
                exit;
            }

            $query = 'INSERT INTO `users` (`first_name`, `last_name`, `email`, `phone`, `username`, `password`, `role`, `status`, `bio`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $statement = $pdo->prepare($query);
            $statement->execute([
                $first_name,
                $last_name,
                $email,
                $phone,
                $username,
                $passwordHash,
                $role,
                $status,
                $bio,
                date('Y-m-d H:i:s')
            ]);

            // Log insert for debugging
            $insertId = $pdo->lastInsertId();
            @error_log("[Users] insert id={$insertId} username={$username} email={$email} at " . date('Y-m-d H:i:s') . "\n", 3, __DIR__ . '/users_debug.log');

            // Optionally send welcome email (placeholder)
            if ($sendWelcome) {
                // send_welcome_email($email, $password); // implement as needed
            }

            $_SESSION['flash'] = ['type' => 'success', 'message' => 'کاربر با موفقیت ایجاد شد'];
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            // Log error in real application
            @error_log("[Users] insert error: " . $e->getMessage() . " at " . date('Y-m-d H:i:s') . "\n" . $e->getTraceAsString() . "\n", 3, __DIR__ . '/users_debug.log');
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'خطا در ذخیره‌سازی: ' . $e->getMessage()];
            header('Location: index.php');
            exit;
        }
    }

    // AJAX: return user data as JSON for populating edit form
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_user' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        try {
            $stmt = $pdo->prepare('SELECT id, first_name, last_name, email, phone, username, role, status, bio FROM users WHERE id = ? LIMIT 1');
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            header('Content-Type: application/json; charset=utf-8');
            if ($user) {
                echo json_encode(['success' => true, 'user' => $user]);
            } else {
                echo json_encode(['success' => false, 'message' => 'کاربر یافت نشد']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'خطا: ' . $e->getMessage()]);
        }
        exit;
    }

    // Handle user edit
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_user') {
        $id = (int)($_POST['user_id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'شناسه کاربر معتبر نیست'];
            header('Location: index.php');
            exit;
        }

        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = trim($_POST['role'] ?? 'subscriber');
        $status = trim($_POST['status'] ?? 'inactive');
        $bio = trim($_POST['bio'] ?? '');

        if ($username === '' || $email === '') {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'نام کاربری و ایمیل الزامی است'];
            header('Location: index.php');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'ایمیل معتبر وارد کنید'];
            header('Location: index.php');
            exit;
        }

        try {
            // Check duplicates excluding current user
            $check = $pdo->prepare('SELECT id FROM users WHERE (username = ? OR email = ?) AND id <> ? LIMIT 1');
            $check->execute([$username, $email, $id]);
            if ($check->fetch()) {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'نام کاربری یا ایمیل متعلق به کاربر دیگری است'];
                header('Location: index.php');
                exit;
            }

            // Build update query
            $params = [$first_name, $last_name, $email, $phone, $username, $role, $status, $bio, date('Y-m-d H:i:s'), $id];
            $sql = 'UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, username = ?, role = ?, status = ?, bio = ?, updated_at = ?';
            if (trim($password) !== '') {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql .= ', password = ?';
                array_splice($params, count($params) - 1, 0, $passwordHash); // insert before updated_at and id
            }
            $sql .= ' WHERE id = ? LIMIT 1';

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            @error_log("[Users] updated id={$id} by admin at " . date('Y-m-d H:i:s') . "\n", 3, __DIR__ . '/users_debug.log');

            $_SESSION['flash'] = ['type' => 'success', 'message' => 'کاربر با موفقیت بروزرسانی شد'];
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            @error_log("[Users] update error: " . $e->getMessage() . "\n", 3, __DIR__ . '/users_debug.log');
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'خطا در بروزرسانی: ' . $e->getMessage()];
            header('Location: index.php');
            exit;
        }
    }

    // Handle user delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_user') {
        $id = (int)($_POST['user_id'] ?? 0);
        $reason = trim($_POST['delete_reason'] ?? '');

        if ($id <= 0) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'شناسه کاربر معتبر نیست'];
            header('Location: index.php');
            exit;
        }

        try {
            // Optionally: take a backup or move to an archive table before delete
            $stmt = $pdo->prepare('DELETE FROM users WHERE id = ? LIMIT 1');
            $stmt->execute([$id]);

            @error_log("[Users] deleted id={$id} reason={$reason} at " . date('Y-m-d H:i:s') . "\n", 3, __DIR__ . '/users_debug.log');

            $_SESSION['flash'] = ['type' => 'success', 'message' => 'کاربر با موفقیت حذف شد'];
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            @error_log("[Users] delete error: " . $e->getMessage() . "\n", 3, __DIR__ . '/users_debug.log');
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'خطا در حذف کاربر: ' . $e->getMessage()];
            header('Location: index.php');
            exit;
        }
    }
    ?>
    <!-- Add/Edit User Modal -->
    <div class="modal" id="addEditUserModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addEditUserModalTitle">افزودن کاربر جدید</h3>
                <button class="modal-close" id="closeAddEditUserModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm" method="post" action="">
                    <input type="hidden" name="action" id="formAction" value="create_user">
                    <input type="hidden" name="user_id" id="userIdInput" value="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userFirstName">نام</label>
                            <input type="text" id="userFirstName" name="first_name" class="form-input" placeholder="نام کاربر" required>
                        </div>
                        <div class="form-group">
                            <label for="userLastName">نام خانوادگی</label>
                            <input type="text" id="userLastName" name="last_name" class="form-input" placeholder="نام خانوادگی کاربر" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userEmail">ایمیل</label>
                            <input type="email" id="userEmail" name="email" class="form-input" placeholder="ایمیل کاربر" required>
                        </div>
                        <div class="form-group">
                            <label for="userPhone">شماره تلفن</label>
                            <input type="tel" id="userPhone" name="phone" class="form-input" placeholder="شماره تلفن کاربر">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userUsername">نام کاربری</label>
                            <input type="text" id="userUsername" name="username" class="form-input" placeholder="نام کاربری" required>
                        </div>
                        <div class="form-group">
                            <label for="userPassword">رمز عبور</label>
                            <input type="password" id="userPassword" name="password" class="form-input" placeholder="رمز عبور">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userRole">نقش</label>
                            <select id="userRole" name="role" class="form-input" required>
                                <option value="">انتخاب نقش</option>
                                <option value="admin">مدیر</option>
                                <option value="editor">ویرایشگر</option>
                                <option value="author">نویسنده</option>
                                <option value="subscriber">مشترک</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userStatus">وضعیت</label>
                            <select id="userStatus" name="status" class="form-input" required>
                                <option value="active">فعال</option>
                                <option value="inactive">غیرفعال</option>
                                <option value="pending">در انتظار تایید</option>
                                <option value="blocked">مسدود</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userBio">بیوگرافی</label>
                        <textarea id="userBio" name="bio" class="form-input" rows="4" placeholder="توضیحات درباره کاربر"></textarea>
                    </div>
                    <div class="form-group">
                        <label>ارسال ایمیل خوش‌آمدگویی</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="sendWelcomeEmail" name="sendWelcomeEmail" value="1" checked>
                                <span class="checkbox-custom"></span>
                                <span class="checkbox-text">ارسال ایمیل خوش‌آمدگویی به کاربر</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeAddEditUserModalBtn">
                    <i class="fas fa-times"></i>
                    <span>انصراف</span>
                </button>
                <button class="btn btn-primary" id="saveUserBtn" type="submit" form="userForm">
                    <i class="fas fa-save"></i>
                    <span>ذخیره کاربر</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal" id="deleteUserModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">حذف کاربر</h3>
                <button class="modal-close" id="closeDeleteUserModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <h4>آیا از حذف این کاربر اطمینان دارید؟</h4>
                        <p>با حذف این کاربر، تمام اطلاعات مربوط به او از سیستم حذف خواهد شد. این عملیات غیرقابل بازگشت است.</p>
                    </div>
                </div>
                <form id="deleteUserForm" method="post" action="">
                    <input type="hidden" name="action" value="delete_user">
                    <input type="hidden" name="user_id" id="deleteUserId" value="">
                    <div class="form-group">
                        <label>دلیل حذف (اختیاری)</label>
                        <textarea id="deleteReason" name="delete_reason" class="form-input" rows="3" placeholder="دلیل حذف کاربر را وارد کنید"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeDeleteUserModalBtn">
                    <i class="fas fa-times"></i>
                    <span>انصراف</span>
                </button>
                <button class="btn btn-danger" id="confirmDeleteUserBtn" type="submit" form="deleteUserForm">
                    <i class="fas fa-trash"></i>
                    <span>حذف کاربر</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="<?= asset('assets/admin/script/users.js') ?>"></script>
    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    showToast('<?php echo htmlspecialchars($_SESSION['flash']['type'], ENT_QUOTES); ?>', '<?php echo addslashes($_SESSION['flash']['message']); ?>');
                } catch (e) {
                    console.error('Flash showToast error', e);
                }
            });
        </script>
    <?php unset($_SESSION['flash']);
    endif; ?>
</body>

</html>