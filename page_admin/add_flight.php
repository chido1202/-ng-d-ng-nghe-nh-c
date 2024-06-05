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
    <div id="wrapper_add">
        <h1>Thêm tuyến bay mới</h1><br>
        
        <?php
        // include 'connect.php'; // Include your database connection

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql = "SELECT MAX(id) AS max_id FROM Flights";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['max_id'] + 1;

            $aircrafts_id = $_POST["aircrafts_id"];
            $flight_number = $_POST["flight_number"];
            $departure_location = $_POST["departure_location"];
            $arrival_location = $_POST["arrival_location"];
            $departure_date = $_POST["departure_date"];
            $departure_time = $_POST["departure_time"];
            $arrival_time = $_POST["arrival_time"];
            $available_seats = $_POST["available_seats"];

            // Add record to database
            $result = addRecord($con, $id, $aircrafts_id, $flight_number, $departure_location, $arrival_location, $departure_date, $departure_time, $arrival_time, $available_seats);

            if ($result) {
                echo "<div class='blue_notice'>Thêm thành công</div>";
            } else {
                echo "<div class='red_notice'>Lỗi khi thêm</div>" . $con->error;
            }
        }

        // Function to add a record
        function addRecord($con, $id, $aircrafts_id, $flight_number, $departure_location, $arrival_location, $departure_date, $departure_time, $arrival_time, $available_seats) {
            $sql = "INSERT INTO Flights (id, aircrafts_id, flight_number, departure_location, arrival_location, departure_date, departure_time, arrival_time, available_seats) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iissssssi",$id, $aircrafts_id, $flight_number, $departure_location, $arrival_location, $departure_date, $departure_time, $arrival_time, $available_seats);
            return $stmt->execute();
        }
        ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="aircrafts_id">ID máy bay:</label><br>
                <input class="input" type="number" id="aircrafts_id" name="aircrafts_id">
            </div>
            <div class="form-group">
                <label for="flight_number">Số hiệu chuyến bay:</label><br>
                <input class="input" type="text" id="flight_number" name="flight_number">
            </div>
            <div class="form-group">
                <label for="departure_location">Địa điểm khởi hành:</label><br>
                <input class="input" type="text" id="departure_location" name="departure_location">
            </div>
            <div class="form-group">
                <label for="arrival_location">Địa điểm đến:</label><br>
                <input class="input" type="text" id="arrival_location" name="arrival_location">
            </div>
            <div class="form-group">
                <label for="departure_date">Ngày xuất phát:</label><br>
                <input class="input" type="text" id="departure_date" name="departure_date">
            </div>
            <div class="form-group">
                <label for="departure_time">Thời gian khởi hành:</label><br>
                <input class="input" type="text" id="departure_time" name="departure_time">
            </div>
            <div class="form-group">
                <label for="arrival_time">Thời gian đến:</label><br>
                <input class="input" type="text" id="arrival_time" name="arrival_time">
            </div>
            <div class="form-group">
                <label for="available_seats">Số ghế trống:</label><br>
                <input class="input" type="number" id="available_seats" name="available_seats">
            </div>
            <div class="form-group">
                <button type="submit">Thêm chuyến bay</button>
            </div>
        </form>

    </div>
    
</body>
</html>

