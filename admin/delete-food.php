<?php
//0. include contrain.php
include("./conn/constants.php");
//1. Lay id admin de xoa

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //Xoa anh trong source
    if ($image_name != "") {
        $path = "../img/food/" . $image_name;
        $remove = unlink($path);
    }
    // 2.1 truy van sql de xoa

    $sql = "DELETE FROM mon_an WHERE ID_MONAN='$id'";

    //2.2  thuc thi lanh sql de xoa
    $res = mysqli_query($conn, $sql);

    // Kiem tra sql co thuc thi dc?
    if ($res == true) {
        //tao secssion de thong bao
        $_SESSION['deleteF'] = "<div class='success'>Đã xóa món thành công!</div>";
        //Chuyen huong trang
        header('location:' . SITEURL . 'admin/food.php');
    } else {
        //echo "Xoa that bai";
        $_SESSION['deleteF'] = "<div class='error'>Lỗi khi xóa món<div>";
        //Chuyen huong trang
        header('location:' . SITEURL . 'admin/food.php');
    }
}
