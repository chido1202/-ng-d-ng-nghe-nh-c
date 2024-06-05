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
include('../page_admin/thanhben.php') 
?>


</head>
<body>
    <div id="wrapper_edit"><h1>Edit Booking</h1> <br>
    <?php
    // include 'connect.php'; // Bao gồm kết nối đến cơ sở dữ liệu

    // Kiểm tra nếu có tham số 'id' truyền vào
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Lấy thông tin đặt chỗ từ cơ sở dữ liệu
        $sql = "SELECT * FROM Booking WHERE id = $id";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["user_id"];
            $flight_id = $row["flight_id"];
            $ticket_classes_id = $row["titket_classes_id"];
            $booking_date = $row["booking_date"];
            $seat_number = $row["seat_code"];
            $total_price = $row["total_price"];
        } else {
            echo "Không tìm thấy đặt chỗ với ID: $id";
            exit;
        }
    } else {
        echo "Không có ID được cung cấp để chỉnh sửa";
        exit;
    }

    // Kiểm tra nếu form được gửi đi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST["user_id"];
        $flight_id = $_POST["flight_id"];
        $ticket_classes_id = $_POST["titket_classes_id"];
        $booking_date = $_POST["booking_date"];
        $seat_number = $_POST["seat_code"];
        $total_price = $_POST["total_price"];

        // Cập nhật thông tin đặt chỗ vào cơ sở dữ liệu
        $result = updateBooking($con, $id, $user_id, $flight_id, $ticket_classes_id, $booking_date, $seat_number, $total_price);

        if ($result) {
            echo "<div class='blue_notice'>Thông tin đặt chỗ đã được cập nhật thành công!</div>";
        } else {
            echo "<div class='red_notice'>Lỗi khi cập nhật thông tin đặt chỗ: </div>" . $con->error;
        }
    }

    // Hàm cập nhật thông tin đặt chỗ
    function updateBooking($con, $user_id, $flight_id, $titket_classes_id, $booking_date, $seat_number, $total_price, $id) {
        $sql = "UPDATE Booking SET user_id = ?, flight_id = ?, titket_classes_id = ?, booking_date = ?, seat_code = ?, total_price = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iiisisi", $user_id, $flight_id, $titket_classes_id, $booking_date, $seat_number, $total_price, $id);
        return $stmt->execute();
    }
    ?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=$id"; ?>">
        <div class="form-group">
            <label for="user_id">ID người dùng:</label> <br>
            <input class="input" type="text" name="user_id" value="<?php echo $user_id; ?>">
        </div>  
        <div class="form-group">
            <label for="flight_id">ID chuyến bay:</label> <br>
            <input class="input" type="text" name="flight_id" value="<?php echo $flight_id; ?>">
        </div>
        <div class="form-group">
            <label for="ticket_classes_id">ID hạng vé:</label> <br>
            <input class="input" type="text" name="titket_classes_id" value="<?php echo $ticket_classes_id; ?>">
        </div>
        <div class="form-group">
            <label for="booking_date">Ngày đặt chỗ:</label> <br>
            <input class="input" type="text" name="booking_date" value="<?php echo $booking_date; ?>">
        </div>
        <div class="form-group">
            <label for="seat_number">Số ghế:</label> <br>
            <input class="input" type="text" name="seat_code" value="<?php echo $seat_number; ?>">
        </div>
        <div class="form-group"> 
            <label for="total_price">Tổng giá:</label> <br>
            <input class="input" type="text" name="total_price" value="<?php echo $total_price; ?>">
        </div>
        <div class="form-group">
            <button type="submit">Cập nhật</button>
        </div>

    </form></div>
    
</body>
</html>
