// script.js
// Debug: confirm script load
console.log('[products.js] loaded');

// Helper to safely attach event listeners
function on(el, ev, fn) { 
    if (el && typeof el.addEventListener === 'function') 
        el.addEventListener(ev, fn);
}

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

// Product Modals
const productDetailModal = document.getElementById('productDetailModal');
const closeProductDetailModal = document.getElementById('closeProductDetailModal');
const closeProductDetailModalBtn = document.getElementById('closeProductDetailModalBtn');
const addEditProductModal = document.getElementById('addEditProductModal');
const closeAddEditProductModal = document.getElementById('closeAddEditProductModal');
const closeAddEditProductModalBtn = document.getElementById('closeAddEditProductModalBtn');
const deleteProductModal = document.getElementById('deleteProductModal');
const closeDeleteProductModal = document.getElementById('closeDeleteProductModal');
const closeDeleteProductModalBtn = document.getElementById('closeDeleteProductModalBtn');

// Product Buttons
const addNewProductBtn = document.getElementById('addNewProductBtn');
const addProductBtn = document.getElementById('addProductBtn');
const editProductBtn = document.getElementById('editProductBtn');
const saveProductBtn = document.getElementById('saveProductBtn');
const confirmDeleteProductBtn = document.getElementById('confirmDeleteProductBtn');
const productStatusToggle = document.getElementById('productStatusToggle');

// Table Actions
const filterProductsBtn = document.getElementById('filterProductsBtn');
const productFilters = document.getElementById('productFilters');
const exportProductsBtn = document.getElementById('exportProductsBtn');
const refreshProductsBtn = document.getElementById('refreshProductsBtn');
const resetFilters = document.getElementById('resetFilters');

// Charts
let activeProductsChart, newProductsChart, inactiveProductsChart;

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    console.log('[products.js] DOMContentLoaded fired, loadingScreen:', loadingScreen);
    // Hide loading screen (if exists)
    setTimeout(() => {
        try {
            if (loadingScreen && loadingScreen.classList) loadingScreen.classList.add('hidden');
        } catch (e) {
            console.error('[products.js] error hiding loadingScreen', e);
        }
    }, 1000);

    // Check Chart.js presence
    if (typeof Chart === 'undefined') {
        console.error('[products.js] Chart.js is not loaded (Chart is undefined)');
    } else {
        console.log('[products.js] Chart.js detected, initializing charts');
    }

    // Initialize charts with safety
    try {
        initializeCharts();
    } catch (e) {
        console.error('[products.js] initializeCharts threw:', e);
    }

    // Show welcome toast
    setTimeout(() => {
        try { showToast('success', 'به صفحه مدیریت محصولات خوش آمدید!'); } catch (e) { console.error('[products.js] showToast error', e); }
    }, 1500);
});

// Sidebar Toggle
on(toggleSidebar, 'click', () => {
    try { sidebar.classList.toggle('collapsed'); } catch(e){}
    try { mainContent.classList.toggle('expanded'); } catch(e){}
    // Resize charts after sidebar toggle
    setTimeout(() => { try { resizeAllCharts(); } catch(e) { console.error('[products.js] resizeAllCharts error', e); } }, 300);
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
    } catch (e) { console.error('[products.js] themeToggle handler error', e); }
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
    } catch (e) { console.error('[products.js] fullscreenToggle error', e); }
});

// Notification Dropdown
on(notificationBtn, 'click', (e) => {
    try {
        e.stopPropagation();
        const menu = document.getElementById('notificationMenu');
        if (menu) menu.classList.toggle('show');
        const userMenu = document.getElementById('userMenu'); if (userMenu) userMenu.classList.remove('show');
    } catch (err) { console.error('[products.js] notificationBtn handler', err); }
});

// User Dropdown
on(userProfileBtn, 'click', (e) => {
    try {
        e.stopPropagation();
        const menu = document.getElementById('userMenu'); if (menu) menu.classList.toggle('show');
        const notif = document.getElementById('notificationMenu'); if (notif) notif.classList.remove('show');
    } catch (err) { console.error('[products.js] userProfileBtn handler', err); }
});

// Close dropdowns when clicking outside
document.addEventListener('click', () => {
    document.querySelectorAll('.notification-dropdown-menu, .user-dropdown-menu').forEach(menu => {
        menu.classList.remove('show');
    });
});

// Product Modals
on(addNewProductBtn, 'click', () => {
    try {
        document.getElementById('addEditProductModalTitle').textContent = 'افزودن محصول جدید';
        document.getElementById('productForm').reset();
        document.getElementById('formAction').value = 'create_product';
        document.getElementById('productIdInput').value = '';
        addEditProductModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    } catch (e) { console.error('[products.js] addNewProductBtn handler', e); }
});

on(addProductBtn, 'click', () => {
    try {
        document.getElementById('addEditProductModalTitle').textContent = 'افزودن محصول جدید';
        document.getElementById('productForm').reset();
        addEditProductModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    } catch (e) { console.error('[products.js] addProductBtn handler', e); }
});

