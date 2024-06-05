<!DOCTYPE html>
<html>
<head>
    <title>Thêm thông tin thanh toán</title>
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
    <h1>Thêm thông tin thanh toán</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="booking_id">ID đặt chỗ:</label>
            <input type="text" id="booking_id" name="booking_id" required>
        </div>
        <div class="form-group">
            <label for="payment_date">Ngày thanh toán:</label>
            <input type="date" id="payment_date" name="payment_date" required>
        </div>
        <div class="form-group">
            <label for="payment_amount">Số tiền thanh toán:</label>
            <input type="number" id="payment_amount" name="payment_amount" required>
        </div>
        <button type="submit">Thêm</button>
    </form>
    <?php
    include 'connect.php'; // Include your database connection

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $booking_id = $_POST["booking_id"];
        $payment_date = $_POST["payment_date"];
        $payment_amount = $_POST["payment_amount"];

        // Add record to database
        $result = addRecord($conn, $booking_id, $payment_date, $payment_amount);

        if ($result) {
            echo "Record added successfully";
        } else {
            echo "Error adding record: " . $conn->error;
        }
    }

    // Function to add a record
    function addRecord($conn, $booking_id, $payment_date, $payment_amount) {
        $sql = "INSERT INTO Payment (booking_id, payment_date, payment_amount) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $booking_id, $payment_date, $payment_amount);
        return $stmt->execute();
    }
    ?>
</body>
</html>

