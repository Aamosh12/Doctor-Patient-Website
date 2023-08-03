<?php
require '../../actions/Connection.php';
if (isset($_GET['specialization'])) {
    $selectedSpecialization = $_GET['specialization'];

    $sql = "SELECT users.name AS doctor_name, doctors.specialization, doctors.user_id
            FROM doctor AS doctors
            INNER JOIN user AS users ON doctors.User_Id = users.Id
            WHERE doctors.specialization = '$selectedSpecialization'";
    $result = $conn->query($sql);
    $doctors = array();
    while ($row = $result->fetch_assoc()) {
        $doctors[] = array(
            'doctor_name' => $row['doctor_name'],
            'id' => $row['user_id'],
        );
    }

    header('Content-Type: application/json');
    echo json_encode($doctors);
} else {
    // If the 'specialization' parameter is not provided, return an empty response or an error message as needed
    header("HTTP/1.1 400 Bad Request");
    echo "Specialization parameter is missing.";
}
