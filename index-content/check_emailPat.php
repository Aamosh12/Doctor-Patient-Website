<?php
require '../actions/Connection.php';
$email = $_POST['email'];

// Prepare the SQL query to check if the email already exists in the database
$email = $conn->real_escape_string($email);
$sql = "SELECT Email FROM user WHERE Email = '$email' AND Role_id = 2";

// Execute the query
$result = $conn->query($sql);

// Check if there is any result (if the email already exists)
if ($result->num_rows > 0) {
    echo 'exist';
} else {
    echo 'not_exist';
}

// Close the database connection
$conn->close();
?>