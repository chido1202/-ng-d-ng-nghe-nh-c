<!DOCTYPE html>
<html>
<head>
    <title>Edit Airport</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .form-group textarea {
            height: 200px;
            resize: vertical;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <?php
    include 'connect.php'; // Include your database connection

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $airport_name = $_POST["airport_name"];
        $location = $_POST["location"];

        // Edit record in database
        $result = editRecord($conn, $id, $airport_name, $location);

        if ($result) {
            echo "Record edited successfully";
        } else {
            echo "Error editing record: " . $conn->error;
        }
    } else {
        $id = $_GET["id"];
        // Select data from the Airports table
        $sql = "SELECT * FROM Airports WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    }

    // Function to edit a record
    function editRecord($conn, $id, $airport_name, $location) {
        $sql = "UPDATE Airports SET airport_name = ?, location = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $airport_name, $location, $id);
        return $stmt->execute();
    }
    ?>
    <h1>Edit Airport</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="name">Tên sân bay:</label>
            <input type="text" id="name" name="airport_name" value="<?php echo $row['airport_name']; ?>">
        </div>
        <div class="form-group">
            <label for="location">Vị trí:</label>
            <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>">
        </div>
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
