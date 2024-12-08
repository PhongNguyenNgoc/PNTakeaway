<?php
include '/xampp/htdocs/PNTakeaway/admin/conn/constants.php';


// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("location:" . SITEURL . "/dang-nhap.php"); // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    exit();
}





$ten_nguoidung = $_SESSION['user_id']; // Lấy tên người dùng từ session
$totalO = $_SESSION["tp"];
$payM =  $_SESSION['pay'];


//Tạo đơn hàng mới
$date = date('Y-m-d');
$sql_order = "INSERT INTO DON_HANG (TENNGUOIDUNG, NGAYDATHANG, TRANGTHAI,THANHTOAN,TONGGTDONHANG) 
              VALUES ('$ten_nguoidung', '$date', 0,'$payM',$totalO)";
mysqli_query($conn, $sql_order);
// Lấy ID đơn hàng mới vừa tạo
$order_id = mysqli_insert_id($conn);

//Thêm các món ăn vào bảng chi tiết đơn hàng
$sql_cart = "SELECT ID_MONAN, SOLUONG FROM GIO_HANG WHERE TENNGUOIDUNG = '$ten_nguoidung'";
$res_cart = mysqli_query($conn, $sql_cart);

while ($item = mysqli_fetch_assoc($res_cart)) {
    $id_mon_an = $item['ID_MONAN'];
    $soluong = $item['SOLUONG'];

    // Thêm chi tiết đơn hàng
    $sql_order_detail = "INSERT INTO CHI_TIET_DON_HANG (ID_DONDAT, ID_MONAN, SOLUONG)
                         VALUES ($order_id, $id_mon_an, $soluong)";
    mysqli_query($conn, $sql_order_detail);
}
// Xóa giỏ hàng sau khi thanh toán
$sql_delete_cart = "DELETE FROM GIO_HANG WHERE TENNGUOIDUNG = '$ten_nguoidung'";
mysqli_query($conn, $sql_delete_cart);



echo ("<script LANGUAGE='JavaScript'>
    window.alert('Đã đặt món thành công, chúng tôi sẽ sớm liên hệ với bạn để xác nhận đơn hàng');
    window.location.href='" . SITEURL . "/mon-an.php" . "';
    </script>");
