<?php
require './actions/Connection.php';
date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Nepal (Asia/Kathmandu)
$currentDateTime = date('Y-m-d H:i:s');
if (isset($_POST['register-patient'])) {
    global $conn;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $food = $_POST['food'];
    if ($name == "" || $email == "" || $phone == "" || $address == "" || $username == "" || $food == "") {
        $_SESSION['mandatory'] = true;
    } else {
        // Text validation for the name (letters followed by optional numbers)
        $namePattern = '/^[A-Za-z\s]+$/';
        $addressPattern = '/^[A-Za-z\s\d]+$/';
        $usernamePattern = '/^(?=.*[a-zA-Z])\w*$/';
        if (!preg_match($namePattern, $name)) {
            $_SESSION['namepattern'] = true;
        } elseif (!preg_match($addressPattern, $address)) {
            $_SESSION['addressPattern'] = true;
        } elseif (!preg_match($usernamePattern, $username)) {
            $_SESSION['usernamePattern'] = true;
        } elseif (!preg_match($namePattern, $food)) {
            $_SESSION['foodPattern'] = true;
        } else {
            // Email validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['emailPattern'] = true;
                // Handle invalid email input (e.g., display an error message).
            } else {
                // Phone number validation
                $phonePattern = '/^(98|97)\d{8}$/';
                if (!preg_match($phonePattern, $phone)) {
                    $_SESSION['phoneValidate'] = true;
                    // Handle invalid phone number input (e.g., display an error message).
                } else {
                    $user_sql = "INSERT INTO user VALUES ('', '$name', '$email', '$address', '$username', '$password', '$phone', '2', '$currentDateTime', '$food')";
                    $conn->query($user_sql);
                    $_SESSION['registerValidate'] = true;
                }
            }
        }
    }
    $conn->close();
    header('Location: ./loginpat.php');
}
