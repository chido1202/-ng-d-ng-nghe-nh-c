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

</head>
<body>
    <div id="wrapper_add">
    <h1>Thêm máy bay mới</h1><br>

    <?php
    // include 'connect.php'; // Include your database connection

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $aircraft_name = $_POST["aircraft_name"];
        $airline_id = $_POST["airline_id"];
        $seating_capacity = $_POST["seating_capacity"];
        $status = $_POST["status"];

        // Add record to database
        $result = addRecord($con, $id, $aircraft_name, $airline_id, $seating_capacity, $status);

        if ($result) {
            echo "<div class='blue_notice'>Nhập thành công!</div>";
        } else {
            echo "<div class='red_notice'>Error adding record: </div>" . $con->error;
        };

    }

    // Function to add a record
    function addRecord($con, $id, $aircraft_name, $airline_id, $seating_capacity, $status) {
        $sql = "INSERT INTO Aircrafts (id, aircraft_name, airline_id, seating_capacity, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("isiis", $id, $aircraft_name, $airline_id, $seating_capacity, $status);
        return $stmt->execute();
    }
    ?>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="id">ID:</label><br>
            <input class="input" type="number" id="id" name="id">
        </div>
        <div class="form-group">
            <label for="name">Tên máy bay:</label><br>
            <input class="input" type="text" id="name" name="aircraft_name">
        </div>
        <div class="form-group">
            <label for="airline_id">ID hãng hàng không:</label><br>
            <input class="input" type="number" id="airline_id" name="airline_id">
        </div>
        <div class="form-group">
            <label for="capacity">Sức chứa:</label><br>
            <input class="input" type="number" id="capacity" name="seating_capacity">
        </div>
        <div class="form-group">
            <label for="status">Trạng thái:</label><br>
            <input class="input" type="text" id="status" name="status">
        </div>  

        <div class="form-group">
            <button type="submit">Thêm</button>
        </div>

    </form>
    </div>
    
</body>
</html>

