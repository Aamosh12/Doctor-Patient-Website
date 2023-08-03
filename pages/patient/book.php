<?php
require '../../actions/Connection.php';
session_start();
$sql_select = "SELECT DISTINCT LOWER(Specialization) AS specialization FROM doctor;";
$result = $conn->query($sql_select);

if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
    
}
elseif($_SESSION["role"] != 2){
    header("location: ../../index.php");
    exit();
}

if(isset($_POST['submit'])){
    $userId = $_SESSION['id'];
    $phoneNumber = $_POST['number'];
    $currentAddress = $_POST['address'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $specialization = $_POST['specialist'];
    $selectedDoctor = $_POST['doctor'];
    $problem = $_POST['problem'];
    $user_sql = "INSERT INTO appointments VALUES ('', '$userId', '$selectedDoctor', '$problem', '$phoneNumber', '$currentAddress', '$time', '$date', 'Pending')";
    $conn->query($user_sql);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient CareConnect</title>
    <link rel="stylesheet" href="../../style/patientBook.css">
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
                        <a href="./book.php" class="active"><i class="fa-solid fa-calendar-check"></i>
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
                <div class="form">
                    <div class="form-text">
                        <h1><span><img src="../../images/art.png" alt=""></span> Book Now <span><img src="../../images/art.png" alt=""></span></h1>
                        <p>Your health is your greatest wealth. Partner with us to prioritize your well-being.</p>
                    </div>
                    <div class="main-form">
                        <form action="" method="post">
                            <div>
                                <span>Please enter your active phone number</span>
                                <input type="tel" name="number" id="pnumber" placeholder="Write your active phone number here..." required>
                            </div>
                            <div>
                                <span>Your Current Address</span>
                                <input type="text" name="address" id="address" placeholder="Write your current address here..." required>
                            </div>
                            <div>
                                <span>What time ?</span>
                                <input type="text" name="time" id="time" placeholder="Time" required>
                            </div>
                            <div>
                                <span>What is the date ?</span>
                                <input type="date" name="date" id="date" placeholder="date" required>
                            </div>
                            <div>
                                <span>Please select type</span>
                                <select name="specialist" id="specialist" required>
                                    <option value="">Select Type</option>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['specialization'] . '">' . $row['specialization'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <span>Please select doctor</span>
                                <select name="doctor" id="doctor" required>

                                </select>
                            </div>
                            <div>
                                <span>Enter Your Problem</span>
                                <textarea name="problem" id="problem" cols="90" rows="3"></textarea>
                            </div>
                            <div id="submit">
                                <input type="submit" value="SUBMIT" id="submit" name="submit">
                            </div>


                        </form>
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
        // Get references to the specialization and doctor select elements
        const specializationSelect = document.getElementById("specialist");
        const doctorSelect = document.getElementById("doctor");
        // Function to fetch the doctors for a given specialization from the server
        function fetchDoctorsBySpecialization(selectedSpecialization) {
            console.log("Selected specialization:", selectedSpecialization);
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const doctorsData = JSON.parse(xhr.responseText);

                        // Clear existing options and enable the doctor select
                        doctorSelect.innerHTML = "";
                        doctorSelect.disabled = false;

                        // Create new doctor options and append them to the select element
                        doctorsData.forEach((doctor) => {
                            console.log(doctor.id)
                            const option = document.createElement("option");
                            option.value = doctor.id; 
                            option.textContent = doctor.doctor_name;
                            doctorSelect.appendChild(option);
                        });
                    } else {
                        console.error("Failed to fetch doctor data.");
                    }
                }
            };

            // Replace 'get_doctors_by_specialization.php' with the URL of your server script
            xhr.open("GET", `getdoctors.php?specialization=${selectedSpecialization}`);
            xhr.send();
        }

        // Event listener for the specialization select element
        specializationSelect.addEventListener("change", function() {
            const selectedSpecialization = specializationSelect.value;
            fetchDoctorsBySpecialization(selectedSpecialization);
        });
    </script>

</body>

</html>