<?php 
    session_start();
    // Connect to the database
    $servername = "localhost";
    $username = "hari";
    $password = "12345678";
    $dbname = "pc_mp";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $loginStatus = false;
    $showErrorAlert = false;
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            while($row = mysqli_fetch_assoc($result)){
                if (password_verify($password, $row['password'])){
                    $loginStatus = true;
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['username'] = $username;
                    header('location: homeLoggedIn.html');
                } else {
                    $showErrorAlert = "Invalid Credentials";
                }
            }
        } else {
            $showErrorAlert = "Invalid Credentials";
        }
    }
?>