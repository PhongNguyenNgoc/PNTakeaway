<?php
include('./callbackU/menuU.php');
if (isset($_POST['submit'])) {

    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $userName = $_SESSION['user_id'];
        $text = $_POST['textA'];

        $sql = "UPDATE don_hang SET TRANGTHAI= 5, CHITIET='$text'  WHERE TENNGUOIDUNG = '$userName' AND ID_DONDAT=$order_id";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            header("location:" . SITEURL . "/quan-ly-don-hang.php");
        }
    }
}
?>



<br>
<div class="container">
    <div class="box form-box">
        <header>Hủy đơn hàng</header>

        <form action="" method="post">
            <div class="field input">
                <label for="textA">Tại sao bạn lại muốn hủy đơn hàng?</label>
                <br>

                <textarea name="textA" id="" cols="50" rows="15" required></textarea>
            </div>

            <hr>
            <div class="field input ">
                <input class="btn" type="submit" value="Xác nhận" name="submit">
            </div>
        </form>

    </div>
</div>





<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>