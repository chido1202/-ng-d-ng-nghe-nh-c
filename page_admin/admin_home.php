<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xin chào Admin!</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/page_admin/css/style_admin.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">

</head>

<?php
include('../db/connect.php');
?>

<?php
	session_start();
	if(!isset($_SESSION['dangnhap'])){
		header('Location: dangnhap_admin.php');
	} 
	if(isset($_GET['login'])){
 	$dangxuat = $_GET['login'];
	 }else{
	 	$dangxuat = '';
	 }
	 if($dangxuat=='dangxuat'){
	 	session_destroy();
	 	header('Location: /page_admin/dangnhap_admin.php');
	 }
?>

<body>
    <div class="top">
        <img src="../image/logo.png" alt="" class="logo_home">
        <p>Wellcome <?php echo $_SESSION['dangnhap']?>!</p>
        <div class="btn">
            <a href="?login=dangxuat">Đăng xuất</a>
        </div>
        <div class="home">
            <a href="admin_home.php"><i class="bi bi-house"></i> Trang chủ</a>
        </div>
    </div>

    <div id="wrapper_1">
        <div class="body_1">
             <a href="ql_airline.php"><h2>Hãng hàng không</h2></a>
        </div>

        <div class="body_2">
            <a href="ql_booking.php"><h2>Danh sách đặt vé</h2></a>
        </div>

        <div class="body_3">
                <a href="ql_aircraft.php"><h2>Máy bay</h2></a>
        </div>

    </div>

    <div id="wrapper_2">
        <div class="body_4">
            <a href="ql_flight.php"><h2>Danh sách tuyến bay</h2></a>
        </div>

        <div class="body_5">
            <a href="ql_client.php"><h2>Khách hàng</h2></a>
        </div>

        <div class="body_6">
            <a href=""><h2>Hạng vé</h2></a>
        </div>
    </div>

</body>
</html>

