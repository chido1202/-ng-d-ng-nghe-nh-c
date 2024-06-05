<!DOCTYPE html>
<html>
<head>
    <title>Delete Airport</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <?php
    include 'connect.php'; // Include your database connection

    // Check if id is provided
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Delete record from database
        $result = deleteRecord($conn, $id);

        if ($result) {
            echo "<div class='message'>Record deleted successfully</div>";
        } else {
            echo "<div class='message'>Error deleting record: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='message'>No id provided to delete</div>";
    }

    // Function to delete a record
    function deleteRecord($conn, $id) {
        $sql = "DELETE FROM Airports WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    ?>
</body>
</html>
