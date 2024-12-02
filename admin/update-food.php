<?php
include('./callback/menu.php');

$id = $_GET['id'];
$anhO = $_GET['image_name'];

$sql1 = "SELECT LOAI_MON_AN.ID_LOAIMONAN,MON_AN.ID_MONAN,LOAI_MON_AN.TENLOAI AS TENLOAI,MON_AN.TENMONAN,MON_AN.GIATIEN,MON_AN.CHITIETMONAN,MON_AN.TRANGTHAI,MON_AN.ANH FROM MON_AN INNER JOIN LOAI_MON_AN ON MON_AN.ID_LOAIMONAN = LOAI_MON_AN.ID_LOAIMONAN WHERE ID_MONAN=$id";
$res1 = mysqli_query($conn, $sql1);

if ($res1 == true) {

    $count1 = mysqli_num_rows($res1);

    if ($count1 == 1) {
        // Lay thong tin
        $rows1 = mysqli_fetch_assoc($res1);

        $idMon = $rows1['ID_MONAN'];
        $idLoaiMon1 = $rows1['ID_LOAIMONAN'];

        $img = $rows1['ANH'];
        $nameF = $rows1['TENMONAN'];
        $detailF = $rows1['CHITIETMONAN'];
        $typeF = $rows1['TENLOAI'];
        $price = $rows1['GIATIEN'];

        $status = $rows1['TRANGTHAI'];
    } else {

        header('location:' . SITEURL . 'admin/food.php');
    }
}



?>


<!--php cap nhat-->
<?php
if (isset($_POST['Submit'])) {
    //Xoa anh cũ
    // $pathO = "../img/food/" . $anhO;
    // $remove = unlink($pathO);

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {

        $pathO = "../img/food/" . $anhO;
        if (file_exists($pathO)) {
            unlink($pathO);
        }
        $image_name = $_FILES['image']['name'];

        //lay duoi file
        //$ext = end(explode('.', $image_name));
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

        //Doi ten anh
        $image_name = "ThucAn_" . rand(0, 9999) . '.' . $ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../img/food/" . $image_name;
        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == false) {
            echo "Tai anh that bai!";
            $image_name = $anhO;
        }
    } else {
        $image_name = $anhO;;
    }

    $foodName = $_POST['NameF'];
    $foodType = $_POST['FType'];
    $price = $_POST['PriceF'];
    $des = $_POST['DetailF'];
    $status = $_POST['status'];
    $image = $image_name;




    $sql3 = "UPDATE mon_an SET ID_LOAIMONAN=$foodType,TENMONAN='$foodName',GIATIEN=$price,CHITIETMONAN='$des',TRANGTHAI=$status,ANH='$image_name' WHERE ID_MONAN=$id";
    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == true) {

        $_SESSION["addF"] = "Thêm món thành công";

        header("location:" . SITEURL . 'admin/food.php');
    } else {

        $_SESSION["addF"] = "Thêm món thất bại";


        // print_r($_FILES['image']);
        // die();
        // }
    }
}
?>


<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Cập nhật Món Ăn</h2>
        </div>

    </div>

    <!--The-->
    <?php
    if (isset($_SESSION['updateF'])) {

    ?><div class="card--notificationF" style="display:block">
            <i class="fa-solid fa-x"></i>
            <?php echo $_SESSION['updateF'];

            ?>
        </div><?php
                unset($_SESSION['updateF']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên món ăn</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="NameF" value="<?php echo $nameF; ?>">
            </div>
            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Loại món ăn</label>
                <select class="form-select" aria-label="Default select example" name="FType">
                    <!-- Do du lieu tu loai thuc an vao cb -->
                    <?php
                    $sql = "SELECT * FROM  loai_mon_an";
                    $res = mysqli_query($conn, $sql);

                    if ($res) {
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id_loai = $row['ID_LOAIMONAN'];
                                $ten_loai = $row['TENLOAI'];


                    ?><option value="<?php echo $id_loai; ?>" <?php if ($id_loai == $idLoaiMon1) {
                                                                    echo "selected";
                                                                } ?>><?php echo $ten_loai;
                                                                        ?></option><?php
                                                                                }
                                                                            } else {
                                                                                echo "<option value=''>Chưa có loại món nào được thêm vào!</option>";
                                                                            }
                                                                        }
                                                                                    ?>


                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Giá tiền (đ)</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="PriceF" value="<?php echo $price; ?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Chi tiết món ăn</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="DetailF"><?php echo $detailF; ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="1" <?php if ($status == 1) {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                    <label class="form-check-label" for="status">
                        Còn kinh doanh
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="0" <?php if ($status == 0) echo "checked"; ?>>
                    <label class="form-check-label" for="status">
                        Không còn kinh doanh
                    </label>

                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh</label>
                <p>Ảnh cũ</p>
                <?php echo "<img src='" . SITEURL . "img/food/" . $img . "'width='75' height='75' alt='Không có ảnh'>"; ?>
                <br>
                <br>
                <p>Ảnh mới</p>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>

            <input type="submit" value="Cập nhật" name="Submit" class="btn btn-primary">

        </form>
    </div>


</div>


</body>

</html>