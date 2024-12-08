<?php
include('./callbackU/menuU.php');
if (!isset($_SESSION['user_id'])) {
    die("Bạn cần đăng nhập để xem đơn hàng.");
    exit;
}

$tenNguoiDung = $_SESSION['user_id'];

// Lấy danh sách đơn hàng
$sqlDonHang = "SELECT * FROM DON_HANG WHERE TENNGUOIDUNG = '$tenNguoiDung' ORDER BY ID_DONDAT DESC";
$resultDonHang = mysqli_query($conn, $sqlDonHang);

?>


<div class="container py-5">
    <div class="box">
        <h3 class="text-center">Quản lý đơn hàng</h3>

        <?php
        if (isset($_GET['order_id'])) {
            // Hiển thị chi tiết đơn hàng
            $idDonHang = intval($_GET['order_id']);
            $sqlChiTiet = "SELECT ct.SOLUONG, ma.TENMONAN, ma.GIATIEN ,ma.ANH
                       FROM CHI_TIET_DON_HANG ct
                       JOIN MON_AN ma ON ct.ID_MONAN = ma.ID_MONAN
                       WHERE ct.ID_DONDAT = $idDonHang";
            $resultChiTiet = mysqli_query($conn, $sqlChiTiet);
            $tongThanhToan = 15000;

            echo "<table class='table table-hover'>";
            echo "<thead><tr><th>Ảnh</th><th>Tên món ăn</th><th>Số lượng</th><th>Giá tiền</th><th>Thành tiền</th></tr></thead>";
            while ($rowChiTiet = mysqli_fetch_assoc($resultChiTiet)) {
                $tenMonAn = $rowChiTiet['TENMONAN'];
                $soLuong = $rowChiTiet['SOLUONG'];
                $giaTien = $rowChiTiet['GIATIEN'];
                $thanhTien = $soLuong * $giaTien;
                $img = $rowChiTiet['ANH'];
                echo "<tr>";
                echo "<td><img src='" . SITEURL . "/img/food/" . $img . "' width='75' height='75'></td>";
                echo "<td>$tenMonAn</td>";
                echo "<td>$soLuong</td>";
                echo "<td>" . number_format($giaTien) . " đ</td>";
                echo "<td>" . number_format($thanhTien) . " đ</td>";
                echo "</tr>";
                $tongThanhToan += $thanhTien;
            }
            echo "<tr>";
            echo "<td colspan='4'><b>Phí vận chuyển</b></td>";
            echo "<td><b>" . number_format(15000) . " đ</b></td>";
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='4'><b>Tổng cần thanh toán:</b></td>";
            echo "<td><b>" . number_format($tongThanhToan) . " đ</b></td>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "<a href='?'>Quay lại danh sách đơn hàng</a>";
        } else {
            // Hiển thị danh sách đơn hàng
            echo "<br>";
            echo "<table class='table table-hover'>";
            echo "<thead><tr><th>Mã đơn hàng</th><th>Ngày đặt</th><th>Trạng thái</th><th>Thông tin thêm</th><th>Thao tác</th></tr></thead>";
            while ($rowDonHang = mysqli_fetch_assoc($resultDonHang)) {
                $idDonHang = $rowDonHang['ID_DONDAT'];
                $ngayDat = $rowDonHang['NGAYDATHANG'];
                $trangThai = intval($rowDonHang['TRANGTHAI']);
                $thongTin = $rowDonHang['CHITIET'];
                $kqTT = "";

                if ($trangThai == 0) {
                    $kqTT = "Đã nhận đơn";
                } elseif ($trangThai == 1) {
                    $kqTT = "Đang chuẩn bị món";
                } elseif ($trangThai == 2) {
                    $kqTT = "Đang giao";
                } elseif ($trangThai == 3) {
                    $kqTT = "Đã giao";
                } elseif ($trangThai == 4) {
                    $kqTT = "Đã hủy do quán";
                } elseif ($trangThai == 5) {
                    $kqTT = "Đã hủy do khách";
                }

                echo "<tr>";
                echo "<td>$idDonHang</td>";
                echo "<td>$ngayDat</td>";
                echo "<td>$kqTT</td>";
                echo "<td>$thongTin</td>";

                if ($trangThai == 0) {
                    echo "<td><button class='btn'><a href='?order_id=$idDonHang'>Xem chi tiết</a></button> &nbsp;<button class='btn'><a href='huy-don-hang.php?order_id=$idDonHang'>Hủy đơn hàng</a></button></td>";
                } else {
                    echo "<td><button class='btn'><a href='?order_id=$idDonHang'>Xem chi tiết</a></button></td>";
                }


                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</div>
<?php

include('./callbackU/footerU.php');
?>

<tr c>
    <th colspan="1"></th>
</tr>