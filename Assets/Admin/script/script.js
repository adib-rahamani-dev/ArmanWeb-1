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
const quickActionsModal = document.getElementById('quickActionsModal');
const closeQuickActionsModal = document.getElementById('closeQuickActionsModal');
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

// Table Actions
const filterOrdersBtn = document.getElementById('filterOrdersBtn');
const ordersFilters = document.getElementById('ordersFilters');
const exportOrdersBtn = document.getElementById('exportOrdersBtn');
const refreshOrdersBtn = document.getElementById('refreshOrdersBtn');

// Charts
let salesAnalysisChart, topProductsChart;
let usersChart, revenueChart, ordersChart, conversionChart;

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    // Hide loading screen
    setTimeout(() => {
        loadingScreen.classList.add('hidden');
    }, 1000);
    
    // Initialize charts
    initializeCharts();
    
    // Initialize tooltips
    initializeTooltips();
    
    // Show welcome toast
    setTimeout(() => {
        showToast('success', 'به پنل مدیریت آرمان رجایی خوش آمدید!');
    }, 1500);
});

// Sidebar Toggle
toggleSidebar.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
    
    // Resize charts after sidebar toggle
    setTimeout(() => {
        resizeAllCharts();
    }, 300);
});

// Mobile Menu Toggle
mobileMenuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('show');
});

// Theme Toggle
themeToggle.addEventListener('click', () => {
    document.body.classList.toggle('light-theme');
    const icon = themeToggle.querySelector('i');
    const isLight = document.body.classList.contains('light-theme');
    
    if (isLight) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
        showToast('info', 'حالت روز فعال شد');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
        showToast('info', 'حالت شب فعال شد');
    }
    
    // Update charts for theme change
    updateChartsTheme();
});

// Fullscreen Toggle
fullscreenToggle.addEventListener('click', () => {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
        fullscreenToggle.querySelector('i').classList.replace('fa-expand', 'fa-compress');
        showToast('info', 'حالت تمام صفحه فعال شد');
    } else {
        document.exitFullscreen();
        fullscreenToggle.querySelector('i').classList.replace('fa-compress', 'fa-expand');
        showToast('info', 'حالت تمام صفحه غیرفعال شد');
    }
});

// Quick Actions Modal
quickActionsBtn.addEventListener('click', () => {
    quickActionsModal.classList.add('show');
    document.body.style.overflow = 'hidden';
});

closeQuickActionsModal.addEventListener('click', () => {
    quickActionsModal.classList.remove('show');
    document.body.style.overflow = 'auto';
});

quickActionsModal.addEventListener('click', (e) => {
    if (e.target === quickActionsModal || e.target.classList.contains('modal-overlay')) {
        quickActionsModal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
});

// Notification Dropdown
notificationBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const menu = document.getElementById('notificationMenu');
    menu.classList.toggle('show');
    
    // Close other dropdowns
    document.getElementById('userMenu').classList.remove('show');
});

// User Dropdown
userProfileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('show');
    
    // Close other dropdowns
    document.getElementById('notificationMenu').classList.remove('show');
});

// Close dropdowns when clicking outside
document.addEventListener('click', () => {
    document.querySelectorAll('.notification-dropdown-menu, .user-dropdown-menu').forEach(menu => {
        menu.classList.remove('show');
    });
});

// Submenu Toggles
usersMenuToggle.addEventListener('click', (e) => {
    e.preventDefault();
    toggleSubmenu(usersSubmenu, usersMenuToggle);
});

productsMenuToggle.addEventListener('click', (e) => {
    e.preventDefault();
    toggleSubmenu(productsSubmenu, productsMenuToggle);
});

blogMenuToggle.addEventListener('click', (e) => {
    e.preventDefault();
    toggleSubmenu(blogSubmenu, blogMenuToggle);
});

function toggleSubmenu(submenu, toggle) {
    submenu.classList.toggle('open');
    const chevron = toggle.querySelector('.chevron');
    if (submenu.classList.contains('open')) {
        chevron.style.transform = 'rotate(-180deg)';
    } else {
        chevron.style.transform = 'rotate(0)';
    }
}

