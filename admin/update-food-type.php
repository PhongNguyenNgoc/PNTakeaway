<?php
include('./callback/menu.php');

$id = $_GET['id'];

$sql = "SELECT * FROM loai_mon_an WHERE ID_LOAIMONAN='$id'";
$res = mysqli_query($conn, $sql);

if ($res == true) {

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Lay thong tin
        $rows = mysqli_fetch_assoc($res);

        $on = $rows['TENLOAI'];
    } else {

        header('location:' . SITEURL . 'admin/food-type.php');
    }
}

?>


<!--php cap nhat-->
<?php
if (isset($_POST['Submit'])) {

    $nfn = $_POST['nfn'];


    $sql1 = "UPDATE loai_mon_an SET TENLOAI='$nfn' WHERE ID_LOAIMONAN='$id'";
    $res1 = mysqli_query($conn, $sql1);

    if ($res1 == true) {

        $_SESSION["updateFT"] = "Cập nhật loại món thành công";

        header("location:" . SITEURL . 'admin/food-type.php');
    } else {

        $_SESSION["updateFT"] = "Cập nhật loại món thất bại";

        header("location:" . SITEURL . 'admin/food-type.php');
    }
}
?>


<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Cập nhật Loại Món Ăn</h2>
        </div>

    </div>

    <!--The-->
    <?php
    if (isset($_SESSION['updateFT'])) {

    ?><div class="card--notificationF" style="display:block">
            <i class="fa-solid fa-x"></i>
            <?php echo $_SESSION['updateFT'];

            ?>
        </div><?php
                unset($_SESSION['updateFT']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên loại món ăn</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nfn" value="<?php echo $on; ?>">
            </div>


            <input type="submit" value="Cập nhật" name="Submit" class="btn btn-primary">

        </form>
    </div>


</div>


</body>

</html>