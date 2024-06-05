<link rel="stylesheet" href="/page_admin/css/style_admin.css">

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

<div id="wrapper_thanhben">
    <div class="info">
        <img src="../image/logo.png" alt="" class="logo">
        <label><?php echo $_SESSION['dangnhap']?></label>
    </div>

    <div class="homepage">
        <a href="/page_admin/admin_home.php"><i class="bi bi-house"></i> Trang chủ</a>
    </div>

    <div class="list_menu">
        <ul>
            <li>
                <a href="ql_airline.php"><i class="bi bi-send-fill"></i> Hãng hàng không</a>
            </li>

            <li>
                <a href="ql_booking.php"><i class="bi bi-journal-check"></i> Danh sách đặt vé</a>
            </li>

            <li>
                <a href="ql_aircraft.php"><i class="bi bi-airplane"></i> Danh sách máy bay</a>
            </li>

            <li>
                <a href="ql_flight.php"><i class="bi bi-list-stars"></i> Danh sách tuyến bay</a>
            </li>

            <li>
                <a href="ql_client.php"><i class="bi bi-people-fill"></i> Khách hàng</a>
            </li>

            <li>
                <a href=""><i class="bi bi-ticket-perforated"></i> Hạng vé</a>
            </li>

        </ul>
    </div>


    <div class="logout">
        <a href="?login=dangxuat"><i class="bi bi-box-arrow-left"></i> Đăng xuất</a>
    </div>

</div>
