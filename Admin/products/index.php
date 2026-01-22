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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> -->
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
                        <span class="breadcrumb-item active">محصولات</span>
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
                        <h1 class="welcome-title">مدیریت محصولات</h1>
                        <p class="welcome-subtitle">در این بخش می‌توانید محصولات سیستم را مدیریت کنید</p>
                    </div>
                    <div class="welcome-actions">
                        <button class="btn btn-primary" id="addNewProductBtn">
                            <i class="fas fa-plus"></i>
                            <span>افزودن محصول جدید</span>
                        </button>
                        <button class="btn btn-outline" id="exportProductsBtn">
                            <i class="fas fa-download"></i>
                            <span>خروجی اکسل</span>
                        </button>
                    </div>
                </div>

                <!-- Product Stats -->
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
                            <div class="stat-title">کل محصولات</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>12.5% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="productsChart"></canvas>
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
                            <div class="stat-title">محصولات فعال</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>8.3% نسبت به ماه 身</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="activeProductsChart"></canvas>
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
                            <div class="stat-title">محصولات جدید (ماه)</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-down"></i>
                                <span>5.4% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="newProductsChart"></canvas>
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
                            <div class="stat-title">محصولات خالی</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>2.3% نسبت به ماه گذشته</span>
                            </div>
                        </div>
                        <div class="stat-chart">
                            <canvas id="outOfStockChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Product Import/Export -->
                <div class="product-import-export fade-in" style="animation-delay: 0.5s;">
                    <button class="import-export-btn" id="importProductsBtn">
                        <i class="fas fa-file-import"></i>
                        <span>وارد کردن محصولات از فایل</span>
                    </button>
                    <button class="import-export-btn" id="exportProductsBtn2">
                        <i class="fas fa-file-export"></i>
                        <span>خروجی گرفتن از محصولات</span>
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
                            <option value="electronics">الکترونیک</option>
                            <option value="clothing">لباس</option>
                            <option value="home">خانه</option>
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

                <!-- Products Table -->
                <div class="table-card fade-in" style="animation-delay: 0.7s;">
                    <div class="table-card-header">
                        <div class="table-title-section">
                            <h3 class="table-title">لیست محصولات</h3>
                            <p class="table-subtitle">مدیریت محصولات ثبت‌شده در سیستم</p>
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
                                    <th>نام محصول</th>
                                    <th>دسته‌بندی</th>
                                    <th>قیمت</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    <th>آخرین به‌روزرسانی</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                <?php
                                global $pdo;
                                $query = 'SELECT * FROM `products`';
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($products as $product):
                                ?>
                                    <tr>
                                        <td><input type="checkbox" class="table-checkbox" data-id="<?= $product['id'] ?>"></td>
                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                        <td><?= htmlspecialchars($product['category']) ?></td>
                                        <td><?= number_format($product['price'], 0, ',', '.') ?> تومان</td>
                                        <td>
                                            <span class="status <?= $product['status'] === 'active' ? 'active' : 'inactive' ?>">
                                                <?= $product['status'] === 'active' ? 'فعال' : 'غیرفعال' ?>
                                            </span>
                                        </td>
                                        <td><?= date('Y-m-d', strtotime($product['created_at'])) ?></td>
                                        <td><?= date('Y-m-d', strtotime($product['updated_at'])) ?></td>
                                        <td>
                                            <button class="btn btn-outline view-btn" data-id="<?= $product['id'] ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline edit-btn" data-id="<?= $product['id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline delete-btn" data-id="<?= $product['id'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-outline more-btn" data-id="<?= $product['id'] ?>">
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
    <!-- Product Detail Modal -->
    <div class="modal" id="productDetailModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="productDetailTitle">جزئیات محصول</h3>
                <button class="modal-close" id="closeProductDetailModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="productDetailContent">
                    <!-- Product details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeProductDetailModalBtn">
                    <i class="fas fa-times"></i>
                    <span>بستن</span>
                </button>
                <button class="btn btn-primary" id="editProductBtn">
                    <i class="fas fa-edit"></i>
                    <span>ویرایش محصول</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Add/Edit Product Modal -->
    <div class="modal" id="addEditProductModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addEditProductModalTitle">افزودن محصول جدید</h3>
                <button class="modal-close" id="closeAddEditProductModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm" method="post" action="">
                    <input type="hidden" name="action" id="formAction" value="create_product">
                    <input type="hidden" name="product_id" id="productIdInput" value="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="productName">نام محصول</label>
                            <input type="text" id="productName" name="name" class="form-input" placeholder="نام محصول" required>
                        </div>
                        <div class="form-group">
                            <label for="productCategory">دسته‌بندی</label>
                            <select id="productCategory" name="category" class="form-input" required>
                                <option value="">انتخاب دسته‌بندی</option>
                                <option value="electronics">الکترونیک</option>
                                <option value="clothing">لباس</option>
                                <option value="home">خانه</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="productPrice">قیمت</label>
                            <input type="number" id="productPrice" name="price" class="form-input" placeholder="قیمت محصول" required>
                        </div>
                        <div class="form-group">
                            <label for="productStatus">وضعیت</label>
                            <select id="productStatus" name="status" class="form-input" required>
                                <option value="active">فعال</option>
                                <option value="inactive">غیرفعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">توضیحات</label>
                        <textarea id="productDescription" name="description" class="form-input" rows="4" placeholder="توضیحات محصول"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeAddEditProductModalBtn">
                    <i class="fas fa-times"></i>
                    <span>انصراف</span>
                </button>
                <button class="btn btn-primary" id="saveProductBtn" type="submit" form="productForm">
                    <i class="fas fa-save"></i>
                    <span>ذخیره محصول</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal" id="deleteProductModal">
        <div class="modal-overlay">
            </意图
                <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">حذف محصول</h3>
                <button class="modal-close" id="closeDeleteProductModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <h4>آیا از حذف این محصول اطمینان دارید؟</h4>
                        <p>با حذف این محصول، تمام اطلاعات مربوط به او از سیستم حذف خواهد شد. این عملیات غیرقابل بازگشت است.</p>
                    </div>
                </div>
                <form id="deleteProductForm" method="post" action="">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" name="product_id" id="deleteProductId" value="">
                    <div class="form-group">
                        <label>دلیل حذف (اختیاری)</label>
                        <textarea id="deleteReason" name="delete_reason" class="form-input" rows="3" placeholder="دلیل حذف محصول را وارد کنید"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeDeleteProductModalBtn">
                    <i class="fas fa-times"></i>
                    <span>انصراف</span>
                </button>
                <button class="btn btn-danger" id="confirmDeleteProductBtn" type="submit" form="deleteProductForm">
                    <i class="fas fa-trash"></i>
                    <span>حذف محصول</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Scripts -->
    <script src="<?= asset('assets/admin/script/products.js') ?>"></script>
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