on(closeProductDetailModal, 'click', () => { try { productDetailModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
on(closeProductDetailModalBtn, 'click', () => { try { productDetailModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
on(closeAddEditProductModal, 'click', () => { try { addEditProductModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
on(closeAddEditProductModalBtn, 'click', () => { try { addEditProductModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
on(closeDeleteProductModal, 'click', () => { try { deleteProductModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });
on(closeDeleteProductModalBtn, 'click', () => { try { deleteProductModal.classList.remove('show'); document.body.style.overflow = 'auto'; } catch(e){} });

// Close modals when clicking outside
productDetailModal.addEventListener('click', (e) => {
    if (e.target === productDetailModal || e.target.classList.contains('modal-overlay')) {
        productDetailModal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
});

addEditProductModal.addEventListener('click', (e) => {
    if (e.target === addEditProductModal || e.target.classList.contains('modal-overlay')) {
        addEditProductModal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
});

deleteProductModal.addEventListener('click', (e) => {
    if (e.target === deleteProductModal || e.target.classList.contains('modal-overlay')) {
        deleteProductModal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
});

// Product Status Toggle
productStatusToggle.addEventListener('click', () => {
    productStatusToggle.classList.toggle('active');
    const isActive = productStatusToggle.classList.contains('active');
    const statusBadge = document.getElementById('modalProductStatus');
    
    if (isActive) {
        statusBadge.className = 'status-badge success';
        statusBadge.textContent = 'فعال';
        showToast('success', 'وضعیت محصول به فعال تغییر یافت');
    } else {
        statusBadge.className = 'status-badge danger';
        statusBadge.textContent = 'غیرفعال';
        showToast('warning', 'وضعیت محصول به غیرفعال تغییر یافت');
    }
});

// Table Actions
filterProductsBtn.addEventListener('click', () => {
    productFilters.style.display = productFilters.style.display === 'none' ? 'grid' : 'none';
});

exportProductsBtn.addEventListener('click', () => {
    showToast('success', 'در حال آماده‌سازی فایل اکسل...');
    setTimeout(() => {
        showToast('success', 'فایل با موفقیت دانلود شد');
    }, 2000);
});

refreshProductsBtn.addEventListener('click', () => {
    const icon = refreshProductsBtn.querySelector('i');
    icon.style.animation = 'spin 1s linear';
    
    setTimeout(() => {
        icon.style.animation = '';
        showToast('success', 'جدول با موفقیت به‌روزرسانی شد');
    }, 1000);
});

resetFilters.addEventListener('click', () => {
    document.getElementById('categoryFilter').value = '';
    document.getElementById('statusFilter').value = '';
    showToast('info', 'فیلترها بازنشانی شد');
});

// Table Action Buttons
document.querySelectorAll('.action-btn.view').forEach(btn => {
    btn.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        // Load product data based on productId
        productDetailModal.classList.add('show');
        document.body.style.overflow = 'hidden';
        showToast('info', 'در حال بارگذاری اطلاعات محصول...');
    });
});

document.querySelectorAll('.action-btn.edit').forEach(btn => {
    btn.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        // Load product data based on productId
        document.getElementById('addEditProductModalTitle').textContent = 'ویرایش محصول';
        showToast('info', 'در حال بارگذاری اطلاعات محصول...');
        fetch(`index.php?action=get_product&id=${encodeURIComponent(productId)}`)
            .then(res => res.json())
            .then(data => {
                if (data.success && data.product) {
                    const p = data.product;
                    document.getElementById('productName').value = p.name || '';
                    document.getElementById('productCategory').value = p.category || '';
                    document.getElementById('productPrice').value = p.price || '';
                    document.getElementById('productStatus').value = p.status || '';
                    document.getElementById('productDescription').value = p.description || '';
                    document.getElementById('formAction').value = 'edit_product';
                    document.getElementById('productIdInput').value = p.id || '';
                    // Clear password input for security
                    addEditProductModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                } else {
                    showToast('error', data.message || 'خطا در بارگذاری محصول');
                }
            }).catch(err => {
                console.error(err);
                showToast('error', 'خطا در دریافت اطلاعات محصول');
            });
    });
});

document.querySelectorAll('.action-btn.delete').forEach(btn => {
    on(btn, 'click', function() {
        try {
            const productId = this.getAttribute('data-product-id');
            const deleteIdInput = document.getElementById('deleteProductId');
            const deleteReason = document.getElementById('deleteReason');
            if (deleteIdInput) deleteIdInput.value = productId || '';
            if (deleteReason) deleteReason.value = '';
            deleteProductModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        } catch (e) { console.error('[products.js] delete button handler', e); }
    });
});

// Submit handler for product form
const productForm = document.getElementById('productForm');
if (productForm) {
    productForm.addEventListener('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            showToast('error', 'لطفا تمام فیلدهای الزامی را پر کنید');
            this.reportValidity();
            return;
        }

        // Show saving toast and disable submit to prevent double submit
        showToast('info', 'در حال ذخیره‌سازی محصول...');
        saveProductBtn.disabled = true;
        // allow default submission to proceed
    });
}

// Confirm Delete Product
// Handle delete form submission
const deleteProductForm = document.getElementById('deleteProductForm');
if (deleteProductForm) {
    deleteProductForm.addEventListener('submit', function(e) {
        // Allow native POST submission, but show a toast and disable button to prevent double submit
        try {
            showToast('info', 'در حال حذف محصول...');
            confirmDeleteProductBtn.disabled = true;
        } catch (err) { console.error('[products.js] deleteUserForm submit handler', err); }
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
    // Active Products Chart
    const activeProductsCtx = document.getElementById('activeProductsChart');
    if (activeProductsCtx) {
        activeProductsChart = new Chart(activeProductsCtx, {
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
    
    // New Products Chart
    const newProductsCtx = document.getElementById('newProductsChart');
    if (newProductsCtx) {
        newProductsChart = new Chart(newProductsCtx, {
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
    
    // Inactive Products Chart
    const inactiveProductsCtx = document.getElementById('inactiveProductsChart');
    if (inactiveProductsCtx) {
        inactiveProductsChart = new Chart(inactiveProductsCtx, {
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
    
    [activeProductsChart, newProductsChart, inactiveProductsChart].forEach(chart => {
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
    [activeProductsChart, newProductsChart, inactiveProductsChart].forEach(chart => {
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
