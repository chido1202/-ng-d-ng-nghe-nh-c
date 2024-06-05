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
    <div id="wrapper_edit">
        <h1>Chỉnh sửa tuyến bay</h1><br>
        <?php
        // include 'connect.php'; // Include your database connection

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $aircrafts_id = $_POST["aircrafts_id"];
            $flight_number = $_POST["flight_number"];
            $departure_location = $_POST["departure_location"];
            $arrival_location = $_POST["arrival_location"];
            $departure_time = $_POST["departure_time"];
            $arrival_time = $_POST["arrival_time"];
            $available_seats = $_POST["available_seats"];

            // Edit record in database
            $result = editRecord($con, $id, $aircrafts_id, $flight_number, $departure_location, $arrival_location, $departure_time, $arrival_time, $available_seats);

            if ($result) {
                header('Location: ../page_admin/ql_flight.php');
            } else {
                echo "Error editing record: " . $con->error;
            }
        } else {
            $id = $_GET["id"];
            // Select data from the Flights table
            $sql = "SELECT * FROM Flights WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        }

        // Function to edit a record
        function editRecord($con, $id, $aircrafts_id, $flight_number, $departure_location, $arrival_location, $departure_time, $arrival_time, $available_seats) {
            $sql = "UPDATE Flights SET aircrafts_id = ?, flight_number = ?, departure_location = ?, arrival_location = ?, departure_time = ?, arrival_time = ?, available_seats = ? WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("isssssii", $aircrafts_id, $flight_number, $departure_location, $arrival_location, $departure_time, $arrival_time, $available_seats, $id);
            return $stmt->execute();
        }
        ?>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"><br><br><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="aircrafts_id">ID máy bay:</label><br>
                <input class="input" type="text" id="aircrafts_id" name="aircrafts_id" value="<?php echo $row['aircrafts_id']; ?>">
            </div>
            <div class="form-group">
                <label for="flight_number">Số hiệu chuyến bay:</label><br>
                <input class="input" type="text" id="flight_number" name="flight_number" value="<?php echo $row['flight_number']; ?>">
            </div>
            <div class="form-group">
                <label for="departure_location">Địa điểm khởi hành:</label><br>
                <input class="input" type="text" id="departure_location" name="departure_location" value="<?php echo $row['departure_location']; ?>">
            </div>
            <div class="form-group">
                <label for="arrival_location">Địa điểm đến:</label><br>
                <input class="input" type="text" id="arrival_location" name="arrival_location" value="<?php echo $row['arrival_location']; ?>">
            </div>
            <div class="form-group">
                <label for="departure_time">Thời gian khởi hành:</label><br>
                <input class="input" type="text" id="departure_time" name="departure_time" value="<?php echo $row['departure_time']; ?>">
            </div>
            <div class="form-group">
                <label for="arrival_time">Thời gian đến:</label><br>
                <input class="input" type="text" id="arrival_time" name="arrival_time" value="<?php echo $row['arrival_time']; ?>">
            </div>
            <div class="form-group">
                <label for="available_seats">Số ghế trống:</label><br>
                <input class="input" type="number" id="available_seats" name="available_seats" value="<?php echo $row['available_seats']; ?>">
            </div>
            <div class="form-group">
                <button type="submit">Cập nhật</button>
            </div>

        </form>
    </div>
    
</body>
</html>
