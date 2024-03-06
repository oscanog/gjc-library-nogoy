<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="wrapper">
    <div class="form-box login">
        <h2>Register</h2>
        <form method="post" action="registration.php">
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" id="username" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" id="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" id="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">I agree to the terms & conditions</label>
            </div>
            <button type="submit" name="register" class="btn">Register</button>
            <div class="login-register">
                <p>Already have an account? <a href="#" class="login-link">Login here</a> </p>
            </div>
        </form>
    </div>
</div>


<?php
if(isset($_POST['register'])){
    require("validate.php");

    // Database connection parameters
    $servername = "localhost"; // Replace with your MySQL server name if it's different
    $username = "root"; // Replace with your MySQL username
    $password = "postgres"; // Replace with your MySQL password
    $database = "gjc_library"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Perform SQL query to insert new user into database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}
?>
<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
