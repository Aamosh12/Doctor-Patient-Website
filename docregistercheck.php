<?php
require './actions/Connection.php';
date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Nepal (Asia/Kathmandu)
$currentDateTime = date('Y-m-d H:i:s');
if (isset($_POST['register-doctor'])) {
    // print_r($_POST);
    global $conn;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $degree = $_POST['degree'];
    $specialization = $_POST['spec'];
    $nmc = $_POST['nmc'];
    $experience = $_POST['experience'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $food = $_POST['food'];
    $isverified = false; 
    if ($name == "" || $email == "" || $phone == "" || $username == "" || $address == "" || $degree == "" || $specialization == "" || $nmc == "" || $experience == "" || $food == "") {
        $_SESSION['mandatory'] = true;
    } else {
        // Text validation for the name (letters followed by optional numbers)
        $namePattern = '/^[A-Za-z\s]+$/';
        $addressPattern = '/^(?=.*[a-zA-Z])\w*$/';
        $usernamePattern = '/^(?=.*[a-zA-Z])\w*$/';
        if (!preg_match($namePattern, $name)) {
            $_SESSION['namepattern'] = true;
            // Handle invalid name input (e.g., display an error message).
        } elseif (!preg_match($addressPattern, $address)) {
            $_SESSION['addressPattern'] = true;
        } elseif (!preg_match($usernamePattern, $username)) {
            $_SESSION['usernamePattern'] = true;
        } elseif (!preg_match($namePattern, $degree)) {
            $_SESSION['degreePattern'] = true;
        } elseif (!preg_match($namePattern, $specialization)) {
            $_SESSION['specialPattern'] = true;
        } elseif (!preg_match($namePattern, $food)){
            $_SESSION['foodpattern'] = true;
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['emailPattern'] = true;
                // Handle invalid email input (e.g., display an error message).
            } else {
                
                $phonePattern = '/^(98|97)\d{8}$/';
                if (!preg_match($phonePattern, $phone)) {
                    $_SESSION['phoneValidate'] = true;
                    // Handle invalid phone number input (e.g., display an error message).
                } elseif (!is_numeric($nmc)) {
                        $_SESSION['nmcValidate'] = true;
                    } else {
                        // Perform the insertion or other actions for a valid input.
                        $user_sql = "INSERT INTO user VALUES ('', '$name', '$email', '$address', '$username', '$password', '$phone', '1', '$currentDateTime', '$food')";
                        if ($conn->query($user_sql) === TRUE) {
                            $select = "SELECT id FROM user WHERE Username='$username'";
                            $userid = $conn->query($select)->fetch_assoc()['id'];
                            $sql = "INSERT INTO doctor VALUES ('$userid','$degree', '$specialization', '$nmc', '$experience', '$isverified')";
                            if (!$conn->query($sql)) {
                                die('Error: ' . $conn->$error);
                            }
                            else{
                                $_SESSION['registerValidate'] = true;
                            }
                        } else {
                            echo "Error: " . $sql . "<br>";
                        }
                    }
                }
            }
            
            

    
    $conn->close();
    header('Location: ./logindoc.php');
}

?>