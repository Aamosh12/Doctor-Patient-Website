<?php
session_start();
require '../actions/Connection.php';
date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Nepal (Asia/Kathmandu)
$currentDateTime = date('Y-m-d H:i:s');
if (isset($_POST['register-patient'])) {
    global $conn;
    $name = $_POST['pname'];
    $email = $_POST['pemail'];
    $address = $_POST['paddress'];
    $phone = $_POST['pnum'];
    $username = $_POST['pusername'];
    $password = $_POST['ppassword'];
    if ($name == "" || $email == "" || $phone == "" || $address == "" || $username == "") {
        $_SESSION['mandatory'] = true;
    } else {
        // Text validation for the name (letters followed by optional numbers)
        $namePattern = '/^[A-Za-z\s]+$/';
        $usernamePattern = '/^[A-Za-z]+(?:\s+\d+)*$/';
        if (!preg_match($namePattern, $name)) {
            $_SESSION['namepattern'] = true;
            // Handle invalid name input (e.g., display an error message).
        } elseif (!preg_match($usernamePattern, $address)) {
            $_SESSION['addressPattern'] = true;
        } elseif (!preg_match($usernamePattern, $username)) {
            $_SESSION['usernamePattern'] = true;
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
                    $user_sql = "INSERT INTO user VALUES ('', '$name', '$email', '$address', '$username', '$password', '$phone', '2', '$currentDateTime')";
                    $conn->query($user_sql);
                    $_SESSION['registerValidate'] = true;
                }
            }
        }
    }
    $conn->close();
    echo "<script>window.location.href = '../index.php';</script>";
}
?>
