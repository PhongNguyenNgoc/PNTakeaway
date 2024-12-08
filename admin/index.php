<?php
include('./callback/menu.php');

$sqlTongTN = "SELECT SUM(TONGGTDONHANG) AS TONG_THU_NHAP FROM DON_HANG ";
$resTongTN = mysqli_query($conn, $sqlTongTN);
$rowTongTN = mysqli_fetch_assoc($resTongTN);
$tongTN = $rowTongTN['TONG_THU_NHAP'];

$sqlTongM = "SELECT COUNT(*) AS SO_LUONG_MON_AN FROM MON_AN;";
$resTongM = mysqli_query($conn, $sqlTongM);
$rowTongM = mysqli_fetch_assoc($resTongM);
$tongM = $rowTongM['SO_LUONG_MON_AN'];

$sqlTongK = "SELECT COUNT(*) AS SO_LUONG_KHACH_HANG FROM TAI_KHOAN WHERE QUYEN=0;";
$resTongK = mysqli_query($conn, $sqlTongK);
$rowTongK = mysqli_fetch_assoc($resTongK);
$tongK = $rowTongK['SO_LUONG_KHACH_HANG'];

$sqlTongD = "SELECT COUNT(*) AS DON_DA_GIAO FROM DON_HANG WHERE TRANGTHAI=3;";
$resTongD = mysqli_query($conn, $sqlTongD);
$rowTongD = mysqli_fetch_assoc($resTongD);
$tongD = $rowTongD['DON_DA_GIAO'];




?>
<!--Phan chinh-->
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Tổng Quan</h2>
        </div>
        <!-- <div class="user--info">

            <img src="../img/admin/admin.jpg" alt="">
        </div> -->
    </div>

    <!--The-->
    <div class="card--container">


        <div class="card--wrapper">
            <div class="payment--card light-red">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Tổng thu nhập</span>
                        <span class="amount--value"><?php echo number_format($tongTN); ?>đ</span>
                    </div>

                    <i class="fas fa-dollar-sign icon"></i>

                </div>

            </div>

            <div class="payment--card light-purple">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Số món ăn</span>
                        <span class="amount--value"><?php echo $tongM; ?></span>
                    </div>
                    <i class="fas fa-solid fa-bowl-food icon"></i>
                </div>

            </div>

            <div class="payment--card light-green">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Số khách hàng</span>
                        <span class="amount--value"><?php echo $tongK; ?></span>
                    </div>
                    <i class="fas fa-users icon dark-green"></i>
                </div>

            </div>

            <div class="payment--card light-blue">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Số đơn hàng giao thành công</span>
                        <span class="amount--value"><?php echo $tongD; ?></span>
                    </div>
                    <i class="fas fa-solid fa-check icon dark-blue"></i>
                </div>
            </div>
        </div>

    </div>





</div>
</body>

</html>