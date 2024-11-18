<?php
include('./admin/conn/constants.php');

if (isset($_POST['submit'])) {
    $s = $_POST['s'];
    $np = md5($_POST['NPassWord']);
    $rp = md5($_POST['RePassWord']);

    if ($np == $rp) {
        $sql = "SELECT * FROM tai_khoan WHERE TENNGUOIDUNG='$s' AND QUYEN=0";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {

            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $sql2 = "UPDATE tai_khoan SET MATKHAU='$np' WHERE TENNGUOIDUNG='$s'";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION["ChgPassS"] = "Đổi mật khẩu thành công!";

                    header("location:" . SITEURL . 'dang-nhap.php');
                } else {
                    $_SESSION["ChgPassErr"] = "Đổi mật khẩu thất bại";
                }
            } else {
                $_SESSION["ChgPassErr"] = "Tên người dùng không tồn tại!";
            }
        }
    } else {
        $_SESSION["ChgPassErr"] = "Hai mật khẩu chưa trùng khớp!";
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
    <title>Đổi lại mật khẩu</title>
</head>

<body>

    <div class="container-fluid">
        <form class="mx-auto" method="post">
            <h4 class="text-center">Đổi lại mật khẩu</h4>

            <p class="text-center" style="color: red;"><?php if (isset($_SESSION["ChgPassErr"])) {
                                                            echo $_SESSION["ChgPassErr"];
                                                            unset($_SESSION["ChgPassErr"]);
                                                        } ?></p>

            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="s" required>
            </div>


            <div class=" mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="NPassWord" required>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="RePassWord" required>

            </div>

            <button type="submit" class="btn btn-primary" name="submit">Cập nhật mật khẩu</button>
        </form>
    </div>
</body>

</html>