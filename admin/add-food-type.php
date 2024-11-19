<?php
include('./callback/menu.php');
if (isset($_POST['Submit'])) {

    $nFT = $_POST['NameFT'];


    $sql = "INSERT INTO loai_mon_an SET TENLOAI='$nFT'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $_SESSION["addFT"] = "Thêm loại món thành công";

        header("location:" . SITEURL . 'admin/food-type.php');
    } else {

        $_SESSION["addFT"] = "Thêm người dùng thất bại";
    }
}
?>


<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Thêm Loại Món Ăn</h2>
        </div>

    </div>

    <!--The-->
    <?php
    if (isset($_SESSION['addFT'])) {

    ?><div class="card--notificationF" style="display:block">
            <i class="fa-solid fa-x"></i>
            <?php echo $_SESSION['addFT'];

            ?>
        </div><?php
                unset($_SESSION['addFT']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên loại món ăn</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="NameFT">
            </div>

            <input type="submit" value="Thêm" name="Submit" class="btn btn-primary">

        </form>
    </div>


</div>


</body>

</html>