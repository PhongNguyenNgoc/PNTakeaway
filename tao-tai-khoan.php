<?php
include('./admin/conn/constants.php');

if (isset($_POST['submit'])) {
    $fn = $_POST['FullName'];
    $p = $_POST['Phone'];
    $m = $_POST['Email'];
    $addr = $_POST['Address'];
    $un = $_POST['UserName'];
    $pass = $_POST['PassWord'];

    //echo $fn . $p . $m . $addr . $un . $pass;

    $sql = "INSERT INTO tai_khoan SET TENNGUOIDUNG='$un', MATKHAU='$pass',QUYEN=0,HOVATEN='$fn',SDT='$p',EMAIL='$m',DIACHI='$addr' ";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION["addUS"] = " Đăng ký thành";
        header("location:" . SITEURL . 'dang-nhap.php');
    } else {
        $_SESSION["addUE"] = "Tên tài khoản này đã có người sử dụng!";
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
    <title>Tạo tài khoản mới</title>
</head>

<body>

    <div class="container-fluid">
        <form class="mx-auto" method="post">
            <h4 class="text-center">Tạo tài khoản</h4>

            <p class="text-center" style="color: red;"><?php if (isset($_SESSION["addUE"])) {
                                                            echo $_SESSION["addUE"];
                                                            unset($_SESSION["addUE"]);
                                                        } ?></p>

            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="FullName" required>

            </div>

            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="exampleInputEmail1" pattern="[0-9]{10}" name="Phone" required>

            </div>
            <div class=" mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="Email" required>

            </div>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="Address" required>

            </div>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="UserName" required>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="PassWord" required>

                <br>
                <div>Đã có taì khoản? <a href="./dang-nhap.php">Đăng nhập ngay</a></div>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Tạo tài khoản mới</button>
        </form>
    </div>
</body>

</html>