<?php
include('./callbackU/menuU.php');

?>

<section class="food-search text-center">
    <div class="container">

        <h2>Kết quả cho "<a href="#" class="text-white"><?php echo $_POST['timKiem']; ?></a>"</h2>

    </div>
</section>
<br>
<div class="container py5">

    <div class="row row-cols-1 row-cols-md-4 g-4 py-5">

        <?php
        $txt = $_POST['timKiem'];
        $sql = "SELECT MA.* FROM MON_AN MA JOIN LOAI_MON_AN LMA ON MA.ID_LOAIMONAN = LMA.ID_LOAIMONAN WHERE LMA.TENLOAI LIKE ('%$txt%') OR MA.TENMONAN LIKE ('%$txt%')";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($res) {
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idF = $row['ID_MONAN'];
                    $idT = $row['ID_LOAIMONAN'];
                    $nF = $row['TENMONAN'];
                    $p = $row['GIATIEN'];
                    $detailF = $row['CHITIETMONAN'];
                    $img = $row['ANH'];

        ?> <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="<?php echo SITEURL . "img/food/" . $img; ?>" class="card-img-top" alt="..." width="250" height="250">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $nF; ?></h5>
                                <p class="card-text"><?php echo $detailF; ?></p>
                            </div>
                            <div class="d-flex justify-content-around mb-5">
                                <h5><?php echo $p; ?> đ</h5>
                                <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                            </div>
                        </div>
                    </div><?php
                        }
                    } else {
                            ?><h3 class="text-center" style="color: red;">Không có dữ liệu</h3><?php
                                                                                            }
                                                                                        }
                                                                                                ?>
    </div>
</div>






<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>