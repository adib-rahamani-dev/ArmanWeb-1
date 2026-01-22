        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <span class="logo-text">آرمان رجایی</span>
                </div>
                <button class="toggle-btn" id="toggleSidebar" aria-label="تغییر وضعیت منو">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="sidebar-search">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="جستجو در منو..." id="sidebarSearch">
                </div>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-section">
                    <div class="menu-title">اصلی</div>
                    <div class="menu-item">
                        <a href="<?= url('admin') ?>" class="menu-link <?= preg_match('#/(?:arman/)?admin(?:/index\.php)?/?$#', strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) ? 'active' : '' ?>" data-page="dashboard">
                            <i class="fas fa-home menu-icon"></i>
                            <span class="menu-text">داشبورد</span>
                            <span class="menu-badge">جدید</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" data-page="analytics">
                            <i class="fas fa-chart-line menu-icon"></i>
                            <span class="menu-text">تحلیل‌ها</span>
                        </a>
                    </div>
                </div>

                <div class="menu-section">
                    <div class="menu-title">مدیریت</div>
                    <div class="menu-item">
                        <a href="<?= url('admin/users') ?>" class="menu-link <?= strpos(strtolower($_SERVER['REQUEST_URI']), '/admin/users') !== false ? 'active' : '' ?>" id="usersMenuToggle">
                            <i class="fas fa-users menu-icon"></i>
                            <span class="menu-text">کاربران</span>
                            <span class="menu-badge pulse">127</span>
                            <i class="fas fa-chevron-down menu-icon chevron"></i>
                        </a>
                        <div class="submenu" id="usersSubmenu">
                            <a href="<?= url('admin/users') ?>" class="menu-link <?= strpos(strtolower($_SERVER['REQUEST_URI']), '/admin/users') !== false ? 'active' : '' ?>">
                                <i class="fas fa-user-friends menu-icon"></i>
                                <span class="menu-text">همه کاربران</span>
                            </a>
                            <a href="#" class="menu-link">
                                <i class="fas fa-user-plus menu-icon"></i>
                                <span class="menu-text">افزودن کاربر</span>
                            </a>
                            <a href="#" class="menu-link">
                                <i class="fas fa-user-shield menu-icon"></i>
                                <span class="menu-text">نقش‌ها</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" id="productsMenuToggle">
                            <i class="fas fa-box menu-icon"></i>
                            <span class="menu-text">محصولات</span>
                            <span class="menu-badge">456</span>
                            <i class="fas fa-chevron-down menu-icon chevron"></i>
                        </a>
                        <div class="submenu" id="productsSubmenu">
                            <a href="#" class="menu-link">
                                <i class="fas fa-th-large menu-icon"></i>
                                <span class="menu-text">همه محصولات</span>
                            </a>
                            <a href="#" class="menu-link">
                                <i class="fas fa-plus-circle menu-icon"></i>
                                <span class="menu-text">افزودن محصول</span>
                            </a>
                            <a href="#" class="menu-link">
                                <i class="fas fa-tags menu-icon"></i>
                                <span class="menu-text">دسته‌بندی‌ها</span>
                            </a>
                            <a href="#" class="menu-link">
                                <i class="fas fa-warehouse menu-icon"></i>
                                <span class="menu-text">موجودی</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" data-page="orders">
                            <i class="fas fa-shopping-cart menu-icon"></i>
                            <span class="menu-text">سفارشات</span>
                            <span class="menu-badge pulse">89</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" data-page="finance">
                            <i class="fas fa-wallet menu-icon"></i>
                            <span class="menu-text">مالی</span>
                        </a>
                    </div>
                </div>

                <div class="menu-section">
                    <div class="menu-title">محتوا</div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" id="blogMenuToggle">
                            <i class="fas fa-blog menu-icon"></i>
                            <span class="menu-text">وبلاگ</span>
                            <i class="fas fa-chevron-down menu-icon chevron"></i>
                        </a>
                        <div class="submenu" id="blogSubmenu">
                            <a href="#" class="menu-link">
                                <i class="fas fa-newspaper menu-icon"></i>
                                <span class="menu-text">همه مقالات</span>
                            </a>
                            <a href="#" class="menu-link">
                                <i class="fas fa-pen menu-icon"></i>
                                <span class="menu-text">نوشتن مقاله</span>
                            </a>
                            <a href="#" class="menu-link">
                                <i class="fas fa-folder menu-icon"></i>
                                <span class="menu-text">دسته‌بندی‌ها</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" data-page="media">
                            <i class="fas fa-photo-video menu-icon"></i>
                            <span class="menu-text">رسانه</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" data-page="comments">
                            <i class="fas fa-comments menu-icon"></i>
                            <span class="menu-text">نظرات</span>
                            <span class="menu-badge pulse">23</span>
                        </a>
                    </div>
                </div>

                <div class="menu-section">
                    <div class="menu-title">ابزارها</div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" data-page="reports">
                            <i class="fas fa-file-alt menu-icon"></i>
                            <span class="menu-text">گزارش‌ها</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" data-page="settings">
                            <i class="fas fa-cog menu-icon"></i>
                            <span class="menu-text">تنظیمات</span>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="user-card">
                    <img src="" alt="کاربر" class="user-avatar">
                    <div class="user-info">
                        <div class="user-name">آرمان رجایی</div>
                        <div class="user-role">مدیر ارشد</div>
                    </div>
                    <button class="user-menu-btn">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
        </aside>