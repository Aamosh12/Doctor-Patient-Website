<?php
require '../../actions/Connection.php';
session_start();
if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
    
}
elseif($_SESSION["role"] != 2){
    header("location: ../../index.php");
    exit();
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM appointments a INNER JOIN user u on a.User_id= u.id WHERE User_id= $id";
$result = $conn->query($sql);
$i = "SELECT ID, Time, Doctor_id FROM appointments WHERE User_id= $id";
$id_result = $conn->query($i);

function getTotslAppointment()
{
    global $conn;
    global $id;
    $sql = "SELECT COUNT(*) as total_users FROM appointments WHERE User_id= $id";
    $totaluser = $conn->query($sql);
    if ($totaluser->num_rows > 0) {
        $user = $totaluser->fetch_assoc();
        return $user['total_users'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient CareConnect</title>
    <link rel="stylesheet" href="../../style/patientappointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div id="wrapper">
        <div class="sidebar">
            <div class="sidebar-brand">
                <h2>CareConnect</h2>
            </div>
            <hr>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="../patdashboard.php"><i class="fa-solid fa-house"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li><a href="./doctor.php"><i class="fa-solid fa-user-doctor"></i>
                            <span>Doctors</span></a>
                    </li>
                    <li>
                        <a href="./book.php" ><i class="fa-solid fa-calendar-check"></i>
                            <span>Book a Doctor</span></a>
                    </li>
                    <li>
                        <a href="./appointments.php" class="active"><i class="fa-solid fa-book-open-reader"></i>
                            <span>Appointments</span></a>
                    </li>
                    <li>
                        <a href="./logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Log Out</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <?php
            include './header.php';
            ?>
            <main>
            <h2>Total Appointments : <?php echo getTotslAppointment()?></h2>
            <div class="recent-grid">
                    <div class="doctor">
                        <div class="card">
                            <div class="table">
                                <!-- <div class="table_header">
                                <h3></h3> 
                            </div> -->
                                <div class="table_section">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Doctor</th>
                                                <th>Problem</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $id_result->fetch_assoc();
                                                $doc = "SELECT Name FROM user WHERE Id = $id[Doctor_id]";
                                                $doctor = $conn->query($doc);
                                                $nameDoc = $doctor->fetch_assoc();
                                                echo "<tr>
                                                <td>$row[Name]</td>
                                                <td>$nameDoc[Name]</td>
                                                <td>$row[Problem]</td>
                                                <td>$id[Time]</td>
                                                <td>$row[Date]</td>
                                                <td>$row[status]</td>
                                                
                                            </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>Sorry, You have no appointments to attend</td></tr>";
                                        }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        
    </script>

</body>

</html>