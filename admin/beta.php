<?php
// Kết nối cơ sở dữ liệu
include('/xampp/htdocs/PNTakeaway/admin/conn/constants.php');
// Lấy thông tin hóa đơn nếu có yêu cầu
$hoaDon = null;
if (isset($_GET['order_id'])) {
    $idDonHang = intval($_GET['order_id']);

    // Lấy thông tin đơn hàng
    $sqlDonHang = "SELECT dh.ID_DONDAT, dh.NGAYDATHANG, dh.TRANGTHAI, tk.HOVATEN, tk.SDT, tk.DIACHI
                   FROM DON_HANG dh
                   JOIN TAI_KHOAN tk ON dh.TENNGUOIDUNG = tk.TENNGUOIDUNG
                   WHERE dh.ID_DONDAT = $idDonHang";
    $resultDonHang = mysqli_query($conn, $sqlDonHang);
    $hoaDon = mysqli_fetch_assoc($resultDonHang);

    // Lấy chi tiết đơn hàng
    $sqlChiTiet = "SELECT ma.TENMONAN, ct.SOLUONG, ma.GIATIEN
                   FROM CHI_TIET_DON_HANG ct
                   JOIN MON_AN ma ON ct.ID_MONAN = ma.ID_MONAN
                   WHERE ct.ID_DONDAT =  $idDonHang";
    $resultChiTiet = mysqli_query($conn, $sqlChiTiet);
    $chiTietDonHang = [];
    while ($row = mysqli_fetch_assoc($resultChiTiet)) {
        $chiTietDonHang[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .invoice {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }

        .print-button {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php if ($hoaDon): ?>
        <div class="invoice">
            <h1>Hóa đơn</h1>
            <p><strong>Mã đơn hàng:</strong> <?php echo $hoaDon['ID_DONDAT']; ?></p>
            <p><strong>Họ và tên:</strong> <?php echo $hoaDon['HOVATEN']; ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $hoaDon['SDT']; ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo $hoaDon['DIACHI']; ?></p>
            <p><strong>Ngày đặt:</strong> <?php echo $hoaDon['NGAYDATHANG']; ?></p>
            <p><strong>Trạng thái:</strong> <?php echo $hoaDon['TRANGTHAI'] ? "Đã giao" : "Đang xử lý"; ?></p>

            <h2>Chi tiết đơn hàng</h2>
            <table>
                <tr>
                    <td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <th>Tên món ăn</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                $tongTien = 0;
                foreach ($chiTietDonHang as $mon) {
                    $tenMon = $mon['TENMONAN'];
                    $soLuong = $mon['SOLUONG'];
                    $giaTien = $mon['GIATIEN'];
                    $thanhTien = $soLuong * $giaTien;
                    $tongTien += $thanhTien;

                    echo "<tr>";
                    echo "<td>$tenMon</td>";
                    echo "<td>$soLuong</td>";
                    echo "<td>" . number_format($giaTien) . " VNĐ</td>";
                    echo "<td>" . number_format($thanhTien) . " VNĐ</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Tổng cộng:</strong></td>
                    <td><strong><?php echo number_format($tongTien); ?> VNĐ</strong></td>
                </tr>
            </table>

            <div class="print-button">
                <button onclick="window.print()">In hóa đơn</button>
            </div>
        </div>
    <?php else: ?>
        <p>Không có thông tin hóa đơn để hiển thị. Vui lòng chọn đơn hàng hợp lệ.</p>
    <?php endif; ?>

</body>

</html>

<?php
// Đóng kết nối
mysqli_close($conn);
?>