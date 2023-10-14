<?php
session_start();
require '../actions/Connection.php';
if (!isset($_SESSION["role"])) {
       header("location: ../index.php");
       exit();
} elseif ($_SESSION["role"] != 2) {
       header("location: ../index.php");
       exit();
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
function showPending()
{
       global $conn;
       $id = $_SESSION['id'];
       $getPendings = "SELECT count(*) AS totalPending FROM appointments WHERE User_id=$id AND status='pending'";
       $result2 = $conn->query($getPendings);
       $row1 = $result2->fetch_assoc();
       $totalPending = $row1['totalPending'];
       return $totalPending;
}
function showAppointment()
{
       global $conn;
       $id = $_SESSION['id'];
       $getAppointments = "SELECT count(*) AS totalappointment FROM appointments WHERE User_id=$id AND status<>'pending' AND status<>'rejected'";
       $result2 = $conn->query($getAppointments);
       $row1 = $result2->fetch_assoc();
       $totalAppointment = $row1['totalappointment'];
       return $totalAppointment;
}
function showsuccessAppointment()
{
       global $conn;
       $id = $_SESSION['id'];
       $getAppointments = "SELECT count(*) AS totalappointment FROM appointments WHERE User_id=$id AND status='success'";
       $result2 = $conn->query($getAppointments);
       $row1 = $result2->fetch_assoc();
       $totalAppointment = $row1['totalappointment'];
       return $totalAppointment;
}
function verfiedDoctor()
{
       global $conn;
       $totalDoctor = "SELECT count(*) AS totalDoctor FROM doctor WHERE IsVerified=true";
       $result2 = $conn->query($totalDoctor);
       $row1 = $result2->fetch_assoc();
       $doctor = $row1['totalDoctor'];
       return $doctor;
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
                            <div class="welcome-section">
                                   <h1>Welcome, Patient!</h1>
                                   <p class="motivational-quote">"Your health is your most valuable asset. Take care of it and cherish it."</p>
                                   <p class="wishes">Wishing you better health and a speedy recovery!</p>
                                   <h1>Hurry Up</h1>
                                   <span>Book Your appointment now</span>
                                   <button class="btn info" onclick="gotoNextpage('./patient/book.php')"> Book Now</button>
                            </div>
                            <div class="cards">
                                   <div class="card-single">
                                          <div>
                                                 <h1><?php echo verfiedDoctor() ?></h1>
                                                 <span>Total Verified Doctor &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                 <button class="btn info" onclick="gotoNextpage('./patient/doctor.php')">View All</button>
                                          </div>
                                          <div><span class="las la-users"></span></div>
                                   </div>
                                   <div class="card-single">
                                          <div>
                                                 <h1><?php echo showPending() ?></h1>
                                                 <span>Your Total Requests</span>
                                                 <button class="btn info" onclick="gotoNextpage('./patient/appointments.php')">View Details</button>
                                          </div>
                                          <div><span class="las la-users"></span></div>
                                   </div>
                                   <div class="card-single">
                                          <div>
                                                 <h1><?php echo showAppointment() ?></h1>
                                                 <span>Total Appointments</span>
                                                 <button class="btn info" onclick="gotoNextpage('./patient/appointments.php')">View Details</button>
                                          </div>
                                          <div><span class="las la-users"></span></div>
                                   </div>
                                   <div class="card-single">
                                          <div>
                                                 <h1><?php echo showsuccessAppointment() ?></h1>
                                                 <span>Successful Appointments</span>
                                                 <button class="btn info">View Details</button>
                                          </div>
                                          <div><span class="las la-calendar-check"></span></div>
                                   </div>
                            </div>

                            <div class="health-tips-section">
                                   <h2>Health Tips</h2>
                                   <ul>
                                          <li>Stay hydrated - drink plenty of water throughout the day.</li>
                                          <li>Get regular exercise to keep your body and mind healthy.</li>
                                          <li>Eat a balanced diet with plenty of fruits and vegetables.</li>
                                          <li>Practice mindfulness and relaxation techniques to reduce stress.</li>
                                   </ul>
                            </div>

                            <div class="wellness-goals-section">
                                   <h2>Wellness Goals</h2>
                                   <p>Track your wellness goals and progress here:</p>
                                   <ul>
                                          <li><label for="goal1">Exercise for at least 30 minutes every day.</label></li>
                                          <li><label for="goal2">Eat at least 5 servings of fruits and vegetables daily.</label></li>
                                          <li><label for="goal3">Meditate or practice deep breathing for 10 minutes daily.</label></li>
                                   </ul>
                            </div>
                            <div class="mindfulness-corner">
                                   <h2>Mindfulness Corner</h2>
                                   <p>Take a few moments to practice mindfulness with this guided meditation script:</p>
                                   <div class="meditation-script">
                                          <p>Close your eyes and take a deep breath in...</p>
                                          <p>Hold it for a moment, then exhale slowly...</p>
                                          <p>Continue to breathe deeply and let go of any tension or stress...</p>
                                          <p>Focus on the present moment and the sensation of your breath...</p>
                                          <p>When your mind wanders, gently bring your attention back to your breath...</p>
                                          <p>Take this time to be fully present and find inner peace...</p>
                                          <p>When you are ready, open your eyes and carry this sense of calm with you...</p>
                                   </div>
                            </div>

                            <div class="healthy-recipes-section">
                                   <h2>Healthy Recipes</h2>
                                   <p>Try these delicious and nutritious recipes to support your well-being:</p>
                                   <ul>
                                          <li>Quinoa Salad with Avocado and Chickpeas</li>
                                          <li>Grilled Salmon with Lemon and Dill</li>
                                          <li>Veggie Stir-Fry with Tofu</li>
                                          <li>Homemade Greek Yogurt Parfait with Berries</li>
                                   </ul>
                            </div>

                     </main>
              </div>
       </div>
       <script>
              function gotoNextpage(URL) {
                     window.location.href = URL;
              }
       </script>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>