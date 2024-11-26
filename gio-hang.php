<?php
include('./callbackU/menuU.php');


// Kiểm tra nếu người dùng đã đăng nhập



// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("location:" . SITEURL . "/dang-nhap.php"); // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    exit();
}

$ten_nguoidung = $_SESSION['user_id']; // Lấy tên người dùng từ session

// Truy vấn giỏ hàng
$sql = "SELECT G.ID_MONAN, M.TENMONAN, G.SOLUONG, M.GIATIEN ,M.ANH
        FROM GIO_HANG G 
        JOIN MON_AN M ON G.ID_MONAN = M.ID_MONAN
        WHERE G.TENNGUOIDUNG = '$ten_nguoidung'";

$res = mysqli_query($conn, $sql);
$items = mysqli_fetch_all($res, MYSQLI_ASSOC);

$total = 0; // Khởi tạo tổng giá trị giỏ hàng

?>

<div class="container py5">
    <div class="box">
        <?php if (count($items) > 0): ?>
            <form action="loadU/cap-nhat-gio-hang.php" method="POST">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên món ăn</th>

                            <th>Giá</th>
                            <th>Tổng</th>
                            <th>Sửa Số lượng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><img src="<?php echo SITEURL . 'img/food/' . $item['ANH']; ?>" width="75" height="75" alt="anh"></td>
                                <td><?php echo $item['TENMONAN'] . " (x" . $item['SOLUONG'] . ")"; ?></td>

                                <td><?php echo number_format($item['GIATIEN']); ?> đ</td>
                                <td>
                                    <?php
                                    $item_total = $item['GIATIEN'] * $item['SOLUONG'];
                                    echo number_format($item_total) . " đ";
                                    $total += $item_total; // Cộng dồn vào tổng giá trị giỏ hàng
                                    ?>
                                </td>
                                <td>
                                    <input type="number" name="soluong[<?php echo $item['ID_MONAN']; ?>]" value="<?php echo $item['SOLUONG']; ?>" min="0" class="form-control" style="width: 70px;">
                                </td>
                                <td>

                                    <a href="loadU/xoa-mon-gh.php?id_mon_an=<?php echo $item['ID_MONAN']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h4>Tổng cộng: <?php echo number_format($total); ?> đ</h4>

                <!-- Nút thanh toán -->
                <div>
                    <button class="btn"><a href="checkout.php">Tiến hành thanh toán</a></button>
                    <button type="submit" class="btn">Cập nhật số lượng</button>
                </div>
            </form>
        <?php else: ?>
            <p>Giỏ hàng của bạn đang trống.</p>
        <?php endif; ?>
    </div>
</div>











<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>