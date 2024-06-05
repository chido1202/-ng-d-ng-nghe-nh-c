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
include('../page_admin/thanhben.php');
?>

<body>
    <div id="wrapper_edit">

        <h1>Chỉnh sửa người dùng</h1> <br><br>
        <?php
            // include 'connect.ph'; // Bao gồm kết nối đến cơ sở dữ liệu

            // Kiểm tra nếu có tham số 'id' truyền vào
            if (isset($_GET["id"])) {
                $id = $_GET["id"];

                // Lấy thông tin người dùng từ cơ sở dữ liệu
                $sql = "SELECT * FROM user WHERE id = $id";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    // Add other fields as needed
                } else {
                    echo "Không tìm thấy người dùng với ID: $id";
                    exit;
                }
            } else {
                echo "Không có ID được cung cấp để chỉnh sửa";
                exit;
            }

            // Kiểm tra nếu form được gửi đi
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                // Add other fields as needed

                // Cập nhật thông tin người dùng vào cơ sở dữ liệu
                $result = updateUser($con, $id, $first_name, $last_name);
                // Add other fields as needed

                if ($result) {
                    echo "<div class='blue_notice'>Thông tin người dùng đã được cập nhật thành công!</div>";
                } else {
                    echo "<div class='red_notice'>Lỗi khi cập nhật thông tin người dùng: </div>" . $con->error;
                }
            }

            // Hàm cập nhật thông tin người dùng
            function updateUser($con, $id, $first_name, $last_name) {
                $sql = "UPDATE user SET first_name = ?, last_name = ? WHERE id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssi", $first_name, $last_name, $id);
                return $stmt->execute();
            }
        ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=$id"; ?>">
            <div class="form-group">
                <label for="first_name">Họ và tên đệm:</label> <br>
                <input type="text" class="input" name="first_name" value="<?php echo $first_name; ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Tên:</label> <br>
                <input type="text" class="input" name="last_name" value="<?php echo $last_name; ?>">
            </div>
            <!-- Add other input fields for other user information -->
            <div class="form-group">
                <button type="submit">Cập nhật người dùng</button>
            </div>

        </form>

    </div>

</body>
</html>
