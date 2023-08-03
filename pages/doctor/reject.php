<?php
session_start();
require '../../actions/Connection.php';
if (isset($_GET['id'])) {
    $status = 'Rejected';
    $aid = $_GET['id'];
    $updateQuery = "UPDATE appointments SET status = 'Rejected' WHERE ID = $aid";
    $action = $conn->query($updateQuery);
        if ($action) {
            header('location: ./patientRequest.php');            
        } else {
            echo "Error accepting";
        }
}
?>