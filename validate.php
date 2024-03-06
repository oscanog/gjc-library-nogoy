<?php
$username = null;
$password = null;
$username_error = null;
$password_error = null;
$success = null;

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty(trim($username))){
        $username_error = "Incorrect username!";
    }else{
        if(empty(trim($password))){
            $password_error = "Incorrect password!";
        }else{
            $success = "Login successful.";
        }
    }
}