<?php
session_start();
require '../../actions/Connection.php';
if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
} elseif ($_SESSION["role"] != 1) {
    header("location: ../../index.php");
    exit();
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM appointments a INNER JOIN user u on a.User_id= u.id WHERE Doctor_id= $id AND status <> 'pending'  AND status <> 'rejected'";
$result = $conn->query($sql);
$i = "SELECT ID, Time FROM appointments WHERE Doctor_id= $id AND status <> 'pending'";
$id_result = $conn->query($i);
function getTotslAppointment()
{
    global $conn;
    global $id;
    $sql = "SELECT COUNT(*) as total_users FROM appointments WHERE Doctor_id= $id AND status <> 'pending'  AND status <> 'rejected'";
    $totaluser = $conn->query($sql);
    if ($totaluser->num_rows > 0) {
        $user = $totaluser->fetch_assoc();
        return $user['total_users'];
    }
}
if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "' . $errorMessage . '",
                confirmButtonText: "OK"
            });
        });
    </script>';
    // Unset the session variable to clear the message
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['endBook'])) {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "Success",
                title: "Congratulation",
                text: "You have successfully finished your appointment",
                confirmButtonText: "OK"
            });
        });
    </script>';
    // Unset the session variable to clear the message
    unset($_SESSION['endBook']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareConnect</title>
    <link rel="stylesheet" href="../../style/doctorappointment.css">
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
                        <a href="../docdashboard.php"><i class="fa-solid fa-house"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li><a href="./patientRequest.php"><i class="fa-solid fa-user-doctor"></i>
                            <span>Patient's Request</span></a>
                    </li>
                    <li>
                        <a href="" class="active"><i class="fa-solid fa-book-open-reader"></i>
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
                <h2>Total Appointments : <?php echo getTotslAppointment() ?></h2>
                <div class="recent-grid">
                    <div class="doctor">
                        <div class="card">
                            <?php
                            include './endForm.php';
                            ?>
                            <div class="table">
                                <!-- <div class="table_header">
                                <h3></h3> 
                            </div> -->
                                <div class="table_section">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Address</th>
                                                <th>Contact</th>
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
                                                    $status = $row['status'];
                                                    echo "<tr>
                                                <td>$row[Name]</td>
                                                <td>$row[Current_Address]</td>
                                                <td>$row[Active_phone]</td>
                                                <td>$row[Problem]</td>
                                                <td>$id[Time]</td>
                                                <td>$row[Date]</td>
                                                <td>";
                                                    if ($status == 'Accepted') {
                                                        echo "<button class='editDel' type='button' name='Start' id='start' onclick='startAppointment($id[ID])'>Start</button>";
                                                    } elseif ($status == 'Ongoing') {
                                                        echo "<button class='reject' type='button' name='Finish' id='finish' onclick='finishAppointment($id[ID])'>Finish</button>";
                                                    } elseif ($status == 'Success') {
                                                        echo "<button class='success' type='button' name='success' id='success' disabled>Succeed</button>";
                                                    }
                                                    echo "</td>
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
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function startAppointment(userid) {
            window.location.href = "startappointment.php?id=" + userid;
        }

        function endAppointment(userid) {
            window.location.href = "endappointment.php?id=" + userid;
        }
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("finish");
        var span = document.getElementsByClassName("close")[0];

        // btn.onclick = function() {
        //     // get id 
        //     modal.style.display = "block";
        // }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function finishAppointment(id){
            var appointmentField = document.getElementById("appointmentId");
            //set id on form as hidden
            appointmentField.value=id;
            modal.style.display = "block";
            
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>