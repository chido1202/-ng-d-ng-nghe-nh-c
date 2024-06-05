<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="/Main/css/booking.css">
    <link rel="stylesheet" href="./font/flaticon.css">
    <title>Tiến hành đặt vé</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">
</head>

</head>

<body>

<div class="main">
        <!-- header -->
        <div class="header">
            <div class="logo-header">
                <a href="#">
                    <img src="/image/logo.png" alt="">
                </a>
            </div>
            <div class="menu-right">
                <ul class="header-menu">
                    <li><a href="home_page.php" class="active">Trang chủ</a></li>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="login.php">Tài khoản</a></li>
                    <li><a href="cart.php">Vé của tôi</a></li>
                </ul>
            </div>
        </div>        
        <!-- header ends -->

<?php
session_start();

if(isset($_SESSION['username'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "airtiket_online";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['username'];

    $flight_query = "SELECT flights.departure_location, flights.arrival_location, flights.departure_time, flights.arrival_time, 
                            titketclasses.description AS ticket_class_description, booking.total_price
                     FROM booking
                     INNER JOIN flights ON booking.flight_id = flights.id
                     INNER JOIN titketclasses ON booking.titket_classes_id = titketclasses.id
                     WHERE booking.username = '$username'";

    $flight_result = $conn->query($flight_query);
    echo "<h2>Thông tin tuyến bay</h2>";    
    if ($flight_result->num_rows > 0) {
        while($row = $flight_result->fetch_assoc()) {
            echo "<div class='info_flight'>";
            echo "<p>Điểm khởi hành: " . $row['departure_location'] . "</p>";
            echo "<p>Điểm đến: " . $row['arrival_location'] . "</p>";
            echo "<p>Ngày khởi hành: " . $row['departure_time'] . "</p>";
            echo "<p>Giờ bay: " . $row['departure_time'] . " - " . $row['arrival_time'] . "</p>";
            echo "<p>Hạng vé: " . $row['ticket_class_description'] . "</p>";

            $total_passengers_query = "SELECT SUM(soluong_ve) AS total_passengers FROM booking WHERE username = '$username'";
            $total_passengers_result = $conn->query($total_passengers_query);
            if ($total_passengers_result->num_rows > 0) {
                $total_passengers_row = $total_passengers_result->fetch_assoc();
                echo "<p>Số lượng hành khách: " . $total_passengers_row['total_passengers'] . "</p>";
            }
            echo "<p>Tổng giá: " . $row['total_price'] . "</p>";
            echo "<button type=submit class='cancel'>Huỷ vé</button>";
            echo "</div>";
        }
    } else {
        echo "No booking found for this user.";
    }

    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
?>

    
</body>
