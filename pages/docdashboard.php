<?php
session_start();
require '../actions/Connection.php';
if (!isset($_SESSION["role"])) {
       header("location: ../index.php");
       exit();
} elseif ($_SESSION["role"] != 1) {
       header("location: ../index.php");
       exit();
}
$id = $_SESSION['id'];
$sql = "SELECT u.*, d.* FROM user u 
        INNER JOIN doctor d ON u.id = d.User_id 
        WHERE u.id = $id";

$result = $conn->query($sql);

// Step 3: Fetch and print the data in HTML format
if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
              $finalname = $row['Name'];
              $specialization = $row['Specialization'];
       }
}
if (isset($_SESSION['update'])) {
       unset($_SESSION['update']);
       echo '<script>
       document.addEventListener("DOMContentLoaded", function() {
           const Toast = Swal.mixin({
               toast: true,
               position: "top-end",
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               didOpen: (toast) => {
                   toast.addEventListener("mouseenter", Swal.stopTimer);
                   toast.addEventListener("mouseleave", Swal.resumeTimer);
               }
           });

           Toast.fire({
               icon: "success",
               title: "Your profile has been Updated"
           });
       });
       </script>';
}
function showPending(){
       global $conn;
       $id = $_SESSION['id'];
       $getPendings = "SELECT count(*) AS totalPending FROM appointments WHERE Doctor_id=$id AND status='pending'";
       $result2 = $conn->query($getPendings);
       $row1 = $result2->fetch_assoc();
       $totalPending = $row1['totalPending'];
       return $totalPending;
   
}
function showAppointment(){
       global $conn;
       $id = $_SESSION['id'];
       $getPendings = "SELECT count(*) AS totalPending FROM appointments WHERE Doctor_id=$id AND status <> 'pending' AND status <> 'rejected'";
       $result2 = $conn->query($getPendings);
       $row1 = $result2->fetch_assoc();
       $totalPending = $row1['totalPending'];
       return $totalPending;
   
}
function showsuccessAppointment(){
       global $conn;
       $id = $_SESSION['id'];
       $getPendings = "SELECT count(*) AS totalPending FROM appointments WHERE Doctor_id=$id AND status='success'";
       $result2 = $conn->query($getPendings);
       $row1 = $result2->fetch_assoc();
       $totalPending = $row1['totalPending'];
       return $totalPending;
   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>CareConnect</title>
       <link rel="stylesheet" href="../style/doctorDash.css">
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
                                          <a href="./docdashboard.php" class="active"><i class="fa-solid fa-house"></i>
                                                 <span>Dashboard</span></a>
                                   </li>
                                   <li><a href="./doctor/patientRequest.php"><i class="fa-solid fa-user-doctor"></i>
                                                 <span>Patient's Request</span></a>
                                   </li>
                                   <li>
                                          <a href="./doctor/appointment.php"><i class="fa-solid fa-book-open-reader"></i>
                                                 <span>Appointments</span></a>
                                   </li>
                                   <li>
                                          <a href="./doctor/logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Log Out</span></a>
                                   </li>
                            </ul>
                     </div>
              </div>
              <div class="main-content">
                     <?php
                     include './doctor/header.php';
                     ?>
                     <main>
                            <div class="welcome-section">
                                   <h1>Welcome, Dr. <?php echo $finalname ?>!</h1>
                                   <p class="specialization">Specialization: <?php echo $specialization ?></p>
                            </div>
                            <div class="cards">
                                   <div class="card-single">
                                          <div>
                                                 <h1><?php echo showPending()?></h1>
                                                 <span>Total Requests &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                 <button class="btn info" onclick="gotoNextpage('./doctor/patientRequest.php')">View Details</button>
                                          </div>
                                          <div><span class="las la-users"></span></div>
                                   </div>
                                   <div class="card-single">
                                          <div>
                                                 <h1><?php echo showAppointment()?></h1>
                                                 <span>Total Appointments</span>
                                                 <button class="btn info" onclick="gotoNextpage('./doctor/appointment.php')">View Details</button>
                                          </div>
                                          <div><span class="las la-users"></span></div>
                                   </div>
                                   <div class="card-single">
                                          <div>
                                                 <h1><?php echo showsuccessAppointment()?></h1>
                                                 <span>Successfull Appointments</span>
                                                 <button class="btn info">View Details</button>
                                          </div>
                                          <div><span class="las la-calendar-check"></span></div>
                                   </div>
                            </div>

                            <div class="motivational-quotes">
                                   <h2>Motivational Quotes</h2>
                                   <div class="quote-card">
                                          <p>"The art of medicine consists of amusing the patient while nature cures the disease." - Voltaire</p>
                                   </div>
                                   <div class="quote-card">
                                          <p>"The best doctors are not those who prescribe the most, but those who care the most." - Anonymous</p>
                                   </div>
                            </div>
                     </main>
              </div>
       </div>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script>
              function gotoNextpage(URL){
                     window.location.href = URL;
              }
       </script>
</body>

</html>