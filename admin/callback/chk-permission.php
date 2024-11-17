<?php
// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    // Kiểm tra quyền truy cập
    if ($_SESSION['role'] != 1) {

        header("location:" . SITEURL . 'dang-nhap.php');
    }
} else {

    header("location:" . SITEURL . 'dang-nhap.php');
}
