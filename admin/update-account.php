<?php
include('./callback/menu.php');

$unGet = $_GET['un'];

$sql = "SELECT * FROM tai_khoan WHERE TENNGUOIDUNG='$unGet'";
$res = mysqli_query($conn, $sql);

if ($res == true) {

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Lay thong tin
        $rows = mysqli_fetch_assoc($res);

        $un = $rows['TENNGUOIDUNG'];
        $pass = $rows['MATKHAU'];
        $per = $rows['QUYEN'];
        $fn = $rows['HOVATEN'];
        $p = $rows['SDT'];
        $m = $rows['EMAIL'];
        $addr = $rows['DIACHI'];
    } else {

        header('location:' . SITEURL . 'admin/account.php');
    }
}

?>


<!--php cap nhat-->
<?php
if (isset($_POST['Submit'])) {
    if (isset($_POST['AType'])) {
        $at1 = $_POST['AType'];
    }

    $pw1 = $_POST['Password'];
    $fn1 = $_POST['FullName'];
    $p1 = $_POST['Phone'];
    $m1 = $_POST['Email'];
    $addr1 = $_POST['Address'];

    $sql1 = "UPDATE tai_khoan SET MATKHAU='$pw1',QUYEN=$at1,HOVATEN='$fn1',SDT='$p1',EMAIL='$m1',DIACHI='$addr1' WHERE TENNGUOIDUNG='$unGet' ";
    $res1 = mysqli_query($conn, $sql1);

    if ($res1 == true) {

        $_SESSION["update"] = "Cập nhật người dùng thành công";

        header("location:" . SITEURL . 'admin/account.php');
    } else {

        $_SESSION["update"] = "Cập nhật người dùng thất bại";

        header("location:" . SITEURL . 'admin/update-account.php');
    }
}
?>


<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Cập nhật Tài Khoản</h2>
        </div>

    </div>

    <!--The-->
    <?php
    if (isset($_SESSION['update'])) {

    ?><div class="card--notificationF" style="display:block">
            <i class="fa-solid fa-x"></i>
            <?php echo $_SESSION['update'];

            ?>
        </div><?php
                unset($_SESSION['update']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="UserName" value="<?php echo $un; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="Password" value="<?php echo $pass; ?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="FullName" value="<?php echo $fn; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" pattern="[0-9]{10}" name="Phone" value="<?php echo $p; ?>">
            </div>
            <div class=" mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Email" value="<?php echo $m; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Address" value="<?php echo $addr; ?>">
            </div>

            <label for="exampleInputEmail1" class="form-label">Loại tài khoản</label>
            <select class="form-select" aria-label="Default select example" name="AType">

                <option value="1" <?php if ($per == 1) echo "selected"; ?>>Admin</option>
                <option value="0" <?php if ($per == 0) echo "selected"; ?>>Khách hàng</option>
            </select>
            <br>
            <input type="submit" value="Cập nhật" name="Submit" class="btn btn-primary">

        </form>
    </div>


</div>


</body>

</html>