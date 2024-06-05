<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hãng hàng không</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/page_admin/css/style_admin.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Faustina:ital,wght@0,300..800;1,300..800&family=Honk&display=swap" rel="stylesheet">

    <link rel="icon" href="../image/logo.png">

</head>

<?php
include('../page_admin/thanhben.php') 
?>

</head>
<body>
    <div id="wrapper_add">
        <h1>Thêm hãng Hàng Không</h1><br>
        
        <?php
            // Xử lý dữ liệu khi form được gửi đi
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST["id"];
                $airline_name = $_POST["airline_name"];
                $contact_info = $_POST["contact_info"];
                // include 'connect.php'; // Include your database connection


                // Thêm hãng vào cơ sở dữ liệu
                $sql = "INSERT INTO Airlines (id, airline_name, contact_info) VALUES ('$id', '$airline_name', '$contact_info')";

                if ($con->query($sql) === TRUE) {
                    echo "<div class='blue_notice'>Hãng đã được thêm thành công!</div>";
                } else {
                    echo "<div class='red_notice'>Lỗi khi thêm hãng: </div>" . $con->error;
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
                <label for="airline_name">Tên hãng:</label><br>
                <input class="input" type="text" id="airline_name" name="airline_name">
            </div>
            <div class="form-group">
                <label for="contact_info">Thông tin liên hệ:</label><br>
                <input class="input" type="text" id="contact_info" name="contact_info">
            </div>
            <div class="form-group">
                <button type="submit">Thêm hãng</button>
            </div>
        </form>
    </div>
    
</body>
</html>









