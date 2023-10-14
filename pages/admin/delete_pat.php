<?php
session_start();
require '../../actions/Connection.php';
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
        // Step 4: Now delete the user from the user table
        $deleteUserQuery = "DELETE FROM user WHERE id = $userId";
        $resultUser = $conn->query($deleteUserQuery);

    if ($resultUser) {
        $_SESSION['deleteUser'] = true;
        header("Location: patient.php");
        exit();
    } else {
        echo "Error deleting user";
    }
}
    