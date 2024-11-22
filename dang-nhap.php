<?php
include('./admin/conn/constants.php');

if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['UserName']);
    $password = md5($_POST['PassWord']);
    $rememberMe = isset($_POST['RememberMe']);



    $sql = "SELECT MATKHAU, QUYEN FROM tai_khoan WHERE TENNGUOIDUNG = '$username'";
    $res = mysqli_query($conn, $sql);


    if (mysqli_num_rows($res) == 1) {
        $rows = mysqli_fetch_assoc($res);

        if ($password == $rows['MATKHAU']) {
            $token = bin2hex(random_bytes(32));

            $sql_update_token = "UPDATE tai_khoan SET TOKEN = '$token' WHERE TENNGUOIDUNG = '$username'";

            if (mysqli_query($conn, $sql_update_token)) {
                $_SESSION['token'] = $token;
                $_SESSION['user_id'] = $username;
                $_SESSION['role'] = $rows['QUYEN'];

                if ($rememberMe) {
                    setcookie("remember_token", $token, time() + (60 * 60 * 24 * 30), "/"); //Het han sau 30d
                }
                //Dang nhap thanh cong
                if ($_SESSION['role'] == 1) {
                    header("location:" . SITEURL . 'admin/index.php');
                } else {
                    header("location:" . SITEURL . 'index.php');
                }
            } else {
                $_SESSION['ErrTOKEN'] = "Lỗi khi lưu token vào DB!";
            }
        } else {
            $_SESSION['ErrPASS'] = "Sai mật khẩu, vui lòng nhập lại";
        }
    } else {
        $_SESSION['ErrACC'] = "Không tồn tại tài khoản này!";
    }
}
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
        <form class="mx-auto" method="post">
            <h4 class="text-center">Đăng nhập</h4>

            <p class="text-center" style="color: green;"><?php if (isset($_SESSION["ChgPassS"])) {
                                                                echo $_SESSION["ChgPassS"];
                                                                unset($_SESSION["ChgPassS"]);
                                                            } ?></p>
            <p class="text-center" style="color: green;"><?php if (isset($_SESSION["addUS"])) {
                                                                echo $_SESSION["addUS"];
                                                                unset($_SESSION["addUS"]);
                                                            } ?></p>
            <p class="text-center" style="color: red;"><?php if (isset($_SESSION["ErrTOKEN"])) {
                                                            echo $_SESSION["ErrTOKEN"];
                                                            unset($_SESSION["ErrTOKEN"]);
                                                        } ?></p>
            <p class="text-center" style="color: red;"><?php if (isset($_SESSION["ErrPASS"])) {
                                                            echo $_SESSION["ErrPASS"];
                                                            unset($_SESSION["ErrPASS"]);
                                                        } ?></p>
            <p class="text-center" style="color: red;"><?php if (isset($_SESSION["reqROLE_ACC"])) {
                                                            echo $_SESSION["reqROLE_ACC"];
                                                            unset($_SESSION["reqROLE_ACC"]);
                                                        } ?></p>


            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="UserName">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="PassWord">

                <a href="quen-mat-khau.php">
                    <div id="emailHelp" class="form-text mt-3">Quên mật khẩu</div>
                </a>
                <br>
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="RememberMe">
                <label class="form-check-label" for="exampleCheck1">Nhớ đăng nhập</label>
                <br><br>
                <div>Chưa có tài khoản? <a href="./tao-tai-khoan.php">Tạo tài khoản mới</a></div>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Đăng nhập</button>
        </form>
    </div>
</body>

</html>