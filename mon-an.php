<?php
include('./callbackU/menuU.php');

?>

<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL ?>tim-kiem.php" method="get">
            <input type="search" name="timKiem" placeholder="Tìm kiếm món ăn cụ thể" required>
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>

    </div>
</section>
<br>
<div class="container py5">
    <h3 class="text-center">Món ăn tại PN Takeaway</h3>
    <div class="row row-cols-1 row-cols-md-4 g-4 py-5">

        <?php
        $sql = "SELECT MON_AN.*, LOAI_MON_AN.TENLOAI FROM MON_AN JOIN LOAI_MON_AN ON MON_AN.ID_LOAIMONAN = LOAI_MON_AN.ID_LOAIMONAN WHERE MON_AN.TRANGTHAI = 1";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $idF = $row['ID_MONAN'];
                $idT = $row['ID_LOAIMONAN'];
                $nF = $row['TENMONAN'];
                $p = $row['GIATIEN'];
                $detailF = $row['CHITIETMONAN'];
                $img = $row['ANH'];
                $type = $row['TENLOAI'];

        ?> <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo SITEURL . "img/food/" . $img; ?>" class="card-img-top" alt="..." width="250" height="250">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $nF; ?></h5>
                            <p>Loại: <?php echo $type; ?> </p>
                            <p class="card-text"><?php echo $detailF; ?></p>

                        </div>
                        <div class="d-flex justify-content-around mb-5">
                            <h5><?php echo number_format($p); ?> đ</h5>
                            <button class="btn btn-primary" onclick="addToCart(<?php echo $idF; ?>)">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div><?php

                    }
                } ?>

    </div>
</div>

<script>
    function addToCart(idMonAn) {

        var user = <?php echo json_encode($_SESSION['user_id']); ?>;

        if (user != "") {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?php echo SITEURL; ?>loadU/them-gio-hang.php?idMon=" + idMonAn, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Đã thêm món vào giỏ hàng!');
                    // Cập nhật giỏ hàng ở giao diện nếu cần
                }
            };
            xhr.send();
        }

    }
</script>
<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>