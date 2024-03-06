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

// Check if the login form is submitted
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input (you can include your validation logic here)

    // Perform SQL query to check if the user exists
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, redirect to success page or do whatever you want
        $success = "Login successful!";
        // You can also set session variables here if you want to maintain user session
    } else {
        // User not found or credentials are incorrect
        $username_error = "Invalid username or password";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="hydrated">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="styles.css">
    <?php
    if($username_error != null){
        ?> <style>.username-error{display:block}</style> <?php
    }
    if($password_error != null){
        ?> <style>.password-error{display:block}</style> <?php
    }
    if($success != null){
        ?> <style>.success{display:block}</style> <?php
    }
    ?>
</head>

<body>
<div class="wrapper">
    <div class="form-box login">
        <h2>Login</h2>
        <form action="#" method="post">
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" name="username" value="<?php echo $username; ?>" required>
                <p class="error username-error">
                    <?php echo $username_error; ?>
                </p>
                <label>Username</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" value="<?php echo $password; ?>" required>
                <p class="error password-error">
                    <?php echo $password_error; ?>
                </p>
                <label>Password</label>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
            <p class="success">
                <?php echo $success; ?>
            </p>
            <div class="login-register">
                <p>Don't have an account? <a href="#" class="register-link">Register here</a> </p>
            </div>
        </form>
    </div>

    <div class="form-box register">
        <h2>Registration</h2>
        <form action="#" method="post">
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" required>
                <label>Password</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" required>
                <label>Confirm Password</label>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">I agree to the terms & conditions</label>
            </div>
            <button type="submit" class="btn">Register</button>
            <div class="login-register">
                <p>Already have an account? <a href="#" class="login-link">Login here</a> </p>
            </div>
        </form>
    </div>
</div>

<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
