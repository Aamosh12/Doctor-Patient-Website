<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "mycareconnect";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  // echo "Connection successfull";

// Close the connection
// $conn->close();
?>