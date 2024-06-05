
<?php
session_start();
function logout() {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();
}
if(isset($_SESSION['username'])) {
    if(isset($_POST['logout'])) {
        logout();
    }
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
    $username = $_SESSION['username'];
    // Define SQL query to fetch user data by username
    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";

    // Execute the query
    $result = $conn->query($sql);


    // Check if there are any results
    if ($result->num_rows > 0) {
         // Fetch user data
         $row = $result->fetch_assoc();

         // Close the database connection
         $conn->close();
 
         // Extract data from the row
         $full_name = $row["last_name"] . " " . $row["first_name"];
         $date_of_birth = $row["date_of_birth"];
         $phone_number = $row["number_phone"];
         $email = $row["email"];
         $username = $row["username"];
    }    else {
        echo "User not found";
    }
}
 else {
    // If user is not logged in, redirect to login page or do something else
    header("Location: login.php"); // Change "login.php" to your login page URL
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
    <link rel="stylesheet" href="/Main/css/thongtincanhan.css">
    <link rel="stylesheet" href="./font/flaticon.css">
    <title>Airtiket Online Xin chào!</title>

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


        <div class="Personal_Info">
            <div class="box">
                <h1>Thông tin cá nhân</h1>
                <div class="form_info">
                <form action="" method="POST">
                        <label for="">Họ và tên: </label>
                        <input type="text" value="<?php echo isset($full_name) ? $full_name : ''; ?>" class="output">
                        <br>

                        <label for="">Ngày sinh: </label>
                        <input type="text" value="<?php echo isset($date_of_birth) ? $date_of_birth : ''; ?>" class="output">
                        <br>


                        <label for="">Số điện thoại: </label>
                        <input type="text" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" class="output">
                        <br>


                        <label for="">Địa chỉ email: </label>
                        <input type="text" value="<?php echo isset($email) ? $email : ''; ?>" class="output">
                        <br>


                        <label for="">Tên đăng nhập: </label>   
                        <input type="text" value="<?php echo isset($username) ? $username : ''; ?>" class="output">
                        <br>

                        

                        <form action="" method="POST">

                        <input type="submit" name="logout" value="Đăng xuất" class="btn_ds">
                        </form>
                        
                        <input type="button" value="Đổi mật khẩu" class="btn">

                        <script>

                        </script>

                    </form>
                </div>
            </div>
        </div>

</body>