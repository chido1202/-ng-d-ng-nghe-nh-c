<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/Main/css/style_dangki.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">
</head>
<body>
    <div class="wrapper">
        <h1>Đăng kí mới</h1>
        <form action="dangki.php" method="POST">
    <div class="box1">
        <h2>Thông tin cơ bản</h2>
        <input type="text" name="lastname" id="lastname" class="input" placeholder="Nhập Họ:"> <!-- Lastname -->
        <br><br>

        <input type="text" name="firstname" id="firstname" class="input" placeholder="Nhập Tên đệm và Tên"> <!-- Firstname -->
        <br><br>

        <label for="birthdate">Ngày sinh: </label><br>
        <input type="date" name="birthdate" id="birthdate" class="input" placeholder="">
        <br><br>

        <label for="gender">Giới tính: </label>
        <input type="radio" name="gender" value="Nam" class="gender"/><span class="gender-label">Nam</span>
        <input type="radio" name="gender" value="Nữ" class="gender"/><span class="gender-label">Nữ</span>
    </div>

    <div class="box2">
         <!-- Bắt buộc phải có kí tự @ -->
        <input type="email" name="email" id="email" class="input" placeholder="Nhập email">
        <br><br>

        <input type="text" name="phone" id="phone" pattern="[0-9]{10}" class="input" placeholder="Nhập số điện thoại"> <!-- Chỉ cho nhập số, đủ 10 số -->
        <br><br>

        <input type="text" name="username" id="username" class="input" placeholder="Nhập tên đăng nhập">
        <br><br>

        <input type="password" name="password" id="password" class="input" placeholder="Nhập mật khẩu">
        <br><br>

        <input type="password" name="confirm_password" id="confirm_password" class="input" placeholder="Nhập lại mật khẩu">
        <br><br>

        <button type="submit" class="btn">Đăng kí</button>

        <a href="login.php">Đã có tài khoản? Đăng nhập!</a>
    </div>
</form>
        
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Check if the username already exists
    $check_username_query = "SELECT id FROM user WHERE username = ?";
    $check_username_stmt = $conn->prepare($check_username_query);
    $check_username_stmt->bind_param("s", $_POST['username']);
    $check_username_stmt->execute();
    $check_username_stmt->store_result();

    if ($check_username_stmt->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Prepare and bind
        $insert_query = "INSERT INTO `user` (`first_name`, `last_name`, `date_of_birth`, `number_phone`, `email`, `username`, `password`, `role_id`, `create_at`, `update_at`) VALUES (?, ?, ?, ?, ?, ?, ?    , ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sssssssiss", $first_name, $last_name, $date_of_birth, $number_phone, $email, $username, $password, $role_id, $create_at, $update_at);

        // Set parameters
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $date_of_birth = $_POST['birthdate'];
        $number_phone = $_POST['phone'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT) ;
        $role_id = 3;
        // $gender = $_POST['gender'];
        $create_at = date("Y-m-d H:i:s");
        $update_at = date("Y-m-d H:i:s");
        // Execute the query
        if ($stmt->execute()) {
            echo "User successfully added.";
        } else {
            echo "Error adding user: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>