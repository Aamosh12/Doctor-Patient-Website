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
$sql = "SELECT * FROM appointments a INNER JOIN user u on a.User_id= u.id WHERE Doctor_id= $id AND status = 'pending'";
$result = $conn->query($sql);
$id = "SELECT ID, Time FROM appointments WHERE Doctor_id= $id AND status = 'pending'";
$id_result = $conn->query($id);
function getTotslAppointment()
{
    global $conn;
    global $id;
    $sql = "SELECT COUNT(*) as total_users FROM appointments WHERE Doctor_id= $id AND status = 'pending'";
    $totaluser = $conn->query($sql);
    if ($totaluser->num_rows > 0) {
        $user = $totaluser->fetch_assoc();
        return $user['total_users'];
    }
}
if (isset($_SESSION['status']) && $_SESSION['status']) {
    unset($_SESSION['status']);
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Accepted',
                text: 'Appointment is accepted successfully!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
if (isset($_SESSION['timeup'])) {
    unset($_SESSION['timeup']);
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Accepted',
                text: 'Time has been Change and Appointment is accepted successfully!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
if (isset($_POST['change'])) {
    $time = $_POST['time'];
    $appointmentId = $_POST['appointmentId'];
    $updateQuery = "UPDATE appointments SET Time='$time' WHERE ID=$appointmentId";
    $action = $conn->query($updateQuery);
    $sql = "UPDATE appointments SET status = 'Accepted' WHERE ID = $appointmentId";
    $action = $conn->query($sql);
    header('location: ./patientrequest.php');
    $_SESSION['timeup'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareConnect</title>
    <link rel="stylesheet" href="../../style/doctorReq.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <li><a href="./patientRequest.php" class="active"><i class="fa-solid fa-user-doctor"></i>
                            <span>Patient's Request</span></a>
                    </li>
                    <li>
                        <a href="./appointment.php"><i class="fa-solid fa-book-open-reader"></i>
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
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close" style="margin-top: -8px;">&times;</span>
                            <h3>Please enter your eligible time</h3>
                        </div>
                        <form action="" id="changeTime" method="post" onsubmit="return validatetime()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" id="appointmentId" name="appointmentId">
                                        <input type="text" name="time" id="time" placeholder="Your Time as 03:10 am" autocomplete="off">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                </div>
                                <button type="submit" class="btn-submit" name="change">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
                <h2>Total Request : <?php echo getTotslAppointment(); ?></h2>
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
                                                <th>Current Address</th>
                                                <th>Problem</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $id = $id_result->fetch_assoc();
                                                    echo "<tr>
                                                    <td>$row[Name]</td>
                                                    <td>$row[Current_Address]</td>
                                                    <td>$row[Problem]</td>
                                                    <td>$id[Time]</td>
                                                    <td>$row[Date]</td>
                                                    <td>
                                                    <form method='post' action='./acceptReq.php'>
                                                    <button class='editDel' type='submit' name='accept'>Accept</button>
                                                    <button class='reject' type='button' name='reject' onclick='confirmation($id[ID])'>Reject</button>
                                                    <button class='editTime' type='button' name='edit'  onclick='display($id[ID])'>Change Time</button>
                                                    <input type='hidden' name='appointmentId' value='" . htmlspecialchars($id['ID']) . "'>
                                                    </form>
                                                    </td>
                                                </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>You have no request</td></tr>";
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


        function confirmation(userId) {
            console.log(userId)
            Swal.fire({
                title: 'Are you sure?',
                text: "Please make sure Once this action is taken, it will be irreversible.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reject this request!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "reject.php?id=" + userId;
                    Swal.fire(
                        'Rejected!',
                        'Appointment request is rejected successfully.',
                        'success'
                    )
                }
            })
        }
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];

        function display(ID) {
            modal.style.display = "block";
            var appointment = document.getElementById('appointmentId');
            appointment.value = ID;
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function validatetime() {
            // Get the input value
            var timeInput = document.getElementById("time").value;

            // Define the regular expression pattern for time validation
            var timePattern = /^(1[0-2]|0?[1-9]):[0-5][0-9] [ap]m$/i;

            // Check if the input matches the pattern
            if (!timePattern.test(timeInput)) {
                // Display an error message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Time Format',
                    text: 'Please enter a valid time in the format HH:MM am/pm',
                    timer: 3000, // Optional, auto close the alert after 3 seconds
                });

                // Prevent the form from submitting
                return false;
            }

            // If the input is valid, you can proceed with form submission
            return true;
        }

        function addClickEventToElement(element, parameter) {
            element.addEventListener('click', () => {
                // You can use the 'parameter' here in your click event handler
                alert(`Clicked with parameter: ${parameter}`);
                // Replace the alert with your modal or any other action
            });
        }

        // Usage example:
        const addressCells = document.querySelectorAll('.address-cell');

        addressCells.forEach((cell) => {
            const address = cell.dataset.address;
            addClickEventToElement(cell, address);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>