<?php
include('./callback/menu.php');

$id = $_GET['order_id'];

$sql = "SELECT DON_HANG.*,TAI_KHOAN.HOVATEN FROM DON_HANG JOIN TAI_KHOAN ON DON_HANG.TENNGUOIDUNG = TAI_KHOAN.TENNGUOIDUNG WHERE DON_HANG.ID_DONDAT = '$id';";
$res = mysqli_query($conn, $sql);

if ($res == true) {

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Lay thong tin
        $rows = mysqli_fetch_assoc($res);


        $fn = $rows['HOVATEN'];
        $date = $rows['NGAYDATHANG'];
        $status = $rows['TRANGTHAI'];
    } else {

        header('location:' . SITEURL . 'admin/manage-order.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-order.php');
}

?>


<!--php cap nhat-->
<?php
if (isset($_POST['Submit'])) {

    $detail = $_POST['detail'];
    $nStatus = $_POST['status'];




    $sql1 = "UPDATE DON_HANG SET TRANGTHAI='$nStatus',CHITIET='$detail' WHERE ID_DONDAT='$id'";
    $res1 = mysqli_query($conn, $sql1);

    if ($res1 == true) {

        header("location:" . SITEURL . 'admin/manage-order.php');
    }
}
?>


<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Cập Nhật Đơn Hàng #<?php echo $_GET['order_id']; ?></h2>
        </div>

    </div>

    <!--The-->

    <!--Bang-->

    <div class="tabular--wrapper">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên khách hàng</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nfn" value="<?php echo $fn; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Thời gian đặt</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nfn" value="<?php echo $date; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Trạng thái</label>
                <select class="form-select" aria-label="Default select example" name="status">

                    <option value="0">Đã nhận đơn</option>
                    <option value="1">Đang chuẩn bị món</option>
                    <option value="2">Đang giao</option>
                    <option value="3">Đã giao</option>
                    <option value="4">Đã hủy do quán</option>

                </select>
            </div>
            <div class="mb-3">
                <label for="detail">Thông tin thêm cho khách hàng</label>
                <br>
                <br>
                <textarea name="detail" id="" cols="140" rows="10" style=" border: 2px solid black;"></textarea>
            </div>


            <input type="submit" value="Cập nhật" name="Submit" class="btn btn-primary">

        </form>
    </div>


</div>


</body>