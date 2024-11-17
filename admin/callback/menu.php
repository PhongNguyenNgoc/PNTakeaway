<?php include("/xampp/htdocs/PNTakeaway/admin/conn/constants.php");
include("/xampp/htdocs/PNTakeaway/admin/callback/chk-permission.php") ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://kit.fontawesome.com/2109c0989e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style-admin.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li>
                    <a href="">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li>
                    <a href="account.php">
                        <i class="fa-solid fa-user"></i>
                        <span>Tài khoản</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa-solid fa-quote-left"></i>
                        <span>Loại thức ăn</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa-solid fa-bowl-food"></i>
                        <span>Thức ăn</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="">
                        <i class="fa-brands fa-first-order-alt"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="./logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>