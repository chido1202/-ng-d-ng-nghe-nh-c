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
    <div id="wrapper_add">
        <h1>Add New Booking</h1><br>
        
        <?php
        // include 'connect.php'; // Include your database connection

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql = "SELECT MAX(id) AS max_id FROM Booking";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['max_id'] + 1;

            $user_id = $_POST["user_id"];
            $flight_id = $_POST["flight_id"];
            $ticket_classes_id = $_POST["titket_classes_id"];
            $booking_date = $_POST["booking_date"];
            $seat_number = $_POST["seat_code"];
            $total_price = $_POST["total_price"];

            // Add booking information to the database
            $result = addBooking($con, $id, $user_id, $flight_id, $ticket_classes_id, $booking_date, $seat_number, $total_price);

            if ($result) {
                $sql = "UPDATE flights SET available_seats = available_seats - 1 WHERE id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $flight_id);
                $stmt->execute();
                echo "<div class='blue_notice'>Thêm thành công!</div>";
            } else {
                echo "<div class='red_notice'>Lỗi</div>: " . $con->error;
            }
        }
        

        // Function to add booking information
        function addBooking($con,$id, $user_id, $flight_id, $ticket_classes_id, $booking_date, $seat_number, $total_price) {
            $sql = "INSERT INTO Booking (id, user_id, flight_id, titket_classes_id, booking_date, seat_code, total_price) VALUES (? ,?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iiiisss",$id, $user_id, $flight_id, $ticket_classes_id, $booking_date, $seat_number, $total_price);
            return $stmt->execute();
        }


        ?>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="user_id">User ID:</label><br>
                <input class="input" type="text" name="user_id" required>
            </div>
            <div class="form-group">
                <label for="flight_id">Flight ID:</label><br>
                <input class="input" type="text" name="flight_id" required>
            </div>
            <div class="form-group">
                <label for="ticket_classes_id">Ticket Class ID:</label><br>
                <input class="input" type="text" name="titket_classes_id" required>
            </div>
            <div class="form-group">
                <label for="booking_date">Booking Date:</label><br>
                <input class="input" type="text" name="booking_date" required>
            </div>
            <div class="form-group">
                <label for="seat_number">Seat Number:</label><br>
                <input class="input" type="text" name="seat_code" required>
            </div>
            <div class="form-group">
                <label for="total_price">Total Price:</label><br>
                <input class="input" type="text" name="total_price" required>
            </div>
            <div class="form-group">
                <button type="submit">Add</button>
            </div>
        </form>

    </div>
    
</body>
</html>



