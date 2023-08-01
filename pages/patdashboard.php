<?php
session_start();
require '../actions/Connection.php';
if (!isset($_SESSION["role"])) {
    header("location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Patient CareConnect</title>
       <link rel="stylesheet" href="../style/patientDash.css">
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
                                          <a href="./patdashboard.php" class="active"><i class="fa-solid fa-house"></i>
                                                 <span>Dashboard</span></a>
                                   </li>
                                   <li><a href="./patient/doctor.php"><i class="fa-solid fa-user-doctor"></i>
                                                 <span>Doctors</span></a>
                                   </li>
                                   <li>
                                          <a href="./patient/book.php"><i class="fa-solid fa-calendar-check"></i>
                                                 <span>Book a Doctor</span></a>
                                   </li>
                                   <li>
                                          <a href="./patient/appointments.php"><i class="fa-solid fa-book-open-reader"></i>
                                                 <span>Appointments</span></a>
                                   </li>
                                   <li>
                                          <a href="./patient/logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Log Out</span></a>
                                   </li>
                            </ul>
                     </div>
              </div>
              <div class="main-content">
                     <?php
                     include './patient/header.php';
                     ?>
                     <main>
                            <div class="cards">
                                   <div class="card-single">
                                          <div>
                                                 <h1>1</h1>
                                                 <span>Successful Appointments</span>
                                          </div>
                                   </div>
                                   <div class="card-single">
                                          <div>
                                                 <h1>1</h1>
                                                 <span>Appointments</span>
                                          </div>
                                   </div>
                            </div><br>
                            <div class="recent-grid">
                                   <div class="doctor">
                                          <div class="card">
                                                 <div class="table">
                                                        <div class="table_header">
                                                               <h3>Recently Appointments</h3>
                                                        </div>
                                                        <div class="table_section">
                                                               <table>
                                                                      <thead>
                                                                             <tr>
                                                                                    <th>Appointment Id</th>
                                                                                    <th>Patient</th>
                                                                                    <th>Doctor</th>
                                                                                    <th>Time</th>
                                                                                    <th>Status</th>
                                                                                    
                                                                             </tr>
                                                                      </thead>
                                                                      <tbody>

                                                                      </tbody>
                                                               </table>
                                                        </div>
                                                 </div>
                                          </div>
                                   </div>
                     </main>
              </div>
       </div>
</body>

</html>