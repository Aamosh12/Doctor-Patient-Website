<?php
require './actions/Connection.php';
date_default_timezone_set('Asia/Kathmandu'); // Set the time zone to Nepal (Asia/Kathmandu)
$currentDateTime = date('Y-m-d H:i:s');

if (isset($_POST['register-doctor'])) {
    $name = $_POST['dname'];
    $email = $_POST['demail'];
    $address = $_POST['daddress'];
    $phone = $_POST['dphone'];
    $username = $_POST['dusername'];
    $degree = $_POST['degree'];
    $specialization = $_POST['spec'];
    $nmc = $_POST['nmc'];
    $experience = $_POST['experience'];
    $password = $_POST['dpassword'];
    $dcpassword = $_POST['dcpassword'];
    $isverified = false;
    
    $user_sql = "INSERT INTO user VALUES ('', '$name', '$email', '$address', '$username', '$password', '$phone', '1', '$currentDateTime')";

    if ($conn->query($user_sql) === TRUE) {
        $select = "SELECT id FROM user WHERE Username='$username'";
        $userid= $conn->query($select)->fetch_assoc()['id'];
        $sql = "INSERT INTO doctor VALUES ('$userid','$degree', '$specialization', '$nmc', '$experience', '$isverified')";
        if(!$conn->query($sql)){
            die('Error: '.$conn->$error);
        }
    } else {
        echo "Error: " . $sql . "<br>";
    } 
    $conn->close();
}
if (isset($_POST['register-patient'])) {
    $name = $_POST['pname'];
    $email = $_POST['pemail'];
    $address = $_POST['paddress'];
    $phone = $_POST['pnum'];
    $username = $_POST['pusername'];
    $password = $_POST['ppassword'];
    $user_sql = "INSERT INTO user VALUES ('', '$name', '$email', '$address', '$username', '$password', '$phone', '2', '$currentDateTime')";
    $conn->query($user_sql);
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
            <form action="" id="register0" class="input-group-register0" method="post" onsubmit="return validatedoc()">
                <input type="text" class="input-field" placeholder="Name" name="dname" required>
                <input type="email" class="input-field" placeholder="Email" name="demail" required>
                <input type="text" class="input-field" placeholder="Address" name="daddress" required>
                <input type="tel" class="input-field" placeholder="Phone Number" name="dphone" required>
                <input type="text" class="input-field" placeholder="Username" name="dusername" required>
                <input type="text" class="input-field" placeholder="Your Degree Here" name="degree" required>
                <input type="text" class="input-field" placeholder="Specialization" name="spec" required>
                <input type="tel" class="input-field" placeholder="NMC No." name="nmc" required>
                <input type="text" class="input-field" placeholder="Experience here" name="experience" required>
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
            <form action="" id="register2" class="input-group-register2" method="post" onsubmit="return validatepat()">
                <input type="text" class="input-field" placeholder="Name" name="pname" required>
                <input type="email" class="input-field" placeholder="Email" name="pemail" required>
                <input type="text" class="input-field" placeholder="Address" name="paddress" required>
                <input type="tel" class="input-field" placeholder="Phone No" name="pnum" required>
                <input type="text" class="input-field" placeholder="Choose a valid user name" name="pusername" onkeyup="httpreques(this.value)" required>
                <p id="userCheck"></p>
                <input type="password" class="input-field" placeholder="Password" name="ppassword" id="ppassword" required>
                <input type="password" class="input-field" placeholder="Confirm Password" name="pcpassword" id="pcpassword" required>
                <p id="password_match_error_patient" class="text-danger"></p>
                <input type="checkbox" class="check-box" required><span id="agreeText">I agree to the terms and conditions.</span>
                <button type="submit" class="submit-btn" name="register-patient">Register</button>
            </form>
        </div>
    </div>
</div>
<script>
     function validatedoc() {
      var password = document.getElementById("dpassword").value;
      var confirmPassword = document.getElementById("dcpassword").value;

      if (password !== confirmPassword) {
        document.getElementById("password_match_error").textContent = "Passwords do not match!";
        return false; // Return false to prevent form submission
      }

      // Passwords match, continue with form submission
      return true;
    }
    function validatepat() {
      var password = document.getElementById("ppassword").value;
      var confirmPassword = document.getElementById("pcpassword").value;

      if (password !== confirmPassword) {
        document.getElementById("password_match_error_patient").textContent = "Passwords do not match!";
        return false; // Return false to prevent form submission
      }

      // Passwords match, continue with form submission
      return true;
    }
    function httpreques(user){
        let request = new XMLHttpRequest();

            request.open('GET', './index-content/usernameCheck.php?username='+user);
            
            request.onreadystatechange = function () {
                if(request.status == 200 && request.readyState == 4)
                {
                    document.getElementById('userCheck').textContent = request.response;
                }
            }

            request.send();
    }
</script>