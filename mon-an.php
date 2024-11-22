<?php
include('./callbackU/menuU.php');

?>

<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm món ăn cụ thể" required>
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>

    </div>
</section>
<br>
<div class="container py5">
    <h3 class="text-center">Món ăn tại PN Takeaway</h3>
    <div class="row row-cols-1 row-cols-md-4 g-4 py-5">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="./img/user/ex.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tên món ăn</h5>
                    <p class="card-text">Chi tiết món ăn</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <h5>100 000d</h5>
                    <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="./img/user/ex.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tên món ăn</h5>
                    <p class="card-text">Chi tiết món ăn</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <h5>100</h5>
                    <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="./img/user/ex.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tên món ăn</h5>
                    <p class="card-text">Chi tiết món ăn</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <h5>100</h5>
                    <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="./img/user/ex.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tên món ăn</h5>
                    <p class="card-text">Chi tiết món ăn</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <h5>100</h5>
                    <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="./img/user/ex.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tên món ăn</h5>
                    <p class="card-text">Chi tiết món ăn</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <h5>100</h5>
                    <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="./img/user/ex.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tên món ăn</h5>
                    <p class="card-text">Chi tiết món ăn</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <h5>100</h5>
                    <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="./img/user/ex.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tên món ăn</h5>
                    <p class="card-text">Chi tiết món ăn</p>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <h5>100</h5>
                    <button class="btn btn-primary"><a href="#">Thêm vào giỏ hàng</a></button>
                </div>
            </div>
        </div>


    </div>
</div>






<!--Chan trang web-->
<?php
include('./callbackU/footerU.php');
?>