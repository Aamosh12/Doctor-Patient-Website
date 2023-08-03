<?php
require '../../actions/Connection.php';
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
        // Step 4: Now delete the user from the user table
        $deleteUserQuery = "DELETE FROM user WHERE id = $userId";
        $resultUser = $conn->query($deleteUserQuery);

    if ($resultUser) {
        header("Location: patient.php"); // Replace "index.php" with the path of your main page
        exit();
    } else {
        echo "Error deleting user";
    }
}
    