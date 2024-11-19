<?php
include("constants.php");

if (isset($_POST['submit'])) {
    $un = $_POST['u'];
    $pass = md5($_POST['p']);

    $sql = "INSERT INTO tai_khoan SET TENNGUOIDUNG='$un', MATKHAU='$pass',QUYEN=1";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "Thêm admin thành công";
    } else {
        echo "Thêm admin thất bại";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Xóa file này sau khi hoàn tất</title>
</head>

<body>
    <form action="" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên đăng nhập</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="admin" name="u">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
            <input type="Password" class="form-control" id="exampleFormControlInput1" value="admin" name="p">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="submit">Tạo TK</button>
        </div>

    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>