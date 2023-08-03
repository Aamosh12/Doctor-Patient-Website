<?php
session_start();
require '../../actions/Connection.php';


if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
    
}
elseif($_SESSION["role"] != 3){
    header("location: ../../index.php");
    exit();
}
$sql = "SELECT 
            user.name AS user_name,
            doctor_user.name AS doctor_name,
            appointments.problem,
            appointments.active_phone,
            appointments.current_address,
            appointments.time,
            appointments.date,
            appointments.status
        FROM 
            appointments
        JOIN user ON appointments.user_id = user.id
        JOIN user AS doctor_user ON appointments.doctor_id = doctor_user.id";
$result = $conn->query($sql);
function getTotalAppointmentsCount() {
    global $conn;
    $sql2 = "SELECT COUNT(*) AS total_appointments FROM appointments";

    // Execute the query
    $result2 = $conn->query($sql2);
    // Fetch the result and extract the total count
    $row1 = $result2->fetch_assoc();
    $totalAppointments = $row1['total_appointments'];
    return $totalAppointments;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | CareConnect</title>
    <link rel="stylesheet" href="../../style/adminDoctor.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>CareConnect</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="../admdashboard.php"><i class="fa-solid fa-igloo"></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="./patient.php"><i class="fa-solid fa-user-group"></i>
                        <span>Patients</span></a>
                </li>
                <li><a href="./doctor.php" ><i class="fa-solid fa-user-doctor"></i>
                        <span>Doctors</span></a>
                </li>
                <li>
                    <a href="./report.php" class="active"><i class="fa-solid fa-file-invoice"></i>
                        <span>Reports</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Log Out</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <?php
        include 'header.php';
        ?>
        <main>
            <div class="table">
                <div class="table_header">
                    <h3>Total Appointments : <?php echo getTotalAppointmentsCount() ?></h3>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Problem</th>
                                <th>Phone Number</th>
                                <th>Patient's Address</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['user_name'] . "</td>";
                                    echo "<td>" . $row['doctor_name'] . "</td>";
                                    echo "<td>" . $row['problem'] . "</td>";
                                    echo "<td>" . $row['active_phone'] . "</td>";
                                    echo "<td>" . $row['current_address'] . "</td>";
                                    echo "<td>" . $row['time'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No data found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        function confirmation(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "delete_user.php?id=" + userId;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>