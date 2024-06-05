<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách máy bay</title>

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
        <h1>Quản lý danh sách máy bay</h1>
        <button onclick="window.location.href='add_aircraft.php'">Thêm</button>
        <br>

        <?php
        // include 'connect.php'; // Include your database connection

        // Select data from the Aircrafts table
        $sql = "SELECT * FROM Aircrafts";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Tên máy bay</th><th>ID hãng hàng không</th><th>Sức chứa</th><th>Trạng thái</th><th>Thao tác</th></tr>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["aircraft_name"] . "</td><td>" . $row["airline_id"] . "</td><td>" . $row["seating_capacity"] . "</td><td>" . $row["status"] . "</td>";
                echo "<td><a href='edit_aircraft.php?id=" . $row["id"] . "'>Sửa</a>";
                echo " | ";
                echo "<a href='../page_admin/control/delete_aircraft.php?id=" . $row["id"] . "'>Xóa</a></td></tr>";
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

