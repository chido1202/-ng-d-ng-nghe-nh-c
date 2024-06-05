<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các tuyến bay</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/page_admin/css/style_admin.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Faustina:ital,wght@0,300..800;1,300..800&family=Honk&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">

</head>

<?php
include('../page_admin/thanhben.php') 
?>

</head>
<body> 

    <div id="wrapper">
        <h1>Danh sách các tuyến bay</h1>
        <button onclick="window.location.href='add_flight.php'">Thêm</button>
        <br><br><br><br>
        <?php
        // include 'connect.php'; // Include your database connection

        // Select data from the Flights table
        $sql = "SELECT * FROM Flights";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID máy bay</th><th>Số hiệu chuyến bay</th><th>Địa điểm khởi hành</th><th>Địa điểm đến</th><th>Ngày xuất phát</th><th>Thời gian khởi hành</th><th>Thời gian đến</th><th>Số ghế trống</th><th>Thao tác</th></tr>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["aircrafts_id"] . "</td><td>" . $row["flight_number"] . "</td><td>" . $row["departure_location"] . "</td><td>" . $row["arrival_location"] . "</td><td>" .$row["departure_date"]. "</td><td>" .$row["departure_time"] . "</td><td>" . $row["arrival_time"] . "</td><td>" . $row["available_seats"] . "</td>";
                echo "<td><a href='../page_admin/edit_flight.php?id=" . $row["id"] . "'>Sửa</a> | <a href='delete_flight.php?id=" . $row["id"] . "'>Xóa</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "Không có chuyến bay nào.";
        }

        // Đóng kết nối
        $con->close();
        ?>
    </div>
        
</body>
</html>

