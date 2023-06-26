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
    $confirm = false;
    if ($dpassword === $dcpassword) {
        $sql = "INSERT INTO doctor VALUES ('', '$name', '$email', '$phone', '$nmc', '$degree', '$designation', '$specialist', '$daddress', '$dpassword' )";
    if ($conn->query($sql) === TRUE) {
        echo "<script>document.getElementById('message-box').style.display = 'block';</script>";
        header("location: ../index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>";
    }
    }
    else{
        echo "invalid";
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
            <form action="" id="register0" class="input-group-register0" method="post" onsubmit="return validate()">
                <input type="text" class="input-field" placeholder="Name" name="dname" required>
                <input type="email" class="input-field" placeholder="Email" name="demail" required>
                <input type="tel" class="input-field" placeholder="Phone No" name="dphone" required>
                <input type="tel" class="input-field" placeholder="NMC No" name="nmc" required>
                <input type="text" class="input-field" placeholder="Degree" name="degree" required>
                <input type="text" class="input-field" placeholder="Designation" name="designation" required>
                <input type="text" class="input-field" placeholder="Specialist" name="specialist" required>
                <input type="text" class="input-field" placeholder="Address" name="daddress" required>
                <input type="password" class="input-field" placeholder="Password" name="dpassword" id="dpassword" required>
                <input type="password" class="input-field" placeholder="Confirm Password" name="dcpassword" id="dcpassword" required>
                <p id="password_match_error" class="text-danger"></p>
                <input type="checkbox" class="check-box" required><span id="agreeText">I agree to the terms and conditions.</span>
                <div class="message-box" style="display: none;">
                    <p id="message">Registration Success</p>
                </div>
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
<script>
     function validate() {
      var password = document.getElementById("dpassword").value;
      var confirmPassword = document.getElementById("dcpassword").value;

      if (password !== confirmPassword) {
        document.getElementById("password_match_error").textContent = "Passwords do not match!";
        return false; // Return false to prevent form submission
      }

      // Passwords match, continue with form submission
      return true;
    }
</script>