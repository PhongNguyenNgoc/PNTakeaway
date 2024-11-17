<?php

include('./conn/constants.php');
if (isset($_SESSION['user_id'])) {
    // Xóa token khỏi cơ sở dữ liệu
    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE tai_khoan SET token = NULL WHERE TENNGUOIDUNG = '$user_id'";
    mysqli_query($conn, $sql);

    // Xóa session
    session_unset();
    session_destroy();

    // Xóa cookie "remember_token"
    setcookie("remember_token", "", time() - 3600, "/");  // Hủy cookie


    header("location:" . SITEURL . 'dang-nhap.php');
}
