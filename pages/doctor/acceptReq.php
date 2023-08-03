<?php
session_start();
require '../../actions/Connection.php';
if(isset($_POST['accept'])){
    $status = 'Accept';
    $success = true;
    $aid = $_POST['appointmentId'];
    $updateQuery = "UPDATE appointments SET status = 'Accepted' WHERE ID = $aid";
    $action = $conn->query($updateQuery);
    $action = $conn->query($updateQuery);
            if (!$action) {
                $success = false;
            }
        if ($success) {
            header('location: ./patientRequest.php');
            $_SESSION['status'] = $status;
            
        } else {
            echo "Error accepting";
        }
}
?>