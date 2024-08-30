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
    $state = $_POST["state"];
    $district = $_POST["district"];
    $institution = $_POST["institution"];
    $utr = $_POST["UTR"]; // Add this line to get UTR number

    // Replace 'your_table_name' with the actual name of your table
    $sql = "INSERT INTO donation_data (name, email, state, district, institution, utr) 
            VALUES ('$name', '$email', '$state', '$district', '$institution', '$utr')";

    if ($conn->query($sql) === TRUE) {
        echo "Thank You For Your Donation";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
