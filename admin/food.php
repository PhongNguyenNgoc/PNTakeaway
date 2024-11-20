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
    if (isset($_SESSION['add'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['addF'];

            ?>
        </div><?php

                unset($_SESSION['addF']);
            }
                ?>

    <?php
    if (isset($_SESSION['deleteFT'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['deleteFT'];

            ?>
        </div><?php

                unset($_SESSION['deleteFT']);
            }
                ?>

    <?php
    if (isset($_SESSION['updateFT'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['updateFT'];

            ?>
        </div><?php

                unset($_SESSION['updateFT']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>

                        <th>Tên Loại</th>

                        <th>Thao tác</th>

                    </tr>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM  loai_mon_an";
                    $res = mysqli_query($conn, $sql);
                    $stt = 1;

                    if ($res == true) {
                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $id = $rows['ID_LOAIMONAN'];
                                $n = $rows['TENLOAI'];


                    ?> <tr>
                                    <td><?php echo $stt; ?></td>
                                    <td><?php echo $n; ?></td>


                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food-type.php?id=<?php echo $id; ?>"><i class="fa-solid fa-wrench"></i></a>
                                        &emsp;
                                        <a href="<?php echo SITEURL; ?>admin/delete-food-type.php?id=<?php echo $id; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr><?php
                                        $stt++;
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