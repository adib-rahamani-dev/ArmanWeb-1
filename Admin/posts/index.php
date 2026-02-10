<?php
session_start();
require_once '../../helper/data-base.php';
require_once '../../helper/helper-functions.php';
// require '../auth/check-admin-login.php';
require_once '../../assets/admin/layouts/sidebar.php';
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت پیشرفته - آرمان رجایی</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/Admin/style/style.css">
    <link rel="stylesheet" href="../../assets/Admin/style/users.css">
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
            <!-- Header -->
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
                        <span class="breadcrumb-item active">پست‌ها</span>
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
                            <!-- Notification items -->
                        </div>
                    </div>
                    <div class="user-dropdown">
                        <button class="user-profile-btn" id="userProfileBtn">
                            <img src="" alt="کاربر" class="user-avatar">
                            <span class="user-status online"></span>
                        </button>
                        <div class="user-dropdown-menu" id="userMenu">
                            <!-- User dropdown items -->
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="content" id="content">
                <!-- Welcome Section -->
                <div class="welcome-section fade-in">
                    <div class="welcome-content">
                        <h1 class="welcome-title">مدیریت پست‌ها</h1>
                        <p class="welcome-subtitle">در این بخش می‌توانید پست‌ها را مدیریت کنید</p>
                    </div>
                    <div class="welcome-actions">
                        <button class="btn btn-primary" id="addNewPostBtn">
                            <i class="fas fa-plus"></i>
                            <span>افزودن پست جدید</span>
                        </button>
                        <button class="btn btn-outline" id="exportPostsBtn">
                            <i class="fas fa-download"></i>
                            <span>خروجی اکسل</span>
                        </button>
                    </div>
                </div>

                <!-- Post Stats -->
                <div class="stats-grid">
                    <div class="stat-card primary fade-in" style="animation-delay: 0.1s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">12,543</div>
                            <div class="stat-title">کل پست‌ها</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>12.5% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="postsChart"></canvas>
                        </div>
                    </div>

                    <div class="stat-card success fade-in" style="animation-delay: 0.2s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">8,921</div>
                            <div class="stat-title">پست‌های فعال</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>8.3% نسبت به ماه 爷爷</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="activePostsChart"></canvas>
                        </div>
                    </div>

                    <div class="stat-card warning fade-in" style="animation-delay: 0.3s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">1,245</div>
                            <div class="stat-title">پست‌های جدید (ماه)</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-down"></i>
                                <span>5.4% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="newPostsChart"></canvas>
                        </div>
                    </div>

                    <div class="stat-card info fade-in" style="animation-delay: 0.4s;">
                        <div class="stat-card-header">
                            <div class="stat-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="stat-actions">
                                <button class="stat-action-btn">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-value">234</div>
                            <div class="stat-title">پست‌های خالی</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>2.3% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="outOfStockPostsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Post Import/Export -->
                <div class="product-import-export fade-in" style="animation-delay: 0.5s;">
                    <button class="import-export-btn" id="importPostsBtn">
                        <i class="fas fa-file-import"></i>
                        <span>وارد کردن پست‌ها از فایل</span>
                    </button>
                    <button class="import-export-btn" id="exportPostsBtn2">
                        <i class="fas fa-file-export"></i>
                        <span>خروجی گرفتن از پست‌ها</span>
                    </button>
                    <button class="import-export-btn" id="sendEmailBtn">
                        <i class="fas fa-envelope"></i>
                        <span>ارسال ایمیل گروهی</span>
                    </button>
                </div>

                <!-- Advanced Filters -->
                <div class="product-filters-advanced fade-in" id="productFilters" style="display: none; animation-delay: 0.6s;">
                    <div class="filter-group">
                        <label>دسته‌بندی:</label>
                        <select class="filter-select" id="categoryFilter">
                            <option value="">همه دسته‌بندی‌ها</option>
                            <option value="news">اخبار</option>
                            <option value="blog">بلاگ</option>
                            <option value="announcements">اعلامیه</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>وضعیت:</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">همه وضعیت‌ها</option>
                            <option value="active">فعال</option>
                            <option value="inactive">غیرفعال</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>تاریخ ثبت از:</label>
                        <input type="date" class="filter-input" id="dateFromFilter">
                    </div>
                    <div class="filter-group">
                        <label>تا:</label>
                        <input type="date" class="filter-input" id="dateToFilter">
                    </div>
                    <div class="filter-actions">
                        <button class="filter-btn filter-btn-apply" id="applyProductFilters">اعمال فیلترها</button>
                        <button class="filter-btn filter-btn-reset" id="resetProductFilters">بازنشانی</button>
                    </div>
                </div>

                <!-- Posts Table -->
                <div class="table-card fade-in" style="animation-delay: 0.7s;">
                    <div class="table-card-header">
                        <div class="table-title-section">
                            <h3 class="table-title">لیست پست‌ها</h3>
                            <p class="table-subtitle">مدیریت پست‌های ثبت‌شده در سیستم</p>
                        </div>
                        <div class="table-actions">
                            <button class="table-action-btn" id="filterProductsBtn">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button class="table-action-btn" id="exportProductsBtn3">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="table-action-btn" id="refreshProductsBtn">
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
                                    <th>عنوان پست</th>
                                    <th>دسته‌بندی</th>
                                    <th>نویسنده</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    <th>آخرین به‌روزرسانی</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                <?php
                                global $pdo;
                                $query = 'SELECT posts.*, posts_categories.name AS category_name, CONCAT(users.first_name, " ", users.last_name) AS author_name FROM posts  JOIN posts_categories ON posts.category_id = posts_categories.id JOIN users ON posts.user_id = users.id';
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($posts as $post):
                                ?>
                                    <tr>
                                        <td><input type="checkbox" class="table-checkbox" data-id="<?= $post['id'] ?>"></td>
                                        <td><?= htmlspecialchars($post['title']) ?></td>
                                        <td><?= htmlspecialchars($post['category_name']) ?></td>
                                        <td><?= htmlspecialchars($post['author_name']) ?></td>
                                        <td>
                                            <span class="status <?= $post['status'] === 'active' ? 'active' : 'inactive' ?>">
                                                <?= $post['status'] === 'active' ? 'فعال' : 'غیرفعال' ?>
                                            </span>
                                        </td>
                                        <td><?= date('Y-m-d', strtotime($post['created_at'])) ?></td>
                                        <td><?= date('Y-m-d', strtotime($post['updated_at'])) ?></td>
                                        <td>
                                            <button class="btn btn-outline view-btn" data-id="<?= $post['id'] ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline edit-btn" data-id="<?= $post['id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline delete-btn" data-id="<?= $post['id'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-outline more-btn" data-id="<?= $post['id'] ?>">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Post Detail Modal -->
    <div class="modal" id="postDetailModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="postDetailTitle">جزئیات پست</h3>
                <button class="modal-close" id="closePostDetailModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="postDetailContent">
                    <!-- Post details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closePostDetailModalBtn">
                    <i class="fas fa-times"></i>
                    <span>بستن</span>
                </button>
                <button class="btn btn-primary" id="editPostBtn">
                    <i class="fas fa-edit"></i>
                    <span>ویرایش پست</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Add/Edit Post Modal -->
    <div class="modal" id="addEditPostModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addEditPostModalTitle">افزودن پست جدید</h3>
                <button class="modal-close" id="closeAddEditPostModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="postForm" method="post" action="">
                    <input type="hidden" name="action" id="formAction" value="create_post">
                    <input type="hidden" name="post_id" id="postIdInput" value="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="postTitle">عنوان پست</label>
                            <input type="text" id="postTitle" name="title" class="form-input" placeholder="عنوان پست" required>
                        </div>
                        <div class="form-group">
                            <label for="postCategory">دسته‌بندی</label>
                            <select id="postCategory" name="category" class="form-input" required>
                                <option value="">انتخاب دسته‌بندی</option>
                                <option value="news">اخبار</option>
                                <option value="blog">بلاگ</option>
                                <option value="announcements">اعلامیه</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="postAuthor">نویسنده</label>
                            <input type="text" id="postAuthor" name="author" class="form-input" placeholder="نویسنده" required>
                        </div>
                        <div class="form-group">
                            <label for="postStatus">وضعیت</label>
                            <select id="postStatus" name="status" class="form-input" required>
                                <option value="active">فعال</option>
                                <option value="inactive">غیرفعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postContent">محتوا</label>
                        <textarea id="postContent" name="content" class="form-input" rows="4" placeholder="محتوا پست" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeAddEditPostModalBtn">
                    <i class="fas fa-times"></i>
                    <span>انصراف</span>
                </button>
                <button class="btn btn-primary" id="savePostBtn" type="submit" form="postForm">
                    <i class="fas fa-save"></i>
                    <span>ذخیره پست</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Post Modal -->
    <div class="modal" id="deletePostModal">
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">حذف پست</h3>
                    <button class="modal-close" id="closeDeletePostModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></意图
                                <h4>آیا از حذف این پست اطمینان دارید؟</h4>
                            <p>با حذف این پست، تمام اطلاعات مربوط به او از سیستم حذف خواهد شد. این عملیات غیرقابل بازگشت است.</p>
                    </div>
                </div>
                <form id="deletePostForm" method="post" action="">
                    <input type="hidden" name="action" value="delete_post">
                    <input type="hidden" name="post_id" id="deletePostId" value="">
                    <div class="form-group">
                        <label>دلیل حذف (اختیاری)</label>
                        <textarea id="deleteReason" name="delete_reason" class="form-input" rows="3" placeholder="دلیل حذف پست را وارد کنید"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeDeletePostModalBtn">
                    <i class="fas fa-times"></i>
                    <span>انصراف</span>
                </button>
                <button class="btn btn-danger" id="confirmDeletePostBtn" type="submit" form="deletePostForm">
                    <i class="fas fa-trash"></i>
                    <span>حذف پست</span>
                </button>
            </div>
        </div>
    </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Scripts -->
    <script src="<?= asset('assets/admin/script/posts.js') ?>"></script>
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