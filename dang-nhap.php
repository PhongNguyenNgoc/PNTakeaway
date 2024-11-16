<?php
include('./admin/conn/constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style-login.css">
    <title>Đăng nhập</title>
</head>

<body>

    <div class="container-fluid">
        <form class="mx-auto">
            <h4 class="text-center">Đăng nhập</h4>

            <p class="text-center" style="color: green;"><?php if (isset($_SESSION["ChgPassS"])) {
                                                                echo $_SESSION["ChgPassS"];
                                                                unset($_SESSION["ChgPassS"]);
                                                            } ?></p>
            <p class="text-center" style="color: green;"><?php if (isset($_SESSION["addUS"])) {
                                                                echo $_SESSION["addUS"];
                                                                unset($_SESSION["addUS"]);
                                                            } ?></p>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="exampleInputEmail1">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1">

                <a href="quen-mat-khau.php">
                    <div id="emailHelp" class="form-text mt-3">Quên mật khẩu</div>
                </a>
                <br>
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="RememberMe">
                <label class="form-check-label" for="exampleCheck1">Nhớ đăng nhập</label>
                <br><br>
                <div>Chưa có tài khoản? <a href="./tao-tai-khoan.php">Tạo tài khoản mới</a></div>
            </div>

            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
</body>

</html>