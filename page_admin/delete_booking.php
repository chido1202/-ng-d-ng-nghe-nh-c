<!DOCTYPE html>
<html>
<head>
    <title>Delete Airline</title>
</head>
<body>
    <?php
    include('../page_admin/thanhben.php') ;
    // Check if id is provided
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Delete record from database
        $result = deleteRecord($con, $id);

        if ($result) {
            header('Location: ../page_admin/ql_booking.php');
        } else {
            echo "Error deleting record: " . $con->error;
        }
    } else {
        echo "No id provided to delete";
    }

    // Function to delete a record
    function deleteRecord($con, $id) {
        $sql = "DELETE FROM Booking WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    ?>
</body>
</html>
