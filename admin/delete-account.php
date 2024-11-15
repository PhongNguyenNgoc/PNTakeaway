<?php
//0. include contrain.php
include("./conn/constants.php");
//1. Lay id admin de xoa
$id = $_GET['id'];
//2.1 truy van sql de xoa

$sql = "DELETE FROM tai_khoan WHERE ID_TK=$id";

//2.2  thuc thi lanh sql de xoa
$res = mysqli_query($conn, $sql);

// Kiem tra sql co thuc thi dc?
if ($res == true) {
    //tao secssion de thong bao
    $_SESSION['delete'] = "<div class='success'>Đã xóa tài khoản thành công!</div>";
    //Chuyen huong trang
    header('location:' . SITEURL . 'admin/account.php');
} else {
    //echo "Xoa that bai";
    $_SESSION['delete'] = "<div class='error'>Lỗi khi xóa tài khoản<div>";
    //Chuyen huong trang
    header('location:' . SITEURL . 'admin/account.php');
}
