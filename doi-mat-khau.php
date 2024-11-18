<?php
include('./callbackU/menuU.php');
if (isset($_POST['submit'])) {
    $oldpass = md5($_POST['oPass']);
    $newpass = md5($_POST['nPass']);
    $repass = md5($_POST['reNPass']);

    $userName = $_SESSION['user_id'];

    if ($newpass == $repass) {
        $sql = "SELECT * FROM tai_khoan WHERE TENNGUOIDUNG='$userName' AND MATKHAU ='$oldpass'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) == 1) {
            $rows = mysqli_fetch_assoc($res);
            if ($oldpass == $rows['MATKHAU']) {
                $sql_upadate = "UPDATE tai_khoan SET MATKHAU = '$newpass' WHERE TENNGUOIDUNG = '$userName'";
                $res2 = mysqli_query($conn, $sql_upadate);
                if ($res2 == true) {
                    $_SESSION['ChgPassBUserS'] = "Đổi mật khẩu thành công!";
                } else {
                    $_SESSION['ChgPassBUserF'] = "Đổi mật khẩu thất bại!";
                }
            } else {
                $_SESSION['ChgPassBUserF'] = "Mật khẩu cũ chưa đúng!";
            }
        } else {
            $_SESSION['ChgPassBUserF'] = "Lỗi CSDL!";
        }
    } else {
        $_SESSION['ChgPassBUserF'] = "2 Mật khẩu mới chưa khớp!";
    }
}
?>



<br>
<div class="container">
    <div class="box form-box">
        <header>Đổi mật khẩu</header>
        <p class="text-center" style="color: green;"><?php if (isset($_SESSION["ChgPassBUserS"])) {
                                                            echo $_SESSION["ChgPassBUserS"];
                                                            unset($_SESSION["ChgPassBUserS"]);
                                                        } ?></p>
        <p class="text-center" style="color: red;"><?php if (isset($_SESSION["ChgPassBUserF"])) {
                                                        echo $_SESSION["ChgPassBUserF"];
                                                        unset($_SESSION["ChgPassBUserF"]);
                                                    } ?></p>
        <form action="" method="post">
            <div class="field input">
                <label for="username">Mật khẩu cũ</label>
                <input type="password" name="oPass" id="">
            </div>
            <div class="field input">
                <label for="username">Mật khẩu mới</label>
                <input type="password" name="nPass" id="">
            </div>
            <div class="field input">
                <label for="username">Nhập lại mật khẩu mới</label>
                <input type="password" name="reNPass" id="">
            </div>
            <hr>
            <div class="field input ">
                <input class="btn" type="submit" value="Đổi lại mật khẩu" name="submit">
            </div>
        </form>
        </form>
    </div>
</div>





<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>