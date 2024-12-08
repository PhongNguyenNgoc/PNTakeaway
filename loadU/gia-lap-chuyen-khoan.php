<?php include('/xampp/htdocs/PNTakeaway/admin/conn/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng thanh toán trực tuyến</title>
    <script src="https://kit.fontawesome.com/2109c0989e.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            width: 30px;
        }

        .header h2 {
            font-size: 18px;
            margin: 0;
        }

        .info {
            margin: 20px 0;
        }

        .info label {
            font-weight: bold;
        }

        .info p {
            margin: 5px 0 15px;
            color: #555;
        }

        .qr-code {
            text-align: center;
            margin: 20px 0;
        }

        .qr-code img {
            width: 400px;
            height: 400px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .total {
            font-size: 18px;
            font-weight: bold;

            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="<?php echo SITEURL . "loadU/xu-ly-thanh-toan.php"; ?>"><i class="fa-solid fa-credit-card"></i></a>


        </div>
        <h2>Chuyển Khoản Ngân hàng</h2>


        <div class="info">
            <label>Người nhận:</label>
            <p>Nguyễn Văn A</p>
            <label>Số tài khoản:</label>
            <p>**********1234</p>
            <label>Ngân hàng thụ hưởng:</label>
            <p>A bank</p>

            <div class="total">
                Tổng cộng : <?php echo number_format($_SESSION['tp']); ?> đ
            </div>
        </div>



        <div class="qr-code">
            <p>Mã QR sẽ hết hạn trong:
            <div id="countdown"></div>

            </p>
            <img src="../img/admin/qr.svg" alt="QR Code">
        </div>


    </div>
</body>

</html>

<script>
    // Thời gian đếm ngược (1 phút = 60 giây)
    let countdownTime = 180;

    function startCountdown() {
        const countdownElement = document.getElementById("countdown");

        const interval = setInterval(() => {
            // Tính số phút và giây còn lại
            const minutes = Math.floor(countdownTime / 60);
            const seconds = countdownTime % 60;

            // Hiển thị thời gian còn lại
            countdownElement.textContent = `${minutes} phút ${seconds} giây`;

            if (countdownTime <= 0) {
                clearInterval(interval);
                window.location.href = "../gio-hang.php";
            } else {
                countdownTime--;
            }
        }, 1000); // Lặp lại mỗi giây
    }

    window.onload = startCountdown;
</script>