<?php

include '/xampp/htdocs/PNTakeaway/admin/conn/constants.php'; // Kết nối cơ sở dữ liệu


if (isset($_GET['idMon'])) {
    $id_mon_an = $_GET['idMon'];
    $ten_nguoi_dung = $_SESSION['user_id'];

    // Kiểm tra món ăn đã có trong giỏ hàng chưa
    $sql_check = "SELECT * FROM GIO_HANG WHERE TENNGUOIDUNG = '$ten_nguoi_dung' AND ID_MONAN = $id_mon_an";
    $res_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($res_check) > 0) {
        // Món ăn đã có trong giỏ hàng, tăng số lượng lên 1
        $sql_update = "UPDATE GIO_HANG SET SOLUONG = SOLUONG + 1 WHERE TENNGUOIDUNG = '$ten_nguoi_dung' AND ID_MONAN = $id_mon_an";
        mysqli_query($conn, $sql_update);
    } else {
        // Món ăn chưa có trong giỏ hàng, thêm mới
        $sql_add = "INSERT INTO GIO_HANG (TENNGUOIDUNG, ID_MONAN, SOLUONG) VALUES ('$ten_nguoi_dung', $id_mon_an, 1)";
        mysqli_query($conn, $sql_add);
    }
}

// Kiểm tra nếu có ID_MONAN được gửi lên
