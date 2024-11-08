<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style-login.css">
    <title>Tạo tài khoản mới</title>
</head>

<body>

    <div class="container-fluid">
        <form class="mx-auto">
            <h4 class="text-center">Tạo tài khoản</h4>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="exampleInputEmail1">

            </div>

            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="exampleInputEmail1" pattern="[0-9]{10}">

            </div>
            <div class=" mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
                <input type="email" class="form-control" id="exampleInputEmail1">

            </div>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="exampleInputEmail1">

            </div>
            <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="exampleInputEmail1">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1">

                <br>
                <div>Đã có taì khoản? <a href="./dang-nhap.php">Đăng nhập ngay</a></div>
            </div>

            <button type="submit" class="btn btn-primary">Tạo tài khoản mới</button>
        </form>
    </div>
</body>

</html>