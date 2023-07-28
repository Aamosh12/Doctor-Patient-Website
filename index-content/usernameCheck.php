<?php
require '../actions/Connection.php';

$username = "SELECT * FROM user WHERE username='$_GET[username]'";
$check = $conn->query($username);
if($check->num_rows >0)
{
    echo 'User Already exist';
}
else
{
    echo 'Username available';
}