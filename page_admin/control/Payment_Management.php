<!DOCTYPE html>
<html>
<head>
    <title>Quản lý thanh toán</title>
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
    <h1>Quản lý thanh toán</h1>
    <button onclick="window.location.href='add_payment.php'">Thêm</button>
    <?php
    include 'connect.php'; // Kết nối đến cơ sở dữ liệu

    // Lấy dữ liệu từ bảng Payment
    $sql = "SELECT * FROM Payment";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID thanh toán</th><th>ID đặt chỗ</th><th>Ngày thanh toán</th><th>Số tiền thanh toán</th><th>Thao tác</th></tr>";
        // Xuất dữ liệu từng hàng
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["booking_id"] . "</td><td>" . $row["payment_date"] . "</td><td>" . $row["payment_amount"] . "</td>";
            echo "<td><a href='edit_payment.php?id=" . $row["id"] . "'>Sửa</a> | <a href='delete_payment.php?id=" . $row["id"] . "'>Xóa</a></td></tr>";
        }
    }
    ?>
</body>
</html>
