<?php
require("validate.php");

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "postgres";
$database = "gjc_library";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the registration form is submitted
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Perform SQL query to insert new user into database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $success = "Registration successful!";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>


<?php
if(isset($error)){
    echo "<p style='color:red;'>$error</p>";
}
if(isset($success)){
    echo "<p style='color:green;'>$success</p>";
}
?>
</body>
</html>
