<?php
include('./callbackU/menuU.php');


// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("location:" . SITEURL . "/dang-nhap.php"); // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    exit();
}

$ten_nguoidung = $_SESSION['user_id']; // Lấy tên người dùng từ session

// Truy vấn giỏ hàng của người dùng
$sql = "SELECT G.ID_MONAN, M.TENMONAN, G.SOLUONG, M.GIATIEN ,M.ANH
        FROM GIO_HANG G 
        JOIN MON_AN M ON G.ID_MONAN = M.ID_MONAN
        WHERE G.TENNGUOIDUNG = '$ten_nguoidung'";

$res = mysqli_query($conn, $sql);
$items = mysqli_fetch_all($res, MYSQLI_ASSOC);

if (count($items) == 0) {
    echo "Giỏ hàng của bạn hiện tại không có món nào. Vui lòng thêm món vào giỏ hàng.";
    exit();
}

// Tính tổng giá trị giỏ hàng
$total = 0;
foreach ($items as $item) {
    $total += $item['GIATIEN'] * $item['SOLUONG'];
}
//Cong them vi van chuyen
$total = $total + 15000;

//Truy van thong tin khach hang
$sql1 = "SELECT * FROM tai_khoan WHERE TENNGUOIDUNG = '$ten_nguoidung'";

$res1 = mysqli_query($conn, $sql1);

if ($res1 == true) {


    // Lay thong tin
    $rows = mysqli_fetch_assoc($res1);
    $fn0 = $rows['HOVATEN'];
    $p0 = $rows['SDT'];
    $addr0 = $rows['DIACHI'];
}

//Xu ly khi nhan nut Thanh Toan
if (isset($_POST['submit'])) {

    /////////////////////////////////
    $fn = $_POST['FullName'];
    $p = $_POST['Phone'];
    $addr = $_POST['Address'];
    $pay = $_POST['paymentMethod'];


    $sql2 = "UPDATE tai_khoan SET HOVATEN='$fn',SDT='$p',DIACHI='$addr' WHERE TENNGUOIDUNG='$ten_nguoidung'";
    $res2 = mysqli_query($conn, $sql2);

    switch ($pay) {
        case "COD":
            $_SESSION['pay'] = $pay;
            header("location:" . SITEURL . 'loadU/xu-ly-thanh-toan.php');
            break;
        case "Chuyển Khoản":
            $_SESSION["pay"] = $pay;
            $_SESSION["tp"] = $total;
            header("location:" . SITEURL . 'loadU/gia-lap-chuyen-khoan.php');
            break;

        default:
            echo "Lỗi";
    }
}
?>


<div class="container py-5">
    <div class="box">
        <h3 class="text-center">Xem lại đơn hàng</h3>
        <br>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên món ăn</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['TENMONAN']; ?></td>
                        <td><?php echo $item['SOLUONG']; ?></td>
                        <td><?php echo number_format($item['GIATIEN']); ?> đ</td>
                        <td><?php echo number_format($item['GIATIEN'] * $item['SOLUONG']); ?> đ</td>
                    </tr>
                <?php endforeach; ?>
                <!--Xem phi van chuyen-->
                <tr>
                    <td colspan="3"><b>Phí vận chuyển</b></td>
                    <td><b><?php echo number_format(15000); ?> đ</b></td>
                </tr>
            </tbody>
        </table>

        <h4>Tổng cộng: <?php echo number_format($total); ?> đ</h4>


    </div>

    <br>
    <div class="box form-box">
        <header>Thông tin giao hàng</header>

        <form id="paymentForm" action="" method="post">

            <div class="field input">
                <label for="username">Họ và Tên</label>
                <input type="text" name="FullName" id="" value="<?php echo $fn0; ?>">
            </div>
            <div class="field input">
                <label for="username">Số điện thoại</label>
                <input type="tel" name="Phone" id="" value="<?php echo $p0; ?>">
            </div>

            <div class="field input">
                <label for="username">Địa chỉ</label>
                <input type="text" name="Address" id="" value="<?php echo $addr0; ?>">
            </div>



            <div class="field">
                <label for="username">Phương thức thanh toán</label>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" value="COD" checked>
                    <label class="form-check-label" for="paymentMethod">
                        Thanh toán khi nhận hàng
                    </label>
                </div>


                <div class="form-check">

                    <input class="form-check-input" type="radio" name="paymentMethod" value="Chuyển Khoản">
                    <label class="form-check-label" for="paymentMethod">
                        Chuyển khoản ngân hàng
                    </label>
                </div>
            </div>


            <hr>
            <button type="submit" class="btn btn-success" id="submitButton" name="submit">Thanh toán</button>
        </form>

    </div>
</div>



<!--Chan trang web-->
<?php

include('./callbackU/footerU.php');


?>