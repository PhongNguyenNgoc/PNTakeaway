<?php
//Tao session


//Tao hang de luu tru cac gia tri lap lai
define('SITEURL', 'http://localhost:8080/PNTakeaway/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pnt');
//thuc thi sql len db
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));;
session_start();
