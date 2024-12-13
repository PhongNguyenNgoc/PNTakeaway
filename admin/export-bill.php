<?php
// Kết nối cơ sở dữ liệu
include('/xampp/htdocs/PNTakeaway/admin/conn/constants.php');
// Lấy thông tin hóa đơn nếu có yêu cầu
$hoaDon = null;
if (isset($_GET['order_id'])) {
    $idDonHang = intval($_GET['order_id']);

    // Lấy thông tin đơn hàng
    $sqlDonHang = "SELECT dh.ID_DONDAT, dh.NGAYDATHANG, dh.TRANGTHAI, tk.HOVATEN, tk.SDT, tk.DIACHI,dh.THANHTOAN
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
    <title>In Hóa Đơn</title>
    <style>
        /* styles.css */
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .invoice {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .invoice-details {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        .invoice-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .invoice-footer {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="invoice">
        <img src="<?php echo SITEURL ?>img/logo.png" alt="" srcset="" width="150" height="100">
        <header class="invoice-header">

            <h1>HÓA ĐƠN BÁN HÀNG</h1>
            <p>Phong Nguyễn Takeaway</p>

        </header>
        <?php
        if ($hoaDon) {
        ?> <section class="invoice-details">
                <p><strong>Khách hàng:</strong> <?php echo $hoaDon['HOVATEN']; ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo $hoaDon['SDT']; ?></p>
                <p><strong>Địa chỉ giao:</strong> <?php echo $hoaDon['DIACHI']; ?></p>
                <p><strong>Ngày đặt:</strong> <?php echo $hoaDon['NGAYDATHANG']; ?></p>
                <p><strong>Thanh toán:</strong> <?php echo $hoaDon['THANHTOAN']; ?></p>
                <p><strong>Số hóa đơn:</strong> <?php echo $hoaDon['ID_DONDAT']; ?></p>
            </section>
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tongTien = 15000;
                    $stt = 1;
                    foreach ($chiTietDonHang as $mon) {
                        $tenMon = $mon['TENMONAN'];
                        $soLuong = $mon['SOLUONG'];
                        $giaTien = $mon['GIATIEN'];
                        $thanhTien = $soLuong * $giaTien;
                        $tongTien += $thanhTien;

                        echo "<tr>";
                        echo "<td>$stt</td>";
                        echo "<td>$tenMon</td>";
                        echo "<td>$soLuong</td>";
                        echo "<td>" . number_format($giaTien) . " đ</td>";
                        echo "<td>" . number_format($thanhTien) . " đ</td>";
                        echo "</tr>";
                        $stt++;
                    }
                    ?>

                </tbody>
            </table>
            <footer class="invoice-footer">
                <p><strong>Phí vận chuyển:</strong> <?php echo number_format(15000); ?>₫</p>
                <p><strong>Tổng cộng:</strong> <?php echo number_format($tongTien); ?>₫</p>
                <p>Cảm ơn quý khách và chúc quý khách ngon miệng!</p>

            </footer><?php
                    } else {
                        echo "Chưa chọn đơn hàng, vui lòng chọn đơn hàng cụ thể";
                    }
                        ?>
    </div>

</body>

</html>

<?php
// Đóng kết nối
mysqli_close($conn);
?>