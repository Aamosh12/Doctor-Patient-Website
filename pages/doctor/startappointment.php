<?php
require '../../actions/Connection.php';
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $success = true;
    $updateQuery = "UPDATE appointments SET status = 'Ongoing' WHERE ID = $userId";
    $action = $conn->query($updateQuery);
    $action = $conn->query($updateQuery);
            if (!$action) {
                $success = false;
            }
        if ($success) {
            header('location: ./appointment.php');
            $_SESSION['status'] = 'Ongoing';
            
        } else {
            echo "Error accepting";
        }
}
?>