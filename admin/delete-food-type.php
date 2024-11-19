<?php
//0. include contrain.php
include("./conn/constants.php");
//1. Lay id admin de xoa
$id = $_GET['id'];
//2.1 truy van sql de xoa

$sql = "DELETE FROM loai_mon_an WHERE ID_LOAIMONAN='$id'";

//2.2  thuc thi lanh sql de xoa
$res = mysqli_query($conn, $sql);

// Kiem tra sql co thuc thi dc?
if ($res == true) {
    //tao secssion de thong bao
    $_SESSION['deleteFT'] = "<div class='success'>Đã xóa loại món thành công!</div>";
    //Chuyen huong trang
    header('location:' . SITEURL . 'admin/food-type.php');
} else {
    //echo "Xoa that bai";
    $_SESSION['deleteFT'] = "<div class='error'>Lỗi khi xóa loại món<div>";
    //Chuyen huong trang
    header('location:' . SITEURL . 'admin/food-type.php');
}
