<?php
require './actions/Connection.php';

if (isset($_POST['register-doctor'])) {
    $name = $_POST['dname'];
    $email = $_POST['demail'];
    $phone = $_POST['dphone'];
    $nmc = $_POST['nmc'];
    $degree = $_POST['degree'];
    $designation = $_POST['designation'];
    $specialist = $_POST['specialist'];
    $daddress = $_POST['daddress'];
    $dpassword = $_POST['dpassword'];
    $dcpassword = $_POST['dcpassword'];
    if ($dpassword !== $dcpassword) {
        echo "<script>document.getElementById('password_match_error').style.display = 'block';</script>";
    }
    $sql = "INSERT INTO doctor VALUES ('', '$name', '$email', '$phone', '$nmc', '$degree', '$designation', '$specialist', '$daddress', '$dpassword' )";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>";
    }

    $conn->close();
}
?>
<div action="" id="register" class="input-group-register" method="post">
    <div id="choice">
        <h5>I am registering as:</h5>
        <div class="radio-box">
            <input type="radio" checked value="Doctor" name="user" id="doctor" onclick="doctor_checked()"><label for="Doctor">Doctor</label>
        </div>
        <div class="radio-box">
            <input type="radio" value="Patient" name="user" id="patient" onclick="patient_checked()"><label for="Patient">Patient</label>
        </div>
    </div><br>
    <div id="scroll-form">
        <div id="field_doctor">
            <form action="" id="register0" class="input-group-register0" method="post">
                <input type="text" class="input-field" placeholder="Name" name="dname" required>
                <input type="email" class="input-field" placeholder="Email" name="demail" required>
                <input type="tel" class="input-field" placeholder="Phone No" name="dphone" required>
                <input type="tel" class="input-field" placeholder="NMC No" name="nmc" required>
                <input type="text" class="input-field" placeholder="Degree" name="degree" required>
                <input type="text" class="input-field" placeholder="Designation" name="designation" required>
                <input type="text" class="input-field" placeholder="Specialist" name="specialist" required>
                <input type="text" class="input-field" placeholder="Address" name="daddress" required>
                <input type="password" class="input-field" placeholder="Password" name="dpassword" required>
                <input type="password" class="input-field" placeholder="Confirm Password" name="dcpassword" required>
                <p id="password_match_error" class="--bs-danger-text-emphasis" style="display: none;">Passwords do not match.</p>
                <input type="checkbox" class="check-box" required><span id="agreeText">I agree to the terms and conditions.</span>
                <button type="submit" class="submit-btn" name="register-doctor" value="register-doctor">Register</button>
            </form>
        </div>
        <!-- 
            js if else 
            if doctor don't validate client and vice versa
         -->
        <div id="field_patient">
            <form action="" id="register2" class="input-group-register2" method="post">
                <input type="text" class="input-field" placeholder="Name" required>
                <input type="email" class="input-field" placeholder="Email" required>
                <input type="text" class="input-field" placeholder="Address" required>
                <input type="tel" class="input-field" placeholder="Phone No" required>
                <input type="password" class="input-field" placeholder="Password" required>
                <input type="password" class="input-field" placeholder="Confirm Password" required>
                <input type="checkbox" class="check-box" required><span id="agreeText">I agree to the terms and conditions.</span>
                <button type="submit" class="submit-btn" name="register-patient">Register</button>
            </form>
        </div>
    </div>
</div>