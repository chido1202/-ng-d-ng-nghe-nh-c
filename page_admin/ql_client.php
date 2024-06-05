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
include('../page_admin/thanhben.php');
?>


<body>
    <div id="wrapper">
        <h1>Danh sách khách hàng</h1>
        
        <br>
        <?php
            // include 'connect.php';
            // // Truy vấn dữ liệu từ bảng user với role_id = 3
            $sql = "SELECT * FROM user WHERE role_id = 3";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Họ và tên</th><th>Ngày sinh</th><th>Số điện thoại</th><th>Email</th><th>Tên đăng nhập</th><th>Mật khẩu</th><th>Thao tác</th></tr>";
                // Hiển thị dữ liệu từng hàng
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["first_name"] . " " . $row["last_name"] . "</td><td>" . $row["date_of_birth"] . "</td><td>" . $row["number_phone"] . "</td><td>" . $row["email"] . "</td><td>" . $row["username"] . "</td><td>" . $row["password"] . "</td>";
                    echo "<td><a href='edit_client.php?id=" . $row["id"] . "'>Sửa</a>";
                    echo " | ";
                    echo "<a href='../page_admin/delete_client.php?id=" . $row["id"] . "'>Xóa</a></td></tr>";
                }
                echo "</table>";
            } else {
                echo "Không có người dùng nào có role_id = 3.";
            }

            $con->close();
        ?>
    </div>
</body>
</html>
