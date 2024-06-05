<!DOCTYPE html>
<html>
<head>
    <title>Delete Airline</title>
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
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "No id provided to delete";
    }

    // Function to delete a record
    function deleteRecord($conn, $id) {
        $sql = "DELETE FROM Airlines WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    ?>
</body>
</html>
