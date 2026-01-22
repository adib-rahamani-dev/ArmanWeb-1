<?php
session_start(); // اولین خط فایل
require '../helper/data-base.php';
require '../helper/helper-functions.php';

// لیست متغیرهای سشن که می‌خواهیم چاپ کنیم
$session_keys = [
    'username' => 'نام کاربری',
    'user_id' => 'شناسه کاربر',
    'email' => 'ایمیل',
    'first_name' => 'نام',
    'last_name' => 'نام خانوادگی',
    'role' => 'نقش'
];

if (isset($_SESSION['username'])) {
    foreach ($session_keys as $key => $label) {
        if (isset($_SESSION[$key])) {
            echo "$label: " . htmlspecialchars($_SESSION[$key]) . "<br>";
        } else {
            echo "$label: نامشخص<br>";
        }
    }
} else {
    echo "هیچ داده‌ای در سشن ذخیره نشده است.";
}
?>
