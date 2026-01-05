<?php 
session_start();
require '../helper/data-base.php';
require '../helper/helper-functions.php';
require '../assets/admin/layouts/sidebar.php';
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت پیشرفته - آرمان رجایی</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/Admin/style/style.css">
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
        <!-- Sidebar -->
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="breadcrumb">
                        <span class="breadcrumb-item">خانه</span>
                        <i class="fas fa-chevron-left breadcrumb-separator"></i>
                        <span class="breadcrumb-item active">داشبورد</span>
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
                                        <div class="notification-title">سفارش جدید</div>
                                        <div class="notification-desc">سفارش #12345 با موفقیت ثبت شد</div>
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
                                        <div class="notification-title">موجودی کافی نیست</div>
                                        <div class="notification-desc">محصول "پلن حرفه‌ای" در حال اتمام است</div>
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
                            <img src="https://picsum.photos/seed/adminuser/35/35.jpg" alt="کاربر" class="user-avatar">
                            <span class="user-status online"></span>
                        </button>
                        <div class="user-dropdown-menu" id="userMenu">
                            <div class="user-dropdown-header">
                                <img src="https://picsum.photos/seed/adminuser/50/50.jpg" alt="کاربر" class="dropdown-user-avatar">
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
            
            <!-- Content -->
            <div class="content" id="content">
                <!-- Welcome Section -->
                <div class="welcome-section fade-in">
                    <div class="welcome-content">
                        <h1 class="welcome-title">خوش آمدید، آرمان!</h1>
                        <p class="welcome-subtitle">امروز یک روز عالی برای مدیریت کسب‌وکار شماست</p>
                    </div>
                    <div class="welcome-actions">
                        <button class="btn btn-primary" id="addNewBtn">
                            <i class="fas fa-plus"></i>
                            <span>افزودن جدید</span>
                        </button>
                        <button class="btn btn-outline">
                            <i class="fas fa-download"></i>
                            <span>دانلود گزارش</span>
                        </button>
                    </div>
                </div>
                
                <!-- Quick Stats -->
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
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">₮ 892,450</div>
                            <div class="stat-title">درآمد کل</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>23.1% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="stat-card warning fade-in" style="animation-delay: 0.3s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">3,456</div>
                            <div class="stat-title">سفارشات جدید</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-down"></i>
                                <span>5.4% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="stat-card info fade-in" style="animation-delay: 0.4s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-percentage"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">68.5%</div>
                            <div class="stat-title">نرخ تبدیل</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>2.3% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="conversionChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Row -->
                <div class="charts-row">
                    <div class="chart-card large fade-in" style="animation-delay: 0.5s;">
                        <div class="chart-card-header">
                            <div class="chart-title-section">
                                <h3 class="chart-title">تحلیل فروش</h3>
                                <p class="chart-subtitle">بررسی روند فروش در 6 ماه گذشته</p>
                            </div>
                            <div class="chart-actions">
                                <div class="chart-period-tabs">
                                    <button class="period-tab active" data-period="week">هفته</button>
                                    <button class="period-tab" data-period="month">ماه</button>
                                    <button class="period-tab" data-period="year">سال</button>
                                </div>
                                <button class="chart-action-btn">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="chart-action-btn">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="salesAnalysisChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="chart-card fade-in" style="animation-delay: 0.6s;">
                        <div class="chart-card-header">
                            <div class="chart-title-section">
                                <h3 class="chart-title">محصولات پرفروش</h3>
                                <p class="chart-subtitle">10 محصول برتر این ماه</p>
                            </div>
                            <div class="chart-actions">
                                <button class="chart-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="topProductsChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Tables Row -->
                <div class="tables-row">
                    <div class="table-card fade-in" style="animation-delay: 0.7s;">
                        <div class="table-card-header">
                            <div class="table-title-section">
                                <h3 class="table-title">آخرین سفارشات</h3>
                                <p class="table-subtitle">10 سفارش اخیر سیستم</p>
                            </div>
                            <div class="table-actions">
                                <button class="table-action-btn" id="filterOrdersBtn">
                                    <i class="fas fa-filter"></i>
                                </button>
                                <button class="table-action-btn" id="exportOrdersBtn">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="table-action-btn" id="refreshOrdersBtn">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="table-filters" id="ordersFilters" style="display: none;">
                            <div class="filter-group">
                                <label>وضعیت:</label>
                                <select class="filter-select">
                                    <option>همه</option>
                                    <option>موفق</option>
                                    <option>در حال پردازش</option>
                                    <option>لغو شده</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>تاریخ:</label>
                                <input type="date" class="filter-input">
                            </div>
                            <div class="filter-group">
                                <label>مبلغ:</label>
                                <select class="filter-select">
                                    <option>همه</option>
                                    <option>0-100,000</option>
                                    <option>100,000-500,000</option>
                                    <option>500,000+</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="table-checkbox-all">
                                        </th>
                                        <th>شماره سفارش</th>
                                        <th>مشتری</th>
                                        <th>محصولات</th>
                                        <th>مبلغ</th>
                                        <th>وضعیت</th>
                                        <th>تاریخ</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="table-checkbox"></td>
                                        <td>
                                            <span class="order-number">#12345</span>
                                        </td>
                                        <td>
                                            <div class="customer-cell">
                                                <img src="https://picsum.photos/seed/user1/30/30.jpg" alt="مشتری" class="customer-avatar">
                                                <span class="customer-name">علی احمدی</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="products-cell">
                                                <span class="product-count">3 محصول</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="amount">₮ 250,000</span>
                                        </td>
                                        <td>
                                            <span class="status-badge success">موفق</span>
                                        </td>
                                        <td>
                                            <span class="date">1402/03/15</span>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="action-btn view" title="مشاهده">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" title="ویرایش">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn more" title="بیشتر">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="table-checkbox"></td>
                                        <td>
                                            <span class="order-number">#12346</span>
                                        </td>
                                        <td>
                                            <div class="customer-cell">
                                                <img src="https://picsum.photos/seed/user2/30/30.jpg" alt="مشتری" class="customer-avatar">
                                                <span class="customer-name">مریم رضایی</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="products-cell">
                                                <span class="product-count">1 محصول</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="amount">₮ 80,000</span>
                                        </td>
                                        <td>
                                            <span class="status-badge processing">در حال پردازش</span>
                                        </td>
                                        <td>
                                            <span class="date">1402/03/14</span>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="action-btn view" title="مشاهده">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" title="ویرایش">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn more" title="بیشتر">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="table-checkbox"></td>
                                        <td>
                                            <span class="order-number">#12347</span>
                                        </td>
                                        <td>
                                            <div class="customer-cell">
                                                <img src="https://picsum.photos/seed/user3/30/30.jpg" alt="مشتری" class="customer-avatar">
                                                <span class="customer-name">محمد محمدی</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="products-cell">
                                                <span class="product-count">5 محصول</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="amount">₮ 450,000</span>
                                        </td>
                                        <td>
                                            <span class="status-badge pending">در انتظار</span>
                                        </td>
                                        <td>
                                            <span class="date">1402/03/13</span>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="action-btn view" title="مشاهده">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" title="ویرایش">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn more" title="بیشتر">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="table-footer">
                            <div class="table-info">
                                نمایش 1 تا 10 از 89 مورد
                            </div>
                            <div class="pagination">
                                <button class="page-btn" disabled>
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <span class="page-dots">...</span>
                                <button class="page-btn">9</button>
                                <button class="page-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="activity-card fade-in" style="animation-delay: 0.8s;">
                        <div class="activity-card-header">
                            <div class="activity-title-section">
                                <h3 class="activity-title">فعالیت‌های اخیر</h3>
                                <p class="activity-subtitle">آخرین تغییرات سیستم</p>
                            </div>
                            <div class="activity-actions">
                                <button class="activity-action-btn">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="activity-timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker success">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <span class="timeline-title">سفارش جدید ثبت شد</span>
                                        <span class="timeline-time">همین الان</span>
                                    </div>
                                    <div class="timeline-desc">
                                        مشتری <strong>علی احمدی</strong> سفارش #12345 را ثبت کرد
                                    </div>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker warning">
                                    <i class="fas fa-exclamation"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <span class="timeline-title">موجودی کافی نیست</span>
                                        <span class="timeline-time">5 دقیقه پیش</span>
                                    </div>
                                    <div class="timeline-desc">
                                        محصول <strong>پلن حرفه‌ای</strong> در حال اتمام است
                                    </div>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker info">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <span class="timeline-title">کاربر جدید عضو شد</span>
                                        <span class="timeline-time">15 دقیقه پیش</span>
                                    </div>
                                    <div class="timeline-desc">
                                        <strong>مریم رضایی</strong> در سایت ثبت‌نام کرد
                                    </div>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker primary">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <span class="timeline-title">محصول ویرایش شد</span>
                                        <span class="timeline-time">1 ساعت پیش</span>
                                    </div>
                                    <div class="timeline-desc">
                                        محصول <strong>پلن پیشرفته</strong> ویرایش شد
                                    </div>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker success">
                                    <i class="fas fa-comment"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <span class="timeline-title">نظر جدید ثبت شد</span>
                                        <span class="timeline-time">2 ساعت پیش</span>
                                    </div>
                                    <div class="timeline-desc">
                                        <strong>محمد محمدی</strong> نظر جدیدی ثبت کرد
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions & Calendar -->
                <div class="bottom-row">
                    <div class="quick-actions-card fade-in" style="animation-delay: 0.9s;">
                        <div class="quick-actions-header">
                            <h3 class="quick-actions-title">اقدامات سریع</h3>
                        </div>
                        <div class="quick-actions-grid">
                            <button class="quick-action-btn">
                                <div class="quick-action-icon primary">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="quick-action-text">افزودن محصول</span>
                            </button>
                            <button class="quick-action-btn">
                                <div class="quick-action-icon success">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <span class="quick-action-text">کاربر جدید</span>
                            </button>
                            <button class="quick-action-btn">
                                <div class="quick-action-icon warning">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <span class="quick-action-text">ایجاد فاکتور</span>
                            </button>
                            <button class="quick-action-btn">
                                <div class="quick-action-icon info">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <span class="quick-action-text">گزارش جدید</span>
                            </button>
                            <button class="quick-action-btn">
                                <div class="quick-action-icon secondary">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <span class="quick-action-text">ارسال ایمیل</span>
                            </button>
                            <button class="quick-action-btn">
                                <div class="quick-action-icon danger">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <span class="quick-action-text">اعلان جدید</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="calendar-card fade-in" style="animation-delay: 1s;">
                        <div class="calendar-header">
                            <h3 class="calendar-title">تقویم</h3>
                            <div class="calendar-nav">
                                <button class="calendar-nav-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <span class="calendar-month">فروردین 1403</span>
                                <button class="calendar-nav-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                        <div class="calendar-grid">
                            <div class="calendar-weekdays">
                                <div class="calendar-weekday">ش</div>
                                <div class="calendar-weekday">ی</div>
                                <div class="calendar-weekday">د</div>
                                <div class="calendar-weekday">س</div>
                                <div class="calendar-weekday">چ</div>
                                <div class="calendar-weekday">پ</div>
                                <div class="calendar-weekday">ج</div>
                            </div>
                            <div class="calendar-days">
                                <div class="calendar-day empty"></div>
                                <div class="calendar-day empty"></div>
                                <div class="calendar-day empty"></div>
                                <div class="calendar-day">1</div>
                                <div class="calendar-day">2</div>
                                <div class="calendar-day">3</div>
                                <div class="calendar-day">4</div>
                                <div class="calendar-day">5</div>
                                <div class="calendar-day">6</div>
                                <div class="calendar-day">7</div>
                                <div class="calendar-day">8</div>
                                <div class="calendar-day">9</div>
                                <div class="calendar-day">10</div>
                                <div class="calendar-day">11</div>
                                <div class="calendar-day today">12</div>
                                <div class="calendar-day">13</div>
                                <div class="calendar-day">14</div>
                                <div class="calendar-day has-event">15</div>
                                <div class="calendar-day">16</div>
                                <div class="calendar-day">17</div>
                                <div class="calendar-day">18</div>
                                <div class="calendar-day">19</div>
                                <div class="calendar-day">20</div>
                                <div class="calendar-day">21</div>
                                <div class="calendar-day">22</div>
                                <div class="calendar-day">23</div>
                                <div class="calendar-day">24</div>
                                <div class="calendar-day">25</div>
                                <div class="calendar-day">26</div>
                                <div class="calendar-day">27</div>
                                <div class="calendar-day">28</div>
                                <div class="calendar-day">29</div>
                                <div class="calendar-day">30</div>
                                <div class="calendar-day">31</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions Modal -->
    <div class="modal" id="quickActionsModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">اقدامات سریع</h3>
                <button class="modal-close" id="closeQuickActionsModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="quick-actions-modal-grid">
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-box"></i>
                        <span>محصول جدید</span>
                    </button>
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>کاربر جدید</span>
                    </button>
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-file-invoice"></i>
                        <span>فاکتور جدید</span>
                    </button>
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-chart-bar"></i>
                        <span>گزارش جدید</span>
                    </button>
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-envelope"></i>
                        <span>ارسال ایمیل</span>
                    </button>
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-bullhorn"></i>
                        <span>اعلان جدید</span>
                    </button>
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-tags"></i>
                        <span>تخفیف جدید</span>
                    </button>
                    <button class="quick-action-modal-btn">
                        <i class="fas fa-blog"></i>
                        <span>مقاله جدید</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/Admin/script/script.js"></script>
</body>
</html>