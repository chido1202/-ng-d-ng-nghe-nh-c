<?php
session_start();
if(isset($_SESSION['username'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "airtiket_online";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $full_name = $row["last_name"] . " " . $row["first_name"];
         $date_of_birth = $row["date_of_birth"];
         $phone_number = $row["number_phone"];
         $email = $row["email"];
         $username = $row["username"];
         $conn->close();
    } else {
        echo "User not found";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="/Main/css/booking.css">
    <link rel="stylesheet" href="./font/flaticon.css">
    <title>Tiến hành đặt vé</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">
</head>

</head>
<body>
    <div class="main">
        <!-- header -->
        <div class="header">
            <div class="logo-header">
                <a href="#">
                    <img src="/image/logo.png" alt="">
                </a>
            </div>
            <div class="menu-right">
                <ul class="header-menu">
                    <li><a href="home_page.php" class="active">Trang chủ</a></li>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="login.php">Tài khoản</a></li>
                    <li><a href="cart.php">Vé của tôi</a></li>
                </ul>
            </div>
        </div>        
        <!-- header ends -->



    <div class="wrapper">
        <div class="box">
            <div class="info_flight">
                <h1>Thông tin chuyến bay:</h1>
                <?php
                if(isset($_GET['flight_number']) && isset($_GET['departure_time'])) {
                    $flight_number = $_GET['flight_number'];
                    $departure_time = $_GET['departure_time'];

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
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $stmt = $conn->prepare("SELECT * FROM flights WHERE flight_number = ? AND departure_time = ?");
                    $stmt->bind_param("ss", $flight_number, $departure_time);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<p>Tuyến bay: ".$row['departure_location']." ---- ".$row['arrival_location']."</p>";
                        echo "<p>Giờ bay: ".$row['departure_time']." - ".$row['arrival_time']."</p>";
                        echo "<p>Số hiệu chuyến bay: ".$row['flight_number']."</p>";
                    } else {
                        header("Location: home_page.php"); // Redirect to home page
                        exit();
                    }

                    $stmt->close();
                    $conn->close();
                } else {
                    header("Location: home_page.php"); // Redirect to home page
                    exit();
                }
                ?>
            </div>

            <div class="booking">
                <div class="box_cart_1">
                <form action="" method="POST">
                    <h1>Thông tin cơ bản</h1>
                    <div class="info_basic">
                        <p>Nhập Tên Đệm và Tên</p>
                        <input type="text" name="first_name" id="first_name" class="input">
                        <p>Nhập họ</p>
                        <input type="text" name="last_name" id="last_name" class="input">

                        <p>Ngày Tháng Năm sinh</p>
                        <input type="date" name="dob" id="dob" class="input">

                        <p>Giới tính</p>
                        <select name="gender" id="gender" class="input">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>

                        <p>Số lượng vé</p>
                        <select name="quantity" id="quantity" class="input">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>                       
                        </select>
                    </div>

                    <h1>Thông tin liên hệ</h1>
                    <div class="Contact_info">
                        <p>Số điện thoại</p>
                        <input type="text" name="phone_number" id="phone_number" class="input">

                        <p>Địa chỉ Email</p>
                        <input type="email" name="email" id="email" class="input">
                    </div>

                    <div class="class_ticket">
                        <p>Chọn hạng vé</p>
                        <select name="ticket_class" id="ticket_class" class="input">
                            <option value="1">Hạng phổ thông</option>
                            <option value="2">Hạng phổ thông đặc biệt</option>
                            <option value="3">Hạng thương gia</option>
                            <option value="4">Hạng nhất</option>                      
                        </select>
                    </div>
                    
                    <br>
                    <div class="btn">
                        <button type="submit" class="btn_design">Xác nhận</button>
                    </div>
                </form>

                </div>
            </div>
        
        </div>
        
    </div>

</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airtiket_online";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $quantity = $_POST["quantity"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $ticket_classes = $_POST["ticket_class"];
    $user_username = $_SESSION['username'];
    $stmt = $conn->prepare("INSERT INTO booking (user_id, flight_id, titket_classes_id, booking_date, seat_code, total_price, username,soluong_ve) VALUES (?, ?, ?, NOW(), ?, ?,?,?)");
    $stmt->bind_param("iiisssi", $user_id, $flight_id, $ticket_classes, $seat_code, $total_price,$user_username,$quantity);
    
    $user_id = 3;

    
    $get_flight_id = $conn->prepare("SELECT id FROM flights WHERE flight_number = ? AND departure_time = ?");
    $get_flight_id->bind_param("ss", $flight_number, $departure_time);
    $get_flight_id->execute();
    $result = $get_flight_id->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $flight_id = $row["id"];
    } else {
        echo "Error: Flight not found";
        exit;
    }
    
    switch ($ticket_classes) {
        case 1:
            $ticket_price = 1800000;
            break;
        case 2:
            $ticket_price = 1200000;
            break;
        case 3:
            $ticket_price = 800000;
            break;
        case 4:
            $ticket_price = 200000;
            break;
        default:
            $ticket_price = 0;
    }
    $total_price = (1000000 + $ticket_price) * $quantity;
    
    $seat_code = rand(0, 10000);
    
    if ($stmt->execute()) {
        echo "Booking successful!";
        echo "Tổng Tiền Cần Thanh Toán Của Bạn Là: ".$total_price;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
