<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Replace these values with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST["name"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Check availability
    $availabilityCheck = "SELECT * FROM reservation_data WHERE date = '$date' AND time = '$time'";
    $result = $conn->query($availabilityCheck);

    if ($result->num_rows > 0) {
        echo "Sorry, the selected time is not available. Please choose another time.";
    } else {
        // If the time is available, proceed with the reservation
        $sql = "INSERT INTO reservation_data (name, email, date, time) 
                VALUES ('$name', '$email', '$date', '$time')";

        if ($conn->query($sql) === TRUE) {
            echo "Reservation Successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
