<?php

include('./callback/menu.php');



?>
<!--Phan chinh-->
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Quản Lý Tài Khoản</h2>
        </div>
        <div class="user--info">
            <a href="./add-account.php"> <i class="fa-solid fa-plus"></i></a>

        </div>
    </div>

    <!--The thong bao-->

    <?php
    if (isset($_SESSION['add'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['add'];

            ?>
        </div><?php

                unset($_SESSION['add']);
            }
                ?>

    <?php
    if (isset($_SESSION['delete'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['delete'];

            ?>
        </div><?php

                unset($_SESSION['delete']);
            }
                ?>

    <?php
    if (isset($_SESSION['update'])) {

    ?><div class="card--notificationS" style="display:block">
            <i class="fa-solid fa-check"></i>
            <?php echo $_SESSION['update'];

            ?>
        </div><?php

                unset($_SESSION['update']);
            }
                ?>
    <!--Bang-->

    <div class="tabular--wrapper">

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tên người dùng</th>

                        <th>Họ và Tên</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>

                    </tr>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tai_khoan WHERE QUYEN=0";
                    $res = mysqli_query($conn, $sql);

                    if ($res == true) {
                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                //  $id = $rows['ID_TK'];
                                $un = $rows['TENNGUOIDUNG'];

                                $fn = $rows['HOVATEN'];
                                $p = $rows['SDT'];
                                $m = $rows['EMAIL'];
                                $addr = $rows['DIACHI'];

                    ?> <tr>
                                    <td><?php echo $un; ?></td>
                                    <td><?php echo $fn; ?></td>
                                    <td><?php echo $p; ?></td>
                                    <td><?php echo $m; ?></td>
                                    <td><?php echo $addr; ?></td>

                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-account.php?un=<?php echo $un; ?>"><i class="fa-solid fa-wrench"></i></a>
                                        &emsp;
                                        <a href="<?php echo SITEURL; ?>admin/delete-account.php?un=<?php echo $un; ?>"><i class="fa-solid fa-trash-can"></i></a>
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