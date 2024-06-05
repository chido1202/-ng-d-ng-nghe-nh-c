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
    <h1>Chỉnh sửa Hãng Hàng Không</h1>
    <?php
        // include 'connect.ph'; // Bao gồm kết nối đến cơ sở dữ liệu

        // Kiểm tra nếu có tham số 'id' truyền vào
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            // Lấy thông tin hãng hàng không từ cơ sở dữ liệu
            $sql = "SELECT * FROM Airlines WHERE id = $id";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $airline_name = $row["airline_name"];
                $contact_info = $row["contact_info"];
            } else {
                echo "Không tìm thấy hãng hàng không với ID: $id";
                exit;
            }
        } else {
            echo "Không có ID được cung cấp để chỉnh sửa";
            exit;
        }

        // Kiểm tra nếu form được gửi đi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $airline_name = $_POST["airline_name"];
            $contact_info = $_POST["contact_info"];

            // Cập nhật thông tin hãng vào cơ sở dữ liệu
            $result = updateAirline($conn, $id, $airline_name, $contact_info);

            if ($result) {
                echo "Thông tin hãng đã được cập nhật thành công";
            } else {
                echo "Lỗi khi cập nhật thông tin hãng: " . $conn->error;
            }
        }

        // Hàm cập nhật thông tin hãng
        function updateAirline($con, $id, $airline_name, $contact_info) {
            $sql = "UPDATE Airlines SET airline_name = ?, contact_info = ? WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssi", $airline_name, $contact_info, $id);
            return $stmt->execute();
        }
    ?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=$id"; ?>">
        <div class="form-group">
            <label for="airline_name">Tên hãng:</label>
            <input type="text" id="airline_name" name="airline_name" value="<?php echo $airline_name; ?>">
        </div>
        <div class="form-group">
            <label for="contact_info">Thông tin liên hệ:</label>
            <input type="text" id="contact_info" name="contact_info" value="<?php echo $contact_info; ?>">
        </div>
        <button type="submit">Cập nhật hãng</button>
    </form>
</body>
</html>

