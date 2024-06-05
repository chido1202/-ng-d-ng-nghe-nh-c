<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đặt vé</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/page_admin/css/style_admin.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Faustina:ital,wght@0,300..800;1,300..800&family=Honk&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">

</head>

<?php
include('../page_admin/thanhben.php');
?>

<body>
    <div id="wrapper">
        <h1>Danh sách khách hàng đặt vé</h1>
        <button onclick="window.location.href='add_booking.php'">Thêm</button>
        <br>
        <?php
            //  include 'connect.php'; // Include your database connection

            // Select data from the Bookings table
            $sql = "SELECT b.id, CONCAT(u.last_name, ' ', u.first_name) AS customer_name, b.flight_id, b.titket_classes_id, b.booking_date, b.seat_code, b.total_price
                    FROM Booking AS b
                    JOIN user AS u ON b.user_id = u.id";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Số TT</th><th>Tên</th><th>Tuyến bay</th><th>Loại vé</th><th>Ngày khởi hành</th><th>Giờ bay</th><th>Chi phí</th><th>Thao tác</th></tr>";
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["customer_name"] . "</td><td>" . $row["flight_id"] . "</td><td>" . $row["titket_classes_id"] . "</td><td>" . $row["booking_date"] . "</td><td>" . $row["seat_code"] . "</td><td>" . $row["total_price"] . "</td>";
                    echo "<td><a href='edit_booking.php?id=" . $row["id"] . "'>Sửa</a>";
                    echo " | ";
                    echo "<a href='../page_admin/delete_booking.php?id=" . $row["id"] . "'>Xóa</a></td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }

            $con->close();
        ?>
    </div>
</body>
</html>