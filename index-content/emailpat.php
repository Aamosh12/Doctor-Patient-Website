<?php
require '../actions/Connection.php';

$email = "SELECT * FROM user WHERE email='$_GET[email]' AND Role_id=2";
$check = $conn->query($email);
if($check->num_rows >0)
{
    echo 'Email Already exist';
}
else
{
    echo 'Email available';
}
?>