<?php

include('./callback/menu.php');

$sqlDonHang = "SELECT DH.*,TK.DIACHI,TK.HOVATEN FROM DON_HANG DH JOIN TAI_KHOAN TK ON DH.TENNGUOIDUNG = TK.TENNGUOIDUNG ORDER BY ID_DONDAT DESC";
$resultDonHang = mysqli_query($conn, $sqlDonHang);


// <!--Phan chinh-->


if (isset($_GET['order_id'])) {
    // Hiển thị chi tiết đơn hàng
    $idDonHang = intval($_GET['order_id']);
    $sqlChiTiet = "SELECT ct.SOLUONG, ma.TENMONAN, ma.GIATIEN 
                       FROM CHI_TIET_DON_HANG ct
                       JOIN MON_AN ma ON ct.ID_MONAN = ma.ID_MONAN
                       WHERE ct.ID_DONDAT = $idDonHang";
    $resultChiTiet = mysqli_query($conn, $sqlChiTiet);
    $tongGiaTri = 15000;

    echo "<div class='main--content'>";
    echo "   <div class='header--wrapper'>";
    echo "        <div class='header--title'>";
    echo "            <h2>Chi tiết Đơn Hàng #$idDonHang</h2>";
    echo "        </div>";
    echo "    </div>";

    //---------------

    echo "<div class='tabular--wrapper'>";
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<thead><tr><th>Tên món ăn</th><th>Số lượng</th><th>Giá tiền</th><th>Thành tiền</th></tr></thead>";
    while ($rowChiTiet = mysqli_fetch_assoc($resultChiTiet)) {
        $tenMonAn = $rowChiTiet['TENMONAN'];
        $soLuong = $rowChiTiet['SOLUONG'];
        $giaTien = $rowChiTiet['GIATIEN'];
        $thanhTien = $soLuong * $giaTien;
        $tongGiaTri += $thanhTien;
        echo "<tr>";
        echo "<td>$tenMonAn</td>";
        echo "<td>$soLuong</td>";
        echo "<td>" . number_format($giaTien) . " đ</td>";
        echo "<td>" . number_format($thanhTien) . " đ</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='2'><b>Phí vận chuyển </b><td><td><b>" . number_format(15000) . " đ</b></td></tr>";
    echo "<tr><td colspan='2'><b>Tổng giá trị đơn hàng </b><td><td><b>" . number_format($tongGiaTri) . " đ</b></td></tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
} else {
    echo "<div class='main--content'>";
    echo "   <div class='header--wrapper'>";
    echo "        <div class='header--title'>";
    echo "            <h2>Quản Lý Đơn Hàng</h2>";
    echo "        </div>";
    echo "    </div>";

    // Hiển thị danh sách đơn hàng
    $kqTT = "";


    echo "<div class='tabular--wrapper'>";
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<thead><tr><th>Mã đơn hàng</th><th>Tên Khách Hàng</th><th>Ngày đặt</th><th>Trạng thái</th><th>GT Đơn</th><th>Thanh toán</th><th>Thông tin thêm</th><th>Hành động</th></tr></thead>";
    while ($rowDonHang = mysqli_fetch_assoc($resultDonHang)) {
        $idDonDat = $rowDonHang['ID_DONDAT'];
        $hovaten = $rowDonHang['HOVATEN'];
        $ngayDat = $rowDonHang['NGAYDATHANG'];
        $trangThai = intval($rowDonHang['TRANGTHAI']);
        $chiTiet = $rowDonHang['CHITIET'];
        $diaChi = $rowDonHang['DIACHI'];
        $tongGT = $rowDonHang['TONGGTDONHANG'];
        $pttt = $rowDonHang['THANHTOAN'];

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
        echo "<td>$idDonDat</td>";
        echo "<td>$hovaten</td>";
        echo "<td>$ngayDat</td>";
        echo "<td>$kqTT</td>";
        echo "<td>" . number_format($tongGT) . "đ</td>";
        echo "<td>$pttt</td>";
        echo "<td style='text-overflow: ellipsis; max-width: 150px; overflow: hidden'>$chiTiet</td>";
        // echo "<td>
        //     <a href='?order_id=$idDonDat'>Xem chi tiết</a>
        //     <form method='POST' class='action-form'>
        //         <input type='hidden' name='order_id' value='$idDonDat'>
        //         <select name='status'>
        //             <option value='0'" . ($rowDonHang['TRANGTHAI'] == 0 ? " selected" : "") . ">Đang xử lý</option>
        //             <option value='1'" . ($rowDonHang['TRANGTHAI'] == 1 ? " selected" : "") . ">Đã giao</option>
        //         </select>
        //         <button type='submit' name='update_status'>Cập nhật</button>
        //     </form>
        // </td>";
        echo "<td>";
        echo "<a href='?order_id=$idDonDat'><i class='fa-solid fa-eye'></i></a>";
        echo "&emsp;";
        echo "<a href='" . SITEURL . "admin/update-order.php?order_id=$idDonDat'><i class='fa-solid fa-wrench'></i></a>";
        echo "&emsp;";
        echo "<a href='" . SITEURL . "admin/auth-address.php?address=$diaChi'><i class='fa-solid fa-location-dot'></i></a>";
        echo "&emsp;";
        echo "<a href='" . SITEURL . "admin/export-bill.php?order_id=$idDonDat'><i class='fas fa-print'></i></a>";

        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
}
?>



</div>
</body>

</html>