<?php
include('./callback/menu.php');
if (isset($_POST['Submit'])) {


    if (isset($_FILES['image']['name'])) {
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
        }
    } else {
        $image_name = "";
    }

    $foodName = $_POST['NameF'];
    $foodType = $_POST['FType'];
    $price = $_POST['PriceF'];
    $des = $_POST['DetailF'];
    $status = $_POST['status'];
    $image = $image_name;




    $sql2 = "INSERT INTO mon_an SET ID_LOAIMONAN=$foodType,TENMONAN='$foodName',GIATIEN=$price,CHITIETMONAN='$des',TRANGTHAI=$status,ANH='$image_name'";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {

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

            <h2>Thêm Món Ăn</h2>
        </div>

    </div>

    <!--The-->
    <?php
    if (isset($_SESSION['addF'])) {

    ?><div class="card--notificationF" style="display:block">
            <i class="fa-solid fa-x"></i>
            <?php echo $_SESSION['addF'];

            ?>
        </div><?php
                unset($_SESSION['addF']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên món ăn</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="NameF">
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

                                echo "<option value='" . $id_loai . "'>" . $ten_loai . "</option>";
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
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="PriceF">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Chi tiết món ăn</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="DetailF"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="1">
                    <label class="form-check-label" for="status">
                        Còn kinh doanh
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="0">
                    <label class="form-check-label" for="status">
                        Không còn kinh doanh
                    </label>

                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>

            <input type="submit" value="Thêm" name="Submit" class="btn btn-primary">

        </form>
    </div>


</div>


</body>

</html>