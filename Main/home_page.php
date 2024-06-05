<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="/Main/css/search.css">
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
                <a href="home_page.php">
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


        <!-- slider -->
        <div class="slider">
    <div class="slider-booking">
        <div class="where">
            <div class="where-form">
                <div class="from-box">
                    <label for="departure-location" class="form">Từ</label>
                    <div class="option">
                        <select name="departure_location" id="departure-location">
                            <option value="" class="bg-from">Chọn nơi xuất phát</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Tp. HCM">Thành phố Hồ Chí Minh</option>
                        </select>
                    </div>
                </div>
                <div class="from-box">
                    <label for="arrival-location" class="form">Đến</label>
                    <div class="option">
                        <select name="arrival_location" id="arrival-location">
                            <option value="" class="bg-from">Chọn nơi đến</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Tp. HCM">Thành phố Hồ Chí Minh</option>
                        </select>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="hei">
            <div class="input-box">
                <label for="departure-date" class="form">Ngày xuất phát</label>
                <div class="last">
                    <input type="date" name="departure_date" id="departure-date">
                </div>
            </div>
            <div class="input-box">
                <label for="return-date" class="form">Ngày trở lại</label>
                <div class="last">
                    <input type="date" name="return_date" id="return-date">
                </div>
            </div>

            <div class="input-box after">
                <div class="last button">
                    <button id="search-flight-button">Tìm kiếm chuyến bay</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fligh-search-result">
    <h2 class="result-title">List of Flights</h2>
</div>

<br><br>
        
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const searchFlightButton = document.getElementById("search-flight-button");

    searchFlightButton.addEventListener("click", function(event) {
        event.preventDefault();

        // Retrieve form values
        const departureLocation = document.getElementById("departure-location").value;
        const arrivalLocation = document.getElementById("arrival-location").value;
        const departureDate = formatDate(document.getElementById("departure-date").value);
        const returnDate = formatDate(document.getElementById("return-date").value);

        // Prepare data for submission
        const formData = new FormData();
        formData.append("departure_location", departureLocation);
        formData.append("arrival_location", arrivalLocation);
        formData.append("departure_date", departureDate);
        formData.append("return_date", returnDate);

        // Send POST request
        fetch("search_flight.php", {
            method: "POST",
            body: formData
        }).then(response => {
            if (response.ok) {
                return response.json(); // Return JSON response
            } else {
                throw new Error('Network response was not ok.');
            }
        }).then(data => {
            // Handle successful response
            const flightSearchResultDiv = document.querySelector(".fligh-search-result");
            flightSearchResultDiv.innerHTML = `<h2 class="result-title">List of Flights</h2>` + data.html; // Set HTML to result div
        }).catch(error => {
            // Handle network error
            console.error('There has been a problem with your fetch operation:', error);
        });
    });
});

// Function to format date to "DD/MM/YYYY" format
function formatDate(dateString) {
    const dateObj = new Date(dateString);
    const day = String(dateObj.getDate()).padStart(2, '0');
    const month = String(dateObj.getMonth() + 1).padStart(2, '0');
    const year = dateObj.getFullYear();
    return `${day}/${month}/${year}`;
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var orderFlightButtons = document.getElementsByClassName("order_flight");
    
    for (var i = 0; i < orderFlightButtons.length; i++) {
        orderFlightButtons[i].addEventListener("click", function() {
            // Extract flight number and departure time from the button value
            var buttonValue = this.value.split(",");
            var flightNumber = buttonValue[0];
            var departureTime = buttonValue[1];

            // Construct the URL with parameters
            var url = "/booking.php?flight_number=" + encodeURIComponent(flightNumber) + "&departure_time=" + encodeURIComponent(departureTime);

            // Redirect to booking.php with parameters
            window.location.href += url;
        });
    }
});
</script>

</body>
</html>