<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/page_admin/css/style_login_admin.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Faustina:ital,wght@0,300..800;1,300..800&family=Honk&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div id="wrapper">
        <?php
        session_start();
        include('../db/connect.php');
        ?>

        <?php
        // session_destroy();
        // unset('dangnhap');
        if (isset($_POST['dangnhap'])){
            $taikhoan = $_POST['taikhoan'];
            $matkhau  = md5($_POST['matkhau']);
            if ($taikhoan == '' || $matkhau == ''){
                echo "<p class='box_orange'>Xin nhập đủ thông tin</p>";
            } else {
                $sql_select_admin = mysqli_query($con, "SELECT * FROM user WHERE username = '$taikhoan' AND password = '$matkhau' LIMIT 1");
                $count = mysqli_num_rows($sql_select_admin);
                $row_dangnhap = mysqli_fetch_array($sql_select_admin);
                if ($count > 0){
                    $_SESSION['dangnhap'] = $row_dangnhap['first_name'];
                    $_SESSION['admin_id'] = $row_dangnhap['id'];
                    header('Location: admin_home.php');
                } else {
                    echo "<p class='box_red'>Tài khoản hoặc mật khẩu sai</p>";
                }
            }
        }
        ?>

        <div class="login">
            <div class="title">
                <h2>Đăng nhập Admin</h2>
            </div>

            <div class="input">
                <form action="" method="POST">
                    <i class='bx bxs-user'></i> 
                    <label> Tài khoản</label><br>
                    <input type="text" name="taikhoan" placeholder="Nhập tên đăng nhập" class="form-control"><br>

                    <i class='bx bxs-lock-alt' ></i>
                    <label> Mật khẩu</label><br>
                    <input type="password" name="matkhau" placeholder="Nhập mật khẩu" class="form-control"><br>

                    <input type="submit" name="dangnhap" class="btn" value="Đăng nhập Admin" id="btn">
            
                </form>
            </div> 
        </div>

    </div>


</body>
</html>