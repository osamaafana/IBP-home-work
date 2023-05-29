<?php
// Connect to the database
$host = "localhost:3308"; // Change to your host name
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "Student"; // Change to your MySQL database name

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $full_name = $_POST["fullname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];

    // Validate the form data
    if (empty($full_name) || empty($email) || empty($gender)) {
        echo "Please fill in all required fields";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address";
    } else {
        // Insert the data into the database
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$full_name', '$email', '$gender')";

        if (mysqli_query($conn, $sql)) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }

        // Close the connection
        mysqli_close($conn);
    }
}
?>
