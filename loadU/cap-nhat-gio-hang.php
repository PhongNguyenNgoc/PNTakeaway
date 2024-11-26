<?php
include '/xampp/htdocs/PNTakeaway/admin/conn/constants.php';


if (isset($_POST['soluong'])) {
    $ten_nguoidung = $_SESSION['user_id'];

    // Duyệt qua tất cả các món ăn trong giỏ hàng và cập nhật số lượng
    foreach ($_POST['soluong'] as $id_mon_an => $soluong) {
        // Kiểm tra và đảm bảo số lượng hợp lệ (tối thiểu là 1)
        if ($soluong < 1) {
            // Nếu số lượng = 0, xóa món ăn khỏi giỏ hàng
            $sql_delete = "DELETE FROM GIO_HANG WHERE TENNGUOIDUNG = '$ten_nguoidung' AND ID_MONAN = $id_mon_an";
            mysqli_query($conn, $sql_delete);
        } else {
            // Cập nhật số lượng món ăn trong giỏ hàng
            $sql_update = "UPDATE GIO_HANG SET SOLUONG = $soluong WHERE TENNGUOIDUNG = '$ten_nguoidung' AND ID_MONAN = $id_mon_an";
            mysqli_query($conn, $sql_update);
        }
    }

    // Quay lại trang giỏ hàng sau khi cập nhật
    header("Location:" . SITEURL . "gio-hang.php");
}
