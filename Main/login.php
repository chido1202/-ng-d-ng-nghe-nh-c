<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/Main/css/style_login.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">
</head>
<body>
    <div class="wrapper">
        <h1>Đăng nhập</h1>
        <form action="login.php" method="POST">
            <div class="input">
                <p>Tên đăng nhập</p>
                <input type="text" name="username" id="username" class="form_input">

                <p>Mật khẩu</p>
                <input type="password" name="password" id="password" class="form_input">
                <br><br>
                <input type="checkbox" name="" id=""> <label for="">Ghi nhớ đăng nhập</label>
                <br>

                <a href="">Quên mật khẩu? </a>
                <a href="dangki.php">Chưa có tải khoản?</a>
                <br>

                <button type="submit" class="btn">Đăng nhập</button>

            </div>


        </form>

    </div>
</body>
</html>
<?php
session_start();

function validateUser($conn, $username, $password) {
    $username = mysqli_real_escape_string($conn, $username);

    $stmt = $conn->prepare("SELECT password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airtiket_online";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: thongtincanhan.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $username;

    if (validateUser($conn, $username, $password)) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: thongtincanhan.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>