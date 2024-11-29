<?php
if (isset($_GET['address'])) {
    // Lấy đoạn text từ form
    $searchText = $_GET['address'];

    // Chuyển đổi đoạn text thành URL phù hợp với Google Maps
    $searchUrl = "https://www.google.com/maps/search/" . urlencode($searchText);

    // Redirect đến Google Maps
    header("Location: $searchUrl");
    exit();
}
