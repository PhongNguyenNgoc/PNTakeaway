<?php
include '/xampp/htdocs/PNTakeaway/admin/conn/constants.php';





// Kiểm tra nếu có id món ăn
if (isset($_GET['id_mon_an'])) {
    $id_mon_an = $_GET['id_mon_an'];
    $ten_nguoidung = $_SESSION['user_id'];

    // Xóa món ăn khỏi giỏ hàng trong cơ sở dữ liệu
    $sql_delete = "DELETE FROM GIO_HANG WHERE TENNGUOIDUNG = '$ten_nguoidung' AND ID_MONAN = $id_mon_an";
    mysqli_query($conn, $sql_delete);

    // Quay lại trang giỏ hàng sau khi xóa
    header("Location:" . SITEURL . "gio-hang.php");
}
