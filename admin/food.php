<?php

include('./callback/menu.php');



?>
<!--Phan chinh-->
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Quản Lý Thức Ăn</h2>
        </div>
        <div class="user--info">
            <a href="./add-food.php"> <i class="fa-solid fa-plus"></i></a>

        </div>
    </div>

    <!--The thong bao-->

    <?php
    if (isset($_SESSION['addF'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['addF'];

            ?>
        </div><?php

                unset($_SESSION['addF']);
            }
                ?>

    <?php
    if (isset($_SESSION['deleteF'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['deleteF'];

            ?>
        </div><?php

                unset($_SESSION['deleteF']);
            }
                ?>

    <?php
    if (isset($_SESSION['updateF'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['updateF'];

            ?>
        </div><?php

                unset($_SESSION['updateF']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên Món Ăn</th>
                        <th>Chi tiết món ăn</th>
                        <th>Loại món ăn</th>
                        <th>Giá Tiền</th>
                        <th>Trạng thái</th>



                        <th>Thao tác</th>


                    </tr>
                <tbody>
                    <?php
                    $sql = "SELECT LOAI_MON_AN.ID_LOAIMONAN,MON_AN.ID_MONAN,LOAI_MON_AN.TENLOAI AS TENLOAI,MON_AN.TENMONAN,MON_AN.GIATIEN,MON_AN.CHITIETMONAN,MON_AN.TRANGTHAI,MON_AN.ANH FROM MON_AN INNER JOIN LOAI_MON_AN ON MON_AN.ID_LOAIMONAN = LOAI_MON_AN.ID_LOAIMONAN;";
                    $res = mysqli_query($conn, $sql);


                    if ($res == true) {
                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {

                                $idMon = $rows['ID_MONAN'];

                                $img = $rows['ANH'];
                                $nameF = $rows['TENMONAN'];
                                $detailF = $rows['CHITIETMONAN'];
                                $typeF = $rows['TENLOAI'];
                                $price = $rows['GIATIEN'];
                                //$status = $rows['TRANGTHAI'];

                                if ($rows['TRANGTHAI'] == 1) {
                                    $status = "Còn kinh doanh";
                                } else {
                                    $status = "Không còn king doanh";
                                }


                    ?> <tr>



                                    <td> <?php
                                            if ($img != "") {
                                                echo "<img src='" . SITEURL . "img/food/" . $img . "'width='75' height='75' alt='Không có ảnh'>";
                                            } elseif ($img == "") {
                                                echo "<td>Không có ảnh</td>";
                                            }
                                            ?></td>
                                    <td><?php echo $nameF; ?></td>
                                    <td><?php echo $detailF; ?></td>
                                    <td><?php echo $typeF; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $status; ?></td>


                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $idMon; ?>&image_name=<?php echo $img; ?>"><i class="fa-solid fa-wrench"></i></a>
                                        &emsp;
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $idMon; ?>&image_name=<?php echo $img; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr><?php

                                    }
                                }
                            }
                                        ?>

                </tbody>

                </thead>
            </table>
        </div>
    </div>


</div>
</body>

</html>