// Table Filters
filterOrdersBtn.addEventListener('click', () => {
    ordersFilters.style.display = ordersFilters.style.display === 'none' ? 'flex' : 'none';
});

exportOrdersBtn.addEventListener('click', () => {
    showToast('success', 'در حال آماده‌سازی فایل اکسل...');
    setTimeout(() => {
        showToast('success', 'فایل با موفقیت دانلود شد');
    }, 2000);
});

refreshOrdersBtn.addEventListener('click', () => {
    const icon = refreshOrdersBtn.querySelector('i');
    icon.style.animation = 'spin 1s linear';
    
    setTimeout(() => {
        icon.style.animation = '';
        showToast('success', 'جدول با موفقیت به‌روزرسانی شد');
    }, 1000);
});

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
    // Mini Charts for Stats Cards
    initializeMiniCharts();
    
    // Sales Analysis Chart
    const salesCtx = document.getElementById('salesAnalysisChart');
    if (salesCtx) {
        salesAnalysisChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'],
                datasets: [{
                    label: 'فروش',
                    data: [45000000, 52000000, 48000000, 61000000, 58000000, 72000000],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#6366f1',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }, {
                    label: 'سفارشات',
                    data: [320, 380, 350, 420, 400, 480],
                    borderColor: '#f43f5e',
                    backgroundColor: 'rgba(244, 63, 94, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#f43f5e',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#f1f5f9',
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        padding: 12,
                        displayColors: true,
                        borderColor: '#334155',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.datasetIndex === 0) {
                                    label += new Intl.NumberFormat('fa-IR').format(context.parsed.y) + ' تومان';
                                } else {
                                    label += context.parsed.y + ' سفارش';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            callback: function(value) {
                                return new Intl.NumberFormat('fa-IR').format(value);
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: {
                            drawOnChartArea: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    }
    
    // Top Products Chart
    const topProductsCtx = document.getElementById('topProductsChart');
    if (topProductsCtx) {
        topProductsChart = new Chart(topProductsCtx, {
            type: 'bar',
            data: {
                labels: ['پلن حرفه‌ای', 'پلن پیشرفته', 'پلن استاندارد', 'پلن اقتصادی', 'پلن ویژه'],
                datasets: [{
                    label: 'فروش',
                    data: [125, 98, 87, 65, 43],
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(244, 63, 94, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(59, 130, 246, 0.8)'
                    ],
                    borderColor: [
                        '#6366f1',
                        '#f43f5e',
                        '#10b981',
                        '#f59e0b',
                        '#3b82f6'
                    ],
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        padding: 12,
                        displayColors: false,
                        borderColor: '#334155',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' فروش';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    }
    
    // Period tabs functionality
    document.querySelectorAll('.period-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.period-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            const period = this.dataset.period;
            updateSalesChart(period);
        });
    });
}

// Initialize Mini Charts
function initializeMiniCharts() {
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
    
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        revenueChart = new Chart(revenueCtx, {
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
    
    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart');
    if (ordersCtx) {
        ordersChart = new Chart(ordersCtx, {
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
    
    // Conversion Chart
    const conversionCtx = document.getElementById('conversionChart');
    if (conversionCtx) {
        conversionChart = new Chart(conversionCtx, {
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

// Update Sales Chart based on period
function updateSalesChart(period) {
    let labels, data1, data2;
    
    switch(period) {
        case 'week':
            labels = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه'];
            data1 = [12000000, 15000000, 13000000, 18000000, 16000000, 20000000, 19000000];
            data2 = [45, 52, 48, 65, 58, 72, 68];
            break;
        case 'month':
            labels = ['هفته 1', 'هفته 2', 'هفته 3', 'هفته 4'];
            data1 = [85000000, 92000000, 78000000, 105000000];
            data2 = [320, 380, 350, 420];
            break;
        case 'year':
            labels = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'];
            data1 = [45000000, 52000000, 48000000, 61000000, 58000000, 72000000];
            data2 = [320, 380, 350, 420, 400, 480];
            break;
    }
    
    if (salesAnalysisChart) {
        salesAnalysisChart.data.labels = labels;
        salesAnalysisChart.data.datasets[0].data = data1;
        salesAnalysisChart.data.datasets[1].data = data2;
        salesAnalysisChart.update();
    }
}

// Update Charts Theme
function updateChartsTheme() {
    const isLight = document.body.classList.contains('light-theme');
    const textColor = isLight ? '#0f172a' : '#f1f5f9';
    const gridColor = isLight ? 'rgba(148, 163, 184, 0.2)' : 'rgba(148, 163, 184, 0.1)';
    
    [salesAnalysisChart, topProductsChart, usersChart, revenueChart, ordersChart, conversionChart].forEach(chart => {
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
    [salesAnalysisChart, topProductsChart, usersChart, revenueChart, ordersChart, conversionChart].forEach(chart => {
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

// Initialize Tooltips
function initializeTooltips() {
    const tooltipElements = document.querySelectorAll('[title]');
    
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', (e) => {
            const title = e.target.getAttribute('title');
            e.target.removeAttribute('title');
            
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = title;
            document.body.appendChild(tooltip);
            
            const rect = e.target.getBoundingClientRect();
            tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            
            e.target.setAttribute('data-tooltip', title);
        });
        
        element.addEventListener('mouseleave', (e) => {
            const tooltip = document.querySelector('.tooltip');
            if (tooltip) {
                tooltip.remove();
            }
            
            const title = e.target.getAttribute('data-tooltip');
            if (title) {
                e.target.setAttribute('title', title);
                e.target.removeAttribute('data-tooltip');
            }
        });
    });
}

// Add New Button
document.getElementById('addNewBtn')?.addEventListener('click', () => {
    showToast('info', 'در حال توسعه...');
});

// Quick Action Buttons
document.querySelectorAll('.quick-action-btn, .quick-action-modal-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const text = this.querySelector('span').textContent;
        showToast('info', `در حال باز کردن ${text}...`);
    });
});

// Table Action Buttons
document.querySelectorAll('.action-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const action = this.classList.contains('view') ? 'مشاهده' : 
                      this.classList.contains('edit') ? 'ویرایش' : 'بیشتر';
        showToast('info', `در حال ${action} آیتم...`);
    });
});

// Calendar Day Click
document.querySelectorAll('.calendar-day:not(.empty)').forEach(day => {
    day.addEventListener('click', function() {
        document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
        this.classList.add('selected');
        showToast('info', `تاریخ انتخاب شده: ${this.textContent}`);
    });
});

// Notification Item Actions
document.querySelectorAll('.notification-close').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const item = this.closest('.notification-item');
        item.style.transform = 'translateX(100%)';
        item.style.opacity = '0';
        setTimeout(() => {
            item.remove();
        }, 300);
    });
});

// Mark All as Read
document.querySelector('.mark-all-read')?.addEventListener('click', () => {
    document.querySelectorAll('.notification-item.unread').forEach(item => {
        item.classList.remove('unread');
    });
    showToast('success', 'همه اعلان‌ها به عنوان خوانده شده علامت‌گذاری شدند');
});

// View All Notifications
document.querySelector('.view-all-notifications')?.addEventListener('click', () => {
    showToast('info', 'در حال باز کردن صفحه اعلان‌ها...');
});

// Dropdown Items
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const text = this.textContent.trim();
        showToast('info', `در حال باز کردن ${text}...`);
    });
});

// Table Checkbox Select All
document.querySelector('.table-checkbox-all')?.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.table-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Performance: Debounce resize events
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        resizeAllCharts();
    }, 250);
});

// Performance: Lazy load images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add ripple effect to buttons
document.querySelectorAll('.btn, .icon-btn, .action-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .tooltip {
        position: absolute;
        background: rgba(15, 23, 42, 0.9);
        color: #f1f5f9;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
        z-index: 10000;
        pointer-events: none;
        animation: tooltip-fade-in 0.2s ease;
    }
    
    @keyframes tooltip-fade-in {
        from {
            opacity: 0;
            transform: translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .calendar-day.selected {
        background: var(--primary-color);
        color: white;
        font-weight: 600;
    }
`;
document.head.appendChild(style);