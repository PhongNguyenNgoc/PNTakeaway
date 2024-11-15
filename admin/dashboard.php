<?php
include('./callback/menu.php');
?>
<!--Phan chinh-->
<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">

            <h2>Tổng Quan</h2>
        </div>
        <div class="user--info">

            <img src="../img/admin/admin.jpg" alt="">
        </div>
    </div>

    <!--The-->
    <div class="card--container">
        <h3 class="main--title">Today data</h3>

        <div class="card--wrapper">
            <div class="payment--card light-red">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Payment Amount</span>
                        <span class="amount--value">100.00đ</span>
                    </div>
                    <i class="fas fa-dollar-sign icon"></i>
                </div>

            </div>

            <div class="payment--card light-purple">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Payment Order</span>
                        <span class="amount--value">100.00đ</span>
                    </div>
                    <i class="fas fa-list icon dark-purple"></i>
                </div>

            </div>

            <div class="payment--card light-green">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Payment Amount</span>
                        <span class="amount--value">100.00đ</span>
                    </div>
                    <i class="fas fa-users icon dark-green"></i>
                </div>

            </div>

            <div class="payment--card light-blue">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Payment Process</span>
                        <span class="amount--value">100.00đ</span>
                    </div>
                    <i class="fas fa-solid fa-check icon dark-blue"></i>
                </div>
            </div>
        </div>

    </div>
    <!--Bang-->

    <div class="tabular--wrapper">
        <h3 class="main--title">Finance Data</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Ngày</th>
                        <th>Loại thanh toán</th>
                        <th>Chi tiết</th>
                        <th>Số lượng</th>
                        <th>Loại</th>
                        <th>Chủng loại</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                <tbody>
                    <tr>
                        <td>2024</td>
                        <td>VISA **** **** **** 2457</td>
                        <td>Hàng tồn kho</td>
                        <td>100</td>
                        <td>Giày</td>
                        <td>Mới 99%</td>
                        <td>2024</td>
                        <td><button>DElete</button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">Tổng giá trị: ****đ</td>
                    </tr>
                </tfoot>
                </thead>
            </table>
        </div>
    </div>


</div>
</body>

</html>