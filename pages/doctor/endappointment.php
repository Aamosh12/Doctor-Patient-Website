<?php
require '../../actions/Connection.php';
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $success = true;
    $updateQuery = "UPDATE appointments SET status = 'Success' WHERE ID = $userId";
    $action = $conn->query($updateQuery);
    $action = $conn->query($updateQuery);
            if (!$action) {
                $success = false;
            }
        if ($success) {
            header('location: ./appointment.php');
            $_SESSION['status'] = 'Success';
            
        } else {
            echo "Error accepting";
        }
}
?>