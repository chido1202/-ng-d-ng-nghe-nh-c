

<?php
// Establish connection to the database
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "airtiket_online"; // Your MySQL database name
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the search criteria entered by the user
    $departure_location = $_POST['departure_location'];
    $arrival_location = $_POST['arrival_location'];
    $departure_date = $_POST['departure_date'];

    // Prepare and execute the SQL query with prepared statements
    $sql = "SELECT * FROM flights WHERE departure_location = ? AND arrival_location = ? AND departure_date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $departure_location, $arrival_location, $departure_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Create an array to store the search results
    $flights = array();

    // Fetch results and store them in the array
    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }

    // Prepare JSON response
    $response = array(
        'success' => true,
        'html' => ''
    );

    // Check if flights were found
    if (count($flights) > 0) {
        // Prepare HTML to display search results
        $response['html'] .= "<table>";
        $response['html'] .= "<tr><th>Số hiệu chuyến bay</th><th>Địa điểm khởi hành</th><th>Địa điểm đến</th><th>Giờ khởi hành</th><th>Giờ đến</th><th>Vé sẵn có</th><th>Ngày khởi hành</th><th></th></tr>";
        foreach ($flights as $flight) {
            $response['html'] .= "<tr>";
            $response['html'] .= "<td>" . $flight["flight_number"] . "</td>";
            $response['html'] .= "<td>" . $flight["departure_location"] . "</td>";
            $response['html'] .= "<td>" . $flight["arrival_location"] . "</td>";
            $response['html'] .= "<td>" . $flight["departure_time"] . "</td>";
            $response['html'] .= "<td>" . $flight["arrival_time"] . "</td>";
            $response['html'] .= "<td>" . $flight["available_seats"] . "</td>";
            $response['html'] .= "<td>" . $flight["departure_date"] . "</td>";
            $response['html'] .= "<td>
            <form action='./booking.php' method='GET'>
                <input type='hidden' name='flight_number' value='".$flight["flight_number"]."'>
                <input type='hidden' name='departure_time' value='".$flight["departure_time"]."'>
                <button type='submit' class='order_flight'>Chọn</button>
            </form>
        </td>";
                    $response['html'] .= "</tr>";
        }
        $response['html'] .= "</table>";
    } else {
        // No flights found
        $response['html'] = "<p>No flights found</p>";
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

    // Close the database connection
    $stmt->close();
} else {
    // Request method is not POST
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>
