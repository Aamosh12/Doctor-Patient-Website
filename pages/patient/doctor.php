<?php
session_start();
require '../../actions/Connection.php';
if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
    
}
elseif($_SESSION["role"] != 2){
    header("location: ../../index.php");
    exit();
}
$sql_select = "SELECT * FROM user u INNER JOIN doctor d ON u.id = d.user_id;";
$result = $conn->query($sql_select);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient CareConnect</title>
    <link rel="stylesheet" href="../../style/patientDoctor.css">
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
                    <li><a href="./doctor.php" class="active"><i class="fa-solid fa-user-doctor"></i>
                            <span>Doctors</span></a>
                    </li>
                    <li>
                        <a href="./book.php"><i class="fa-solid fa-calendar-check"></i>
                            <span>Book a Doctor</span></a>
                    </li>
                    <li>
                        <a href="./appointments.php"><i class="fa-solid fa-book-open-reader"></i>
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
                <div class="cards">
                    <?php 
                    if ($result->num_rows > 0) {
                        $verify = [0 => 'Not Verified', 1 => 'Verified'];
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card-single'>
                            <div>
                                <h2>$row[Name] <small class='verifiedStatus'>(". $verify[$row['IsVerified']].")</small></h2>
                                <p>Degree: $row[Degree]</p>
                                <small>Specialization: $row[Specialization]</small>
                                <p>Experience: $row[Experience]</p>
                                <form action='book.php' method='post'>
                                <button class='submit-btn' type='submit' name='doctor'><i class='fa-regular fa-calendar-check'></i> Book Now</button>
                                </form>
                            </div>
                    </div>";
                        }
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>