<?php
include('./callback/menu.php');
if (isset($_POST['Submit'])) {
    if (isset($_POST['AType'])) {
        $at = $_POST['AType'];
    }
    $un = $_POST['UserName'];
    $pw = md5($_POST['Password']);
    $fn = $_POST['FullName'];
    $p = $_POST['Phone'];
    $m = $_POST['Email'];
    $addr = $_POST['Address'];

    $sql = "INSERT INTO tai_khoan SET TENNGUOIDUNG='$un', MATKHAU='$pw',QUYEN=$at,HOVATEN='$fn',SDT='$p',EMAIL='$m',DIACHI='$addr' ";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $_SESSION["add"] = "Thêm người dùng thành công";

        header("location:" . SITEURL . 'admin/account.php');
    } else {

        $_SESSION["add"] = "Thêm người dùng thất bại";

        header("location:" . SITEURL . 'admin/add-account.php');
    }
}
?>


<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Thêm Tài Khoản</h2>
        </div>

    </div>

    <!--The-->
    <?php
    if (isset($_SESSION['add'])) {

    ?><div class="card--notificationF" style="display:block">
            <i class="fa-solid fa-x"></i>
            <?php echo $_SESSION['add'];

            ?>
        </div><?php
                unset($_SESSION['add']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="UserName">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="Password">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="FullName">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" pattern="[0-9]{10}" name="Phone">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Email">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Address">
            </div>

            <label for="exampleInputEmail1" class="form-label">Loại tài khoản</label>
            <select class="form-select" aria-label="Default select example" name="AType">

                <option value="1">Admin</option>
                <option value="0">Khách hàng</option>
            </select>
            <br>
            <input type="submit" value="Thêm" name="Submit" class="btn btn-primary">

        </form>
    </div>


</div>


</body>

</html>