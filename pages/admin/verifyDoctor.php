<?php
session_start();
require '../../actions/Connection.php';

if (isset($_POST['submit']) || isset($_POST['submitSolo'])){
    if (isset($_POST['doctors']) && is_array($_POST['doctors'])) {
        $doctorIds = $_POST['doctors'];
        $success = true;
        foreach ($doctorIds as $doctorId) {
            $updateQuery = "UPDATE doctor SET IsVerified = 1 WHERE User_Id = $doctorId";
            $verifiedDoctor = $conn->query($updateQuery);
            if (!$verifiedDoctor) {
                $success = false;
                break;
            }
        }
        if ($success) {
            header('location: ./doctor.php');
            $_SESSION['verification_success'] = true;
            
        } else {
            echo "Error verifying doctors: ";
        }
    }
}
?>
