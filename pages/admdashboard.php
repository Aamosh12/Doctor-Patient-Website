<?php
session_start();
require '../actions/Connection.php';


if (!isset($_SESSION["role"])) {
    header("location: ../index.php");
    exit();
}

function getTotalDoctors()
{
    global $conn;
    $sql = "SELECT COUNT(*) as total_users FROM user WHERE role_id = 1";
    $totaluser = $conn->query($sql);
    if ($totaluser->num_rows > 0) {
        $user = $totaluser->fetch_assoc();
        return $user['total_users'];
    }
}
function getTotalPatients()
{
    global $conn;
    $sql = "SELECT COUNT(*) as total_users FROM user WHERE role_id = 2";
    $totaluser = $conn->query($sql);
    if ($totaluser->num_rows > 0) {
        $user = $totaluser->fetch_assoc();
        return $user['total_users'];
    }
}
$sql_select = "SELECT * FROM user WHERE Role_id <> 3 ORDER BY Time DESC;";
$result = $conn->query($sql_select);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../style/admin_style.css">
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-Careconnect"></span>CareConnect</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="" class="active"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-users"></span>
                        <span>Patients</span></a>
                </li>
                <li><a href=""><span class="las la-users"></span>
                        <span>Doctors</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-file-invoice"></span>
                        <span>Reports</span></a>
                </li>
                <li class="dropdown">
                    <a href="#"><span class="las la-user-circle"></span>
                        <span>Accounts</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Edit</a></li>
                        <li><a href="#">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h3>
                <label for="">
                    <span class="las la-bars"></span>
                </label>
                Dashboard
            </h3>
            <div class="user-wrapper">
                <div>
                    <h4>User Admin</h4>
                </div>
            </div>
        </header>
        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1><?php echo getTotalDoctors(); ?></h1>
                        <span>Doctors</span>
                    </div>
                    <div><span class="las la-users"></span></div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo getTotalPatients(); ?></h1>
                        <span>Patients</span>
                    </div>
                    <div><span class="las la-users"></span></div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>4</h1>
                        <span>Appointments</span>
                    </div>
                    <div><span class="las la-calendar-check"></span></div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="doctor">
                    <div class="card">
                        <div class="table">
                            <div class="table_header">
                                <h3>Newly Registered</h3>
                            </div>
                            <div class="table_section">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $role = [1 => 'Doctor', 2 => 'Patient'];
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>$row[Id]</td>
                                                    <td>$row[Name]</td>
                                                    <td>$row[Address]</td>
                                                    <td>$row[Email]</td>
                                                    <td>$row[Phone_Number]</td>
                                                    <td>" . $role[$row['Role_id']] . "</td>
                                                </tr>";
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
</body>

</html>