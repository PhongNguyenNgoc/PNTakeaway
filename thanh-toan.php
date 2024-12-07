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
?>


<div class="container py-5">
    <div class="box">
        <h3 class="text-center">Xem lại đơn hàng</h3>
        <br>
        <form action="loadU/xu-ly-thanh-toan.php" method="POST">
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



            <button type="submit" class="btn btn-success">Thanh toán</button>
        </form>
    </div>
</div>



<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>