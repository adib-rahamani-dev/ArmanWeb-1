        // Debug: confirm script load
        console.log('[users.js] loaded');
        // Capture uncaught errors to help debugging
        window.addEventListener('error', function(e) {
            console.error('[users.js] uncaught error', e.error || e.message, e);
        });

        // Helper to safely attach event listeners
        function on(el, ev, fn) { if (el && typeof el.addEventListener === 'function') el.addEventListener(ev, fn); }

        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const themeToggle = document.getElementById('themeToggle');
        const fullscreenToggle = document.getElementById('fullscreenToggle');
        const quickActionsBtn = document.getElementById('quickActionsBtn');
        const notificationBtn = document.getElementById('notificationBtn');
        const userProfileBtn = document.getElementById('userProfileBtn');
        const loadingScreen = document.getElementById('loadingScreen');
        const toastContainer = document.getElementById('toastContainer');
        const globalSearch = document.getElementById('globalSearch');
        const sidebarSearch = document.getElementById('sidebarSearch');

        // Menu Toggles
        const usersMenuToggle = document.getElementById('usersMenuToggle');
        const usersSubmenu = document.getElementById('usersSubmenu');
        const productsMenuToggle = document.getElementById('productsMenuToggle');
        const productsSubmenu = document.getElementById('productsSubmenu');
        const blogMenuToggle = document.getElementById('blogMenuToggle');
        const blogSubmenu = document.getElementById('blogSubmenu');

        // User Modals
        const userDetailModal = document.getElementById('userDetailModal');
        const closeUserDetailModal = document.getElementById('closeUserDetailModal');
        const closeUserDetailModalBtn = document.getElementById('closeUserDetailModalBtn');
        const addEditUserModal = document.getElementById('addEditUserModal');
        const closeAddEditUserModal = document.getElementById('closeAddEditUserModal');
        const closeAddEditUserModalBtn = document.getElementById('closeAddEditUserModalBtn');
        const deleteUserModal = document.getElementById('deleteUserModal');
        const closeDeleteUserModal = document.getElementById('closeDeleteUserModal');
        const closeDeleteUserModalBtn = document.getElementById('closeDeleteUserModalBtn');

        // User Buttons
        const addNewUserBtn = document.getElementById('addNewUserBtn');
        const addUserBtn = document.getElementById('addUserBtn');
        const editUserBtn = document.getElementById('editUserBtn');
        const saveUserBtn = document.getElementById('saveUserBtn');
        const confirmDeleteUserBtn = document.getElementById('confirmDeleteUserBtn');
        const userStatusToggle = document.getElementById('userStatusToggle');

        // Table Actions
        const filterUsersBtn = document.getElementById('filterUsersBtn');
        const userFilters = document.getElementById('userFilters');
        const exportUsersBtn = document.getElementById('exportUsersBtn');
        const exportUsersBtn2 = document.getElementById('exportUsersBtn2');
        const exportUsersBtn3 = document.getElementById('exportUsersBtn3');
        const refreshUsersBtn = document.getElementById('refreshUsersBtn');
        const importUsersBtn = document.getElementById('importUsersBtn');
        const sendEmailBtn = document.getElementById('sendEmailBtn');
        const applyFilters = document.getElementById('applyFilters');
        const resetFilters = document.getElementById('resetFilters');

        // Charts
        let usersChart, activeUsersChart, newUsersChart, blockedUsersChart;

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            console.log('[users.js] DOMContentLoaded fired, loadingScreen:', loadingScreen);
            // Hide loading screen (if exists)
            setTimeout(() => {
                try {
                    if (loadingScreen && loadingScreen.classList) loadingScreen.classList.add('hidden');
                } catch (e) {
                    console.error('[users.js] error hiding loadingScreen', e);
                }
            }, 1000);

            // Check Chart.js presence
            if (typeof Chart === 'undefined') {
                console.error('[users.js] Chart.js is not loaded (Chart is undefined)');
            } else {
                console.log('[users.js] Chart.js detected, initializing charts');
            }

            // Initialize charts with safety
            try {
                initializeCharts();
            } catch (e) {
                console.error('[users.js] initializeCharts threw:', e);
            }

            // Show welcome toast
            setTimeout(() => {
                try { showToast('success', 'به صفحه مدیریت کاربران خوش آمدید!'); } catch (e) { console.error('[users.js] showToast error', e); }
            }, 1500);
        });

        // Sidebar Toggle
        on(toggleSidebar, 'click', () => {
            try { sidebar.classList.toggle('collapsed'); } catch(e){}
            try { mainContent.classList.toggle('expanded'); } catch(e){}
            // Resize charts after sidebar toggle
            setTimeout(() => { try { resizeAllCharts(); } catch(e) { console.error('[users.js] resizeAllCharts error', e); } }, 300);
        });

        // Mobile Menu Toggle
        on(mobileMenuBtn, 'click', () => { try { sidebar.classList.toggle('show'); } catch(e){} });

        // Theme Toggle
        on(themeToggle, 'click', () => {
            try {
                document.body.classList.toggle('light-theme');
                const icon = themeToggle.querySelector('i');
                const isLight = document.body.classList.contains('light-theme');
                if (isLight) {
                    icon.classList.remove('fa-moon'); icon.classList.add('fa-sun'); showToast('info', 'حالت روز فعال شد');
                } else {
                    icon.classList.remove('fa-sun'); icon.classList.add('fa-moon'); showToast('info', 'حالت شب فعال شد');
                }
                updateChartsTheme();
            } catch (e) { console.error('[users.js] themeToggle handler error', e); }
        });

        // Fullscreen Toggle
        on(fullscreenToggle, 'click', () => {
            try {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                    fullscreenToggle.querySelector('i').classList.replace('fa-expand', 'fa-compress');
                    showToast('info', 'حالت تمام صفحه فعال شد');
                } else {
                    document.exitFullscreen();
                    fullscreenToggle.querySelector('i').classList.replace('fa-compress', 'fa-expand');
                    showToast('info', 'حالت تمام صفحه غیرفعال شد');
                }
            } catch (e) { console.error('[users.js] fullscreenToggle error', e); }
        });

        // Notification Dropdown
        on(notificationBtn, 'click', (e) => {
            try {
                e.stopPropagation();
                const menu = document.getElementById('notificationMenu');
                if (menu) menu.classList.toggle('show');
                const userMenu = document.getElementById('userMenu'); if (userMenu) userMenu.classList.remove('show');
            } catch (err) { console.error('[users.js] notificationBtn handler', err); }
        });

        // User Dropdown
        on(userProfileBtn, 'click', (e) => {
            try {
                e.stopPropagation();
                const menu = document.getElementById('userMenu'); if (menu) menu.classList.toggle('show');
                const notif = document.getElementById('notificationMenu'); if (notif) notif.classList.remove('show');
            } catch (err) { console.error('[users.js] userProfileBtn handler', err); }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.notification-dropdown-menu, .user-dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });

        // Submenu Toggles
        on(usersMenuToggle, 'click', (e) => { e && e.preventDefault(); toggleSubmenu(usersSubmenu, usersMenuToggle); });

        on(productsMenuToggle, 'click', (e) => { e && e.preventDefault(); toggleSubmenu(productsSubmenu, productsMenuToggle); });

        on(blogMenuToggle, 'click', (e) => { e && e.preventDefault(); toggleSubmenu(blogSubmenu, blogMenuToggle); });

        function toggleSubmenu(submenu, toggle) {
            submenu.classList.toggle('open');
            const chevron = toggle.querySelector('.chevron');
            if (submenu.classList.contains('open')) {
                chevron.style.transform = 'rotate(-180deg)';
            } else {
                chevron.style.transform = 'rotate(0)';
            }
        }

        // User Modals
        on(addNewUserBtn, 'click', () => {
            try {
                document.getElementById('addEditUserModalTitle').textContent = 'افزودن کاربر جدید';
                document.getElementById('userForm').reset();
                document.getElementById('formAction').value = 'create_user';
                document.getElementById('userIdInput').value = '';
                addEditUserModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            } catch (e) { console.error('[users.js] addNewUserBtn handler', e); }
        });

        on(addUserBtn, 'click', () => {
            try {
                document.getElementById('addEditUserModalTitle').textContent = 'افزودن کاربر جدید';
                document.getElementById('userForm').reset();
                addEditUserModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            } catch (e) { console.error('[users.js] addUserBtn handler', e); }
        });

        on(closeUserDetailModal, 'click', () => { try { userDetailModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
        on(closeUserDetailModalBtn, 'click', () => { try { userDetailModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
        on(closeAddEditUserModal, 'click', () => { try { addEditUserModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
        on(closeAddEditUserModalBtn, 'click', () => { try { addEditUserModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
        on(closeDeleteUserModal, 'click', () => { try { deleteUserModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
        on(closeDeleteUserModalBtn, 'click', () => { try { deleteUserModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });

        // Close modals when clicking outside
        userDetailModal.addEventListener('click', (e) => {
            if (e.target === userDetailModal || e.target.classList.contains('modal-overlay')) {
                userDetailModal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        });

        addEditUserModal.addEventListener('click', (e) => {
            if (e.target === addEditUserModal || e.target.classList.contains('modal-overlay')) {
                addEditUserModal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        });

        deleteUserModal.addEventListener('click', (e) => {
            if (e.target === deleteUserModal || e.target.classList.contains('modal-overlay')) {
                deleteUserModal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        });

        // User Status Toggle
        userStatusToggle.addEventListener('click', () => {
            userStatusToggle.classList.toggle('active');
            const isActive = userStatusToggle.classList.contains('active');
            const statusBadge = document.getElementById('modalUserStatus');
            
            if (isActive) {
                statusBadge.className = 'status-badge success';
                statusBadge.textContent = 'فعال';
                showToast('success', 'وضعیت کاربر به فعال تغییر یافت');
            } else {
                statusBadge.className = 'status-badge danger';
                statusBadge.textContent = 'مسدود';
                showToast('warning', 'وضعیت کاربر به مسدود تغییر یافت');
            }
        });

        // Table Actions
        filterUsersBtn.addEventListener('click', () => {
            userFilters.style.display = userFilters.style.display === 'none' ? 'grid' : 'none';
        });

        exportUsersBtn.addEventListener('click', () => {
            showToast('success', 'در حال آماده‌سازی فایل اکسل...');
            setTimeout(() => {
                showToast('success', 'فایل با موفقیت دانلود شد');
            }, 2000);
        });

        exportUsersBtn2.addEventListener('click', () => {
            showToast('success', 'در حال آماده‌سازی فایل اکسل...');
            setTimeout(() => {
                showToast('success', 'فایل با موفقیت دانلود شد');
            }, 2000);
        });

        exportUsersBtn3.addEventListener('click', () => {
            showToast('success', 'در حال آماده‌سازی فایل اکسل...');
            setTimeout(() => {
                showToast('success', 'فایل با موفقیت دانلود شد');
            }, 2000);
        });

        refreshUsersBtn.addEventListener('click', () => {
            const icon = refreshUsersBtn.querySelector('i');
            icon.style.animation = 'spin 1s linear';
            
            setTimeout(() => {
                icon.style.animation = '';
                showToast('success', 'جدول با موفقیت به‌روزرسانی شد');
            }, 1000);
        });

        importUsersBtn.addEventListener('click', () => {
            showToast('info', 'در حال باز کردن صفحه وارد کردن کاربران...');
        });

        sendEmailBtn.addEventListener('click', () => {
            showToast('info', 'در حال باز کردن صفحه ارسال ایمیل گروهی...');
        });

        applyFilters.addEventListener('click', () => {
            showToast('success', 'فیلترها با موفقیت اعمال شد');
            userFilters.style.display = 'none';
        });

        resetFilters.addEventListener('click', () => {
            document.getElementById('roleFilter').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('dateFromFilter').value = '';
            document.getElementById('dateToFilter').value = '';
            showToast('info', 'فیلترها بازنشانی شد');
        });

        // Table Action Buttons
        document.querySelectorAll('.action-btn.view').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                // Load user data based on userId
                userDetailModal.classList.add('show');
                document.body.style.overflow = 'hidden';
                showToast('info', 'در حال بارگذاری اطلاعات کاربر...');
            });
        });

        document.querySelectorAll('.action-btn.edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                // Load user data based on userId
                document.getElementById('addEditUserModalTitle').textContent = 'ویرایش کاربر';
                showToast('info', 'در حال بارگذاری اطلاعات کاربر...');
                fetch(`index.php?action=get_user&id=${encodeURIComponent(userId)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.user) {
                            const u = data.user;
                            document.getElementById('userFirstName').value = u.first_name || '';
                            document.getElementById('userLastName').value = u.last_name || '';
                            document.getElementById('userEmail').value = u.email || '';
                            document.getElementById('userPhone').value = u.phone || '';
                            document.getElementById('userUsername').value = u.username || '';
                            document.getElementById('userRole').value = u.role || '';
                            document.getElementById('userStatus').value = u.status || '';
                            document.getElementById('userBio').value = u.bio || '';
                            document.getElementById('formAction').value = 'edit_user';
                            document.getElementById('userIdInput').value = u.id || '';
                            // Clear password input for security
                            document.getElementById('userPassword').value = '';
                            addEditUserModal.classList.add('show');
                            document.body.style.overflow = 'hidden';
                        } else {
                            showToast('error', data.message || 'خطا در بارگذاری کاربر');
                        }
                    }).catch(err => {
                        console.error(err);
                        showToast('error', 'خطا در دریافت اطلاعات کاربر');
                    });
            });
        });

        document.querySelectorAll('.action-btn.delete').forEach(btn => {
            on(btn, 'click', function() {
                try {
                    const userId = this.getAttribute('data-user-id');
                    const deleteIdInput = document.getElementById('deleteUserId');
                    const deleteReason = document.getElementById('deleteReason');
                    if (deleteIdInput) deleteIdInput.value = userId || '';
                    if (deleteReason) deleteReason.value = '';
                    deleteUserModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                } catch (e) { console.error('[users.js] delete button handler', e); }
            });
        });

        document.querySelectorAll('.action-btn.more').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                showToast('info', 'در حال باز کردن منوی بیشتر...');
            });
        });

        // Submit handler for user form
        const userForm = document.getElementById('userForm');
        if (userForm) {
            userForm.addEventListener('submit', function(e) {
                if (!this.checkValidity()) {
                    e.preventDefault();
                    showToast('error', 'لطفا تمام فیلدهای الزامی را پر کنید');
                    this.reportValidity();
                    return;
                }

                // Show saving toast and disable submit to prevent double submit
                showToast('info', 'در حال ذخیره‌سازی کاربر...');
                saveUserBtn.disabled = true;
                // allow default submission to proceed
            });
        }

        // Confirm Delete User
        // Handle delete form submission
        const deleteUserForm = document.getElementById('deleteUserForm');
        if (deleteUserForm) {
            deleteUserForm.addEventListener('submit', function(e) {
                // Allow native POST submission, but show a toast and disable button to prevent double submit
                try {
                    showToast('info', 'در حال حذف کاربر...');
                    confirmDeleteUserBtn.disabled = true;
                } catch (err) { console.error('[users.js] deleteUserForm submit handler', err); }
                // allow form to submit normally
            });
        }

        // Search Functionality
        globalSearch.addEventListener('focus', () => {
            showToast('info', 'برای جستجوی سریع، Ctrl+K را فشار دهید');
        });

        sidebarSearch.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Keyboard Shortcuts
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K for global search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                globalSearch.focus();
            }
            
            // Escape to close modals
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal.show').forEach(modal => {
                    modal.classList.remove('show');
                });
                document.body.style.overflow = 'auto';
            }
            
            // Ctrl/Cmd + B to toggle sidebar
            if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                e.preventDefault();
                toggleSidebar.click();
            }
        });

        // Initialize Charts
        function initializeCharts() {
            // Users Chart
            const usersCtx = document.getElementById('usersChart');
            if (usersCtx) {
                usersChart = new Chart(usersCtx, {
                    type: 'line',
                    data: {
                        labels: ['', '', '', '', '', '', ''],
                        datasets: [{
                            data: [30, 45, 35, 50, 40, 60, 55],
                            borderColor: '#6366f1',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: false,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        },
                        scales: {
                            x: { display: false },
                            y: { display: false }
                        }
                    }
                });
            }
            
            // Active Users Chart
            const activeUsersCtx = document.getElementById('activeUsersChart');
            if (activeUsersCtx) {
                activeUsersChart = new Chart(activeUsersCtx, {
                    type: 'bar',
                    data: {
                        labels: ['', '', '', '', '', '', ''],
                        datasets: [{
                            data: [40, 35, 50, 45, 60, 55, 70],
                            backgroundColor: '#10b981'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        },
                        scales: {
                            x: { display: false },
                            y: { display: false }
                        }
                    }
                });
            }
            
            // New Users Chart
            const newUsersCtx = document.getElementById('newUsersChart');
            if (newUsersCtx) {
                newUsersChart = new Chart(newUsersCtx, {
                    type: 'line',
                    data: {
                        labels: ['', '', '', '', '', '', ''],
                        datasets: [{
                            data: [20, 35, 25, 40, 30, 45, 35],
                            borderColor: '#f59e0b',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: false,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        },
                        scales: {
                            x: { display: false },
                            y: { display: false }
                        }
                    }
                });
            }
            
            // Blocked Users Chart
            const blockedUsersCtx = document.getElementById('blockedUsersChart');
            if (blockedUsersCtx) {
                blockedUsersChart = new Chart(blockedUsersCtx, {
                    type: 'line',
                    data: {
                        labels: ['', '', '', '', '', '', ''],
                        datasets: [{
                            data: [60, 65, 55, 70, 68, 75, 68],
                            borderColor: '#3b82f6',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: false,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        },
                        scales: {
                            x: { display: false },
                            y: { display: false }
                        }
                    }
                });
            }
        }

        // Update Charts Theme
        function updateChartsTheme() {
            const isLight = document.body.classList.contains('light-theme');
            const textColor = isLight ? '#0f172a' : '#f1f5f9';
            const gridColor = isLight ? 'rgba(148, 163, 184, 0.2)' : 'rgba(148, 163, 184, 0.1)';
            
            [usersChart, activeUsersChart, newUsersChart, blockedUsersChart].forEach(chart => {
                if (chart) {
                    chart.options.plugins.legend.labels.color = textColor;
                    chart.options.scales.x.ticks.color = textColor;
                    chart.options.scales.y.ticks.color = textColor;
                    chart.options.scales.x.grid.color = gridColor;
                    chart.options.scales.y.grid.color = gridColor;
                    chart.update();
                }
            });
        }

        // Resize All Charts
        function resizeAllCharts() {
            [usersChart, activeUsersChart, newUsersChart, blockedUsersChart].forEach(chart => {
                if (chart) {
                    chart.resize();
                }
            });
        }

        // Toast Notification
        function showToast(type, message, duration = 5000) {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            
            let icon = '';
            switch(type) {
                case 'success':
                    icon = 'fa-check-circle';
                    break;
                case 'error':
                    icon = 'fa-exclamation-circle';
                    break;
                case 'warning':
                    icon = 'fa-exclamation-triangle';
                    break;
                case 'info':
                    icon = 'fa-info-circle';
                    break;
            }
            
            toast.innerHTML = `
                <i class="fas ${icon} toast-icon"></i>
                <div class="toast-message">${message}</div>
                <button class="toast-close">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            toastContainer.appendChild(toast);
            
            // Show toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            });
            
            // Auto close
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, duration);
        }

        // Table Checkbox Select All
        document.querySelector('.table-checkbox-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.table-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Server-side flash messages are handled in the page HTML; removed PHP from this static JS file to avoid syntax errors.

        // Add CSS for form elements
        const formStyles = document.createElement('style');
        formStyles.textContent = `
            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-bottom: 16px;
            }
            
            .form-group {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }
            
            .form-group label {
                font-size: 14px;
                font-weight: 500;
                color: var(--dark-text);
            }
            
            .form-input {
                padding: 10px 12px;
                background: var(--dark-surface);
                border: 1px solid var(--dark-border);
                border-radius: 6px;
                color: var(--dark-text);
                font-size: 14px;
                transition: all var(--transition-speed);
            }
            
            .form-input:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            }
            
            .checkbox-group {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }
            
            .checkbox-label {
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
                font-size: 14px;
                color: var(--dark-text);
            }
            
            .checkbox-label input[type="checkbox"] {
                display: none;
            }
            
            .checkbox-custom {
                width: 18px;
                height: 18px;
                border: 1px solid var(--dark-border);
                border-radius: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all var(--transition-speed);
            }
            
            .checkbox-label input[type="checkbox"]:checked + .checkbox-custom {
                background: var(--primary-color);
                border-color: var(--primary-color);
            }
            
            .checkbox-label input[type="checkbox"]:checked + .checkbox-custom::after {
                content: "\\f00c";
                font-family: "Font Awesome 6 Free";
                font-weight: 900;
                color: white;
                font-size: 10px;
            }
            
            .alert {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                padding: 16px;
                border-radius: var(--border-radius);
                margin-bottom: 16px;
            }
            
            .alert-warning {
                background: rgba(245, 158, 11, 0.1);
                border: 1px solid rgba(245, 158, 11, 0.3);
                color: var(--warning-color);
            }
            
            .alert h4 {
                margin-bottom: 8px;
                font-size: 16px;
                font-weight: 600;
            }
            
            .alert p {
                font-size: 14px;
                line-height: 1.5;
            }
            
            .modal-footer {
                padding: 16px 24px;
                border-top: 1px solid var(--dark-border);
                display: flex;
                justify-content: flex-end;
                gap: 12px;
            }
            
            .btn-danger {
                background: var(--danger-color);
                color: white;
            }
            
            .btn-danger:hover {
                background: var(--danger-dark);
            }
            
            @media (max-width: 768px) {
                .form-row {
                    grid-template-columns: 1fr;
                }
            }
        `;
        document.head.appendChild(formStyles);

        // Performance: Debounce resize events
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                resizeAllCharts();
            }, 250);
        });