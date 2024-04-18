<?php
// Connect to the database
$servername = "localhost";
$username = "hari";
$password = "12345678";
$dbname = "pc_mp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $gender = $_POST["gender"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $name = $fname." ".$lname;
    // Prepare and execute the SQL query
    $sql = "INSERT INTO users (name, email, password, contact, gender) VALUES ('$name', '$email', '$hashed_password', '$contact', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Registered successfully";
        header('location: login1.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

