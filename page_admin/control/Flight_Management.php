
<!DOCTYPE html>
<html>
<head>
    <title>Flight Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f0f0f0;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Flight Management</h1>
    <button onclick="window.location.href='add_flight.php'">Thêm</button>
    <?php
    include 'connect.php'; // Include your database connection

    // Select data from the Flights table
    $sql = "SELECT * FROM Flights";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID máy bay</th><th>Số hiệu chuyến bay</th><th>Địa điểm khởi hành</th><th>Địa điểm đến</th><th>Ngày xuất phát</th><th>Thời gian khởi hành</th><th>Thời gian đến</th><th>Số ghế trống</th><th>Thao tác</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["aircrafts_id"] . "</td><td>" . $row["flight_number"] . "</td><td>" . $row["departure_location"] . "</td><td>" . $row["arrival_location"] . "</td><td>" .$row["departure_date"]. "</td><td>" .$row["departure_time"] . "</td><td>" . $row["arrival_time"] . "</td><td>" . $row["available_seats"] . "</td>";
            echo "<td><a href='edit_flight.php?id=" . $row["id"] . "'>Sửa</a> | <a href='delete_flight.php?id=" . $row["id"] . "'>Xóa</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có chuyến bay nào.";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>

