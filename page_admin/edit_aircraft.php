<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách máy bay</title>

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
        <h1>Chỉnh sửa thông tin máy bay</h1> <br>
        <?php
        // include 'connect.php'; // Include your database connection

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $aircraft_name = $_POST["aircraft_name"];
            $airline_id = $_POST["airline_id"];
            $seating_capacity = $_POST["seating_capacity"];
            $status = $_POST["status"];

            // Edit record in database
            $result = editRecord($con, $id, $aircraft_name, $airline_id, $seating_capacity, $status);

            if ($result) {
                header('Location: ../page_admin/ql_aircraft.php');
            } else {
                echo "<div class='red_notice'>Error editing record: </div>" . $con->error;
            }
        } else {
            $id = $_GET["id"];
            // Select data from the Aircrafts table
            $sql = "SELECT * FROM Aircrafts WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        }

        // Function to edit a record
        function editRecord($con, $id, $aircraft_name, $airline_id, $seating_capacity, $status) {
            $sql = "UPDATE Aircrafts SET aircraft_name = ?, airline_id = ?, seating_capacity = ?, status = ? WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("siisi", $aircraft_name, $airline_id, $seating_capacity, $status, $id);
            return $stmt->execute();
        }
        ?>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Tên máy bay:</label> <br>
                <input class="input" type="text" id="name" name="aircraft_name" value="<?php echo $row['aircraft_name']; ?>">
            </div>
            <div class="form-group">
                <label for="airline_id">ID hãng hàng không:</label> <br>
                <input class="input" type="number" id="airline_id" name="airline_id" value="<?php echo $row['airline_id']; ?>">
            </div>
            <div class="form-group">
                <label for="capacity">Sức chứa:</label> <br>
                <input class="input" type="number" id="capacity" name="seating_capacity" value="<?php echo $row['seating_capacity']; ?>">
            </div>
            <div class="form-group">
                <label for="status">Trạng thái:</label> <br>
                <input class="input" type="text" id="status" name="status" value="<?php echo $row['status']; ?>">
            </div>
            <div class="form-group">
                <button type="submit">Cập nhật</button>
            </div>

        </form>
    </div>
   
</body>
</html>



