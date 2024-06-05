<!DOCTYPE html>
<html>
<head>
    <title>Delete Airline</title>
    <style>
        /* Your CSS styles go here */
    </style>
</head>
<body>
    <?php
    include('../page_admin/thanhben.php') ;

    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Delete record from the 'Flights' table
        $result = deleteRecord($con, $id);

        if ($result) {
            header('Location: ../page_admin/ql_flight.php');
        } else {
            echo "Error deleting record: " . $con->error;
        }
    } else {
        echo "No 'id' provided to delete";
    }

    function deleteRecord($conn, $id) {
        $sql = "DELETE FROM Flights WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    ?>
</body>
</html>

