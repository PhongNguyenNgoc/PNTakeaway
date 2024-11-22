<?php
include('./admin/conn/constants.php');

if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    // Truy vấn kiểm tra token trong cơ sở dữ liệu
    $sql = "SELECT TENNGUOIDUNG , QUYEN FROM tai_khoan WHERE token = '$token'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        // Đăng nhập tự động
        $_SESSION['token'] = $token;
        $_SESSION['user_id'] = $row['TENNGUOIDUNG'];
        $_SESSION['role'] = $row['QUYEN'];

        //Dang nhap tu dong thanh cong!
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/2109c0989e.js" crossorigin="anonymous"></script>
    <title>Phong Nguyễn Takeaway</title>
</head>

<body>
    <!--Thanh dieu huong-->
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDark" aria-controls="navbarDark" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse hide" id="navbarDark">
                <ul class="navbar-nav me-auto mb-2 mb-xl-0 fs-5 ms-auto p-2 text-center">
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="mon-an.php">Món ăn</a>
                    </li>

                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">Giỏ hàng</a>
                    </li>




                    <?php
                    if (isset($_SESSION['user_id'])) {
                    ?> <li class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo  $_SESSION['user_id']; ?>
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-center" href="cap-nhat-tai-khoan.php" style="color:white;">Cập Nhật Tài Khoản</a></li>
                                <li><a class="dropdown-item text-center" href="doi-mat-khau.php" style="color:white;">Đổi mật khẩu</a></li>
                                <li><a class="dropdown-item text-center" href="#" style="color:white;">Quản Lý Đơn Hàng</a></li>

                                <li>
                                    <hr class="dropdown-divider" style="color:white;">
                                </li>
                                <li><a class="dropdown-item text-center" href="dang-xuat.php" style="color:white;">Đăng xuất</a></li>
                            </ul>
                        </li><?php

                            } else {
                                ?><li class="nav-item me-3"></li>
                        <a class="nav-link" href="./dang-nhap.php">Đăng nhập</a>
                        </li><?php
                            }
                                ?>



                    <!---->




                </ul>
                <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form> -->
            </div>

        </div>
    </nav>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>