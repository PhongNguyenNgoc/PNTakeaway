<?php
include('./callbackU/menuU.php');

$un = $_SESSION['user_id'];

$sql = "SELECT * FROM tai_khoan WHERE TENNGUOIDUNG='$un'";
$res = mysqli_query($conn, $sql);

if ($res == true) {

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Lay thong tin
        $rows = mysqli_fetch_assoc($res);

        $fn0 = $rows['HOVATEN'];
        $p0 = $rows['SDT'];
        $m0 = $rows['EMAIL'];
        $addr0 = $rows['DIACHI'];
    }
}


if (isset($_POST['submit'])) {

    /////////////////////////////////
    $fn = $_POST['FullName'];
    $p = $_POST['Phone'];
    $m = $_POST['Email'];
    $addr = $_POST['Address'];


    $sql1 = "UPDATE tai_khoan SET HOVATEN='$fn',SDT='$p',EMAIL='$m',DIACHI='$addr' WHERE TENNGUOIDUNG='$un' ";
    $res1 = mysqli_query($conn, $sql1);

    if ($res1) {
        $_SESSION['UpdateBUserS'] = "Cập nhật thông tin thành công!";
    } else {
        $_SESSION['UpdateBUserF'] = "Cập nhật thông tin thất bại!";
    }
}
?>
<div class="container">
    <div class="box form-box">
        <header>Chỉnh sửa tài khoản</header>
        <p class="text-center" style="color: green;"><?php if (isset($_SESSION["UpdateBUserS"])) {
                                                            echo $_SESSION["UpdateBUserS"];
                                                            unset($_SESSION["UpdateBUserS"]);
                                                        } ?></p>
        <p class="text-center" style="color: red;"><?php if (isset($_SESSION["UpdateBUserF"])) {
                                                        echo $_SESSION["UpdateBUserF"];
                                                        unset($_SESSION["UpdateBUserF"]);
                                                    } ?></p>
        <form action="" method="post">
            <div class="field input">
                <label for="username">Tên người dùng</label>
                <input type="text" name="UserName" id="" value="<?php echo $_SESSION['user_id']; ?>" disabled>
            </div>
            <div class="field input">
                <label for="username">Họ và Tên</label>
                <input type="text" name="FullName" id="" value="<?php echo $fn0; ?>">
            </div>
            <div class="field input">
                <label for="username">Số điện thoại</label>
                <input type="tel" name="Phone" id="" value="<?php echo $p0; ?>">
            </div>
            <div class="field input">
                <label for="username">Email</label>
                <input type="email" name="Email" id="" value="<?php echo $m0; ?>">
            </div>
            <div class="field input">
                <label for="username">Địa chỉ</label>
                <input type="text" name="Address" id="" value="<?php echo $addr0; ?>">
            </div>
            <div class="field input">

                <a href="doi-mat-khau.php">Thay đổi mật khẩu</a>
            </div>





            <hr>
            <div class="field input ">
                <input class="btn" type="submit" value="Cập nhật tài khoản" name="submit">
            </div>
        </form>
        </form>
    </div>
</div>





<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>