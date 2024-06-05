<?php
include('../page_admin/thanhben.php');
?>

<body>
    <div id="wrapper_add">
        <h1>Thêm người dùng</h1><br>
        
        <?php
            // Xử lý dữ liệu khi form được gửi đi
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST["id"];
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $date_of_birth = $_POST["date_of_birth"];
                $number_phone = $_POST["number_phone"];
                $email = $_POST["email"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $gender = $_POST["gender"]; // Add gender field

                // include 'connect.php'; // Include your database connection

                // Thêm người dùng vào cơ sở dữ liệu
                $sql = "INSERT INTO user (id, first_name, last_name, date_of_birth, number_phone, email, username, password, gender, role_id) VALUES ('$id', '$first_name', '$last_name', '$date_of_birth', '$number_phone', '$email', '$username', '$password', '$gender', 3)";

                if ($con->query($sql) === TRUE) {
                    echo "<div class='blue_notice'>Người dùng đã được thêm thành công!</div>";
                } else {
                    echo "<div class='red_notice'>Lỗi khi thêm người dùng: </div>" . $con->error;
                }

                $con->close();
            }
        ?>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="id">ID:</label> <br>
                <input class="input" type="number" id="id" name="id">
            </div>
            <div class="form-group">
                <label for="first_name">Họ và tên đệm:</label><br>
                <input class="input" type="text" id="first_name" name="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Tên:</label><br>
                <input class="input" type="text" id="last_name" name="last_name">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Ngày sinh:</label><br>
                <input class="input" type="date" id="date_of_birth" name="date_of_birth">
            </div>
            <div class="form-group">
                <label for="number_phone">Số điện thoại:</label><br>
                <input class="input" type="text" id="number_phone" name="number_phone">
            </div>
            <div class="form-group">
                <label for="email">Email:</label><br>
                <input class="input" type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label><br>
                <input class="input" type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label><br>
                <input class="input" type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="gender">Giới tính:</label><br>
                <input class="input" type="text" id="gender" name="gender">
            </div>
            <div class="form-group">
                <button type="submit">Thêm người dùng</button>
            </div>
        </form>
    </div>
</body>