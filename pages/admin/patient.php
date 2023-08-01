<?php
session_start();
require '../../actions/Connection.php';
if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient | CareConnect</title>
    <link rel="stylesheet" href="../../style/adminPatient.css">
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
                    <a href=""  class="active"><i class="fa-solid fa-user-group"></i>
                        <span>Patients</span></a>
                </li>
                <li><a href="./doctor.php"><i class="fa-solid fa-user-doctor"></i>
                        <span>Doctors</span></a>
                </li>
                <li>
                    <a href=""><i class="fa-solid fa-file-invoice"></i>
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
        </main>
    </div>
</body>

</html>