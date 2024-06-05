<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hãng hàng không</title>

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

<body>
    <div id="wrapper">
        <h1>Danh sách hãng hàng không</h1>
        <button onclick="window.location.href='../page_admin/add_airline.php'">Thêm</button>
        <br>
        <?php
            // Create connection
            $con = new mysqli("localhost", "root", "", "airtiket_online");

            // Check connection
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            // Select data from the Airlines table
            $sql = "SELECT * FROM Airlines";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>TÊN</th><th>MÔ TẢ</th><th>THAO TÁC</th></tr>"; // Add more columns as needed
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td >" . $row["id"] . "</td><td>" . $row["airline_name"] . "</td><td><a href='" . $row["contact_info"] . "'>" . $row["contact_info"] . "</a></td>";
                    echo "<td><a href='../page_admin/edit_airline.php?id=" . $row["id"] . "'>Sửa</a>";
                    echo " | ";
                    echo "<a href='../page_admin/control/delete_airline.php?id=" . $row["id"] . "'>Xóa</a></td></tr>";